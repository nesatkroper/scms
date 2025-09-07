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
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{

    // protected function ModelPermissionName(): string
    // {
    //     return 'teacher';
    // }

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
            $validated = $request->validated();
            $teacherPhotoPath = public_path('photos/teacher');
            if (!file_exists($teacherPhotoPath)) {
                mkdir($teacherPhotoPath, 0755, true);
            }
            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');
                $photoName = time()  . '-' . date('d-m-Y') . '_add' . $photo->getClientOriginalName();
                $photo->move($teacherPhotoPath, $photoName);
                $validated['photo'] = 'photos/teacher/' . $photoName;
            }
            $cvPath = public_path('photos/cv');
            if (!file_exists($cvPath)) {
                mkdir($cvPath, 0755, true);
            }

            if ($request->hasFile('cv')) {
                $cv = $request->file('cv');
                $cvName = time()  . '-' . date('d-m-Y') . '_ed' . $cv->getClientOriginalName();
                $cv->move($cvPath, $cvName);
                $validated['cv'] = 'photos/cv/' . $cvName;
            }
            $teacher = Teacher::create($validated);
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make('password'),
                'avatar' => $validated['photo'] ?? null,
            ]);
            $validated['user_id'] = $user->id;
            $user->assignRole('teacher');

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
                if ($teacher->photo && file_exists(public_path($teacher->photo))) {
                    unlink(public_path($teacher->photo));
                }

                $photo = $request->file('photo');
                $photoName = time()  . '-' . date('d-m-Y') . '_ed' . $photo->getClientOriginalName();
                $photoPath = public_path('photos/teacher');
                $photo->move($photoPath, $photoName);
                $data['photo'] = 'photos/teacher/' . $photoName;
            }

            // Handle CV upload
            if ($request->hasFile('cv')) {
                // Delete old CV if exists
                if ($teacher->cv && file_exists(public_path($teacher->cv))) {
                    unlink(public_path($teacher->cv));
                }
                $cv = $request->file('cv');
                $cvName = time()  . '-' . date('d-m-Y') . '_ed' . $cv->getClientOriginalName();
                $cvPath = public_path('photos/cv');
                $cv->move($cvPath, $cvName);
                $data['cv'] = 'photos/cv/' . $cvName;
            }

            if ($teacher->user) {
                $teacher->user->update([
                    'name'   => $data['name'] ?? $teacher->name,
                    'email'  => $data['email'] ?? $teacher->email,
                    'avatar' => $data['photo'] ?? $teacher->avatar,
                ]);
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
                $photoPath = public_path($teacher->photo);
                if (file_exists($photoPath)) {
                    unlink($photoPath);
                }
            }
            if ($teacher->cv) {
                $cvPath = public_path($teacher->cv);
                if (file_exists($cvPath)) {
                    unlink($cvPath);
                }
            }
            if ($teacher->user) {
                $teacher->user->delete();
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
                if ($teacher->user) {
                    $teacher->user->delete();
                }
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

    // public function bulkUpdate(Request $request)
    // {
    //     $request->validate([
    //         'teachers' => 'required|array',
    //         'teachers.*.id' => 'required|exists:teachers,id',
    //     ]);

    //     $updatedCount = 0;

    //     foreach ($request->input('teachers') as $teacherData) {
    //         $validator = Validator::make($teacherData, [
    //             'id' => 'required|exists:teachers,id',
    //             'department_id' => 'nullable|exists:departments,id',
    //             'joining_date' => 'required|date',
    //             'qualification' => 'required|string|max:255',
    //             'specialization' => 'nullable|string',
    //             'salary' => 'nullable|numeric|min:0',
    //         ]);

    //         if ($validator->fails()) {
    //             Log::error("Validation failed for teacher ID {$teacherData['id']}: " . json_encode($validator->errors()));
    //             continue; // Skip invalid
    //         }

    //         try {
    //             $teacher = Teacher::findOrFail($teacherData['id']);
    //             $teacher->update($validator->validated());
    //             $updatedCount++;
    //         } catch (\Exception $e) {
    //             Log::error("Error updating teacher: " . $e->getMessage());
    //         }
    //     }

    //     return response()->json([
    //         'success' => true,
    //         'message' => "Successfully updated $updatedCount teachers",
    //         'redirect' => route('admin.teachers.index')
    //     ]);
    // }

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
                'teacher_id' => 'required|string|max:255',
                'name' => 'required|string|max:255',
                'gender' => 'required|in:male,female,other',
                'dob' => 'required|date',
                'department_id' => 'required|exists:departments,id',
                'joining_date' => 'required|date',
                'qualification' => 'required|string|max:255',
                'experience' => 'nullable|string',
                'phone' => 'nullable|string|max:20',
                'email' => 'nullable|email|max:255',
                'address' => 'nullable|string',
                'specialization' => 'nullable|string',
                'salary' => 'nullable|numeric|min:0',
            ]);

            if ($validator->fails()) {
                Log::error("Validation failed for teacher ID {$teacherData['id']}: " . json_encode($validator->errors()));
                continue;
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
