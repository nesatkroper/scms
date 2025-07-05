<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use Illuminate\Support\Facades\Log;
use App\Models\Teacher;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);
        $viewType = $request->input('view', 'table');
        $departments = Department::all();

        $teachers = Teacher::with('department')
            ->when($search, function ($query) use ($search) {
                return $query->where('teacher_id', 'like', "%{$search}%")
                    ->orWhere('qualification', 'like', "%{$search}%")
                    ->orWhere('specialization', 'like', "%{$search}%")
                    ->orWhere('joining_date', 'like', "%{$search}%")
                    ->orWhere('salary', 'like', "%{$search}%")
                    ->orWhereHas('department', function($q) use ($search) {
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
                'table' => view('teachers.partials.table', compact('teachers'))->render(),
                'cards' => view('teachers.partials.cardlist', compact('teachers'))->render(),
                'pagination' => $teachers->links()->toHtml()
            ];

            return response()->json([
                'success' => true,
                'html' => $html,
                'view' => $viewType
            ]);
        }

        return view('teachers.index', compact('teachers', 'departments'));
    }

    public function store(StoreTeacherRequest $request)
    {
        try {
            $teacher = Teacher::create($request->validated());
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
            $teacher->update($request->validated());
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
            $count = Teacher::whereIn('id', $ids)->delete();
            return response()->json([
                'success' => true,
                'message' => $count . ' teachers deleted successfully'
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
                'teacher_id' => [
                    'required',
                    'string',
                    'max:50',
                    Rule::unique('teachers', 'teacher_id')->ignore($teacherData['id'], 'id'),
                ],
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
            'redirect' => route('teachers.index')
        ]);
    }
}