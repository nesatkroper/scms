<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use Illuminate\Support\Facades\Log;
use App\Models\Teacher;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);
        $viewType = $request->input('view', 'table');
        $users = User::all();
        $departments = Department::all();
        $teachers = Teacher::with('department')
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('qualification', 'like', "%{$search}%")
                    ->orWhere('specialization', 'like', "%{$search}%")
                    ->orWhere('joining_date', 'like', "%{$search}%")
                    ->orWhere('salary', 'like', "%{$search}%")
                    ->orWhereHas('department', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage)
            ->appends([
                'search' => $search,
                'per_page' => $perPage,
                'view' => $viewType
            ]);

        if ($request->ajax()) {
            $html = [
                'table' => view('admin.teachers.partials.table', compact('teachers'))->render(),
                'cards' => view('admin.teachers.partials.cardlist', compact('teachers'))->render(),
                'pagination' => $teachers->links()->toHtml()
            ];

            return response()->json([
                'success' => true,
                'html' => $html,
                'view' => $viewType
            ]);
        }

        return view('admin.teachers.index', compact('teachers', 'departments', 'users'));
    }

    public function store(StoreTeacherRequest $request)
    {
        try {
            $data = $request->validated();

            // Handle photo upload
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('teachers/photos', 'public');
                $data['photo'] = $photoPath;
            }

            // Handle CV upload
            if ($request->hasFile('cv')) {
                $cvPath = $request->file('cv')->store('teachers/cvs', 'public');
                $data['cv'] = $cvPath;
            }

            $teacher = Teacher::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Teacher created successfully!',
                'teacher' => $teacher
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating teacher: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show(Teacher $teacher)
    {
        $teacher->load('department');
        return response()->json([
            'success' => true,
            'teacher' => $teacher
        ]);
    }

    public function update(UpdateTeacherRequest $request, Teacher $teacher)
    {
        try {
            $data = $request->validated();

            // Handle photo upload
            if ($request->hasFile('photo')) {
                // Delete old photo if exists
                if ($teacher->photo) {
                    Storage::disk('public')->delete($teacher->photo);
                }
                $photoPath = $request->file('photo')->store('teachers/photos', 'public');
                $data['photo'] = $photoPath;
            }

            // Handle CV upload
            if ($request->hasFile('cv')) {
                // Delete old CV if exists
                if ($teacher->cv) {
                    Storage::disk('public')->delete($teacher->cv);
                }
                $cvPath = $request->file('cv')->store('teachers/cvs', 'public');
                $data['cv'] = $cvPath;
            }

            $teacher->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Teacher updated successfully',
                'teacher' => $teacher->fresh('department')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating teacher: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Teacher $teacher)
    {
        try {
            // Delete associated files
            if ($teacher->photo) {
                Storage::disk('public')->delete($teacher->photo);
            }
            if ($teacher->cv) {
                Storage::disk('public')->delete($teacher->cv);
            }

            $teacher->delete();

            return response()->json([
                'success' => true,
                'message' => 'Teacher deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting teacher: ' . $e->getMessage()
            ], 500);
        }
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');

        if (empty($ids)) {
            return response()->json([
                'success' => false,
                'message' => 'No teachers selected'
            ], 400);
        }

        try {
            $teachers = Teacher::whereIn('id', $ids)->get();

            foreach ($teachers as $teacher) {
                // Delete associated files
                if ($teacher->photo) {
                    Storage::disk('public')->delete($teacher->photo);
                }
                if ($teacher->cv) {
                    Storage::disk('public')->delete($teacher->cv);
                }
                $teacher->delete();
            }

            return response()->json([
                'success' => true,
                'message' => count($teachers) . ' teachers deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting teachers: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getBulkData(Request $request)
    {
        $ids = $request->input('ids');

        if (empty($ids)) {
            return response()->json([
                'success' => false,
                'message' => 'No teachers selected'
            ], 400);
        }

        if (count($ids) > 5) {
            return response()->json([
                'success' => false,
                'message' => 'You can only edit up to 5 teachers at a time'
            ], 400);
        }

        try {
            $teachers = Teacher::whereIn('id', $ids)->get();
            return response()->json([
                'success' => true,
                'data' => $teachers
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching teachers: ' . $e->getMessage()
            ], 500);
        }
    }

    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'teachers' => 'required|array',
            'teachers.*.id' => 'required|exists:teachers,id',
        ]);

        $updatedCount = 0;

        foreach ($request->input('teachers') as $teacherData) {
            $validator = Validator::make($teacherData, [
                'id' => 'required|exists:teachers,id',
                'department_id' => 'nullable|exists:departments,id',
                'joining_date' => 'required|date',
                'qualification' => 'required|string|max:255',
                'specialization' => 'nullable|string',
                'salary' => 'nullable|numeric|min:0',
            ]);

            if ($validator->fails()) {
                Log::error("Validation failed for teacher ID {$teacherData['id']}: " . json_encode($validator->errors()));
                continue; // Skip invalid
            }

            try {
                $teacher = Teacher::findOrFail($teacherData['id']);
                $teacher->update($validator->validated());
                $updatedCount++;
            } catch (\Exception $e) {
                Log::error("Error updating teacher: " . $e->getMessage());
            }
        }

        return response()->json([
            'success' => true,
            'message' => "Successfully updated $updatedCount teachers",
            'redirect' => route('admin.teachers.index')
        ]);
    }
}
