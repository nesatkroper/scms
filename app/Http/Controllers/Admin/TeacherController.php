<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use Illuminate\Support\Facades\Log;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
        $departments = Department::all();
<<<<<<< HEAD
        
        $teachers = User::role('teacher')
            ->with('department')
=======
        $teachers = User::with('department')
>>>>>>> a1dacf9ae07cb648cbaa8dc5e4f5684a79de9010
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('qualification', 'like', "%{$search}%")
                    ->orWhere('specialization', 'like', "%{$search}%")
                    ->orWhere('joining_date', 'like', "%{$search}%")
                    ->orWhere('salary', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
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

        return view('admin.teachers.index', compact('teachers', 'departments'));
    }

    public function store(StoreTeacherRequest $request)
    {
        try {
            Log::info('Store Teacher Request Data:', $request->all());
            
            $validated = $request->validated();
            Log::info('Validated Data:', $validated);

            // Handle photo upload
            $teacherPhotoPath = public_path('photos/teacher');
            if (!file_exists($teacherPhotoPath)) {
                mkdir($teacherPhotoPath, 0755, true);
            }
            
            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');
                $photoName = time() . '-' . date('d-m-Y') . '_add_' . $photo->getClientOriginalName();
                $photo->move($teacherPhotoPath, $photoName);
                $validated['avatar'] = 'photos/teacher/' . $photoName;
            }

            // Handle CV upload
            $cvPath = public_path('photos/cv');
            if (!file_exists($cvPath)) {
                mkdir($cvPath, 0755, true);
            }
            
            if ($request->hasFile('cv')) {
                $cv = $request->file('cv');
                $cvName = time() . '-' . date('d-m-Y') . '_add_' . $cv->getClientOriginalName();
                $cv->move($cvPath, $cvName);
                $validated['cv'] = 'photos/cv/' . $cvName;
            }
<<<<<<< HEAD

            // Set default password if not provided
            if (!isset($validated['password']) || empty($validated['password'])) {
                $validated['password'] = 'password'; // Default password
            }
            $validated['password'] = Hash::make($validated['password']);
            
            // Create user
            $teacher = User::create($validated);
            $teacher->assignRole('teacher');
=======
            $teacher = User::create($validated);
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make('password'),
                'avatar' => $validated['photo'] ?? null,
            ]);
            $validated['user_id'] = $user->id;
            $user->assignRole('teacher');
>>>>>>> a1dacf9ae07cb648cbaa8dc5e4f5684a79de9010

            return response()->json([
                'success' => true,
                'message' => 'Teacher created successfully!',
                'teacher' => $teacher
            ]);
        } catch (\Exception $e) {
            Log::error('Teacher Store Error: ' . $e->getMessage());
            Log::error('Stack Trace: ' . $e->getTraceAsString());
            
            return response()->json([
                'success' => false,
                'message' => 'Error creating teacher: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show(User $teacher)
    {
        // Ensure we're only showing teachers
        if (!$teacher->hasRole('teacher')) {
            return response()->json([
                'success' => false,
                'message' => 'User is not a teacher'
            ], 404);
        }

        $teacher->load('department');
        return response()->json([
            'success' => true,
            'teacher' => $teacher
        ]);
    }

    public function update(UpdateTeacherRequest $request, User $teacher)
    {
        try {
            // Ensure we're only updating teachers
            if (!$teacher->hasRole('teacher')) {
                return response()->json([
                    'success' => false,
                    'message' => 'User is not a teacher'
                ], 404);
            }

            $data = $request->validated();

            // Handle photo upload
            if ($request->hasFile('photo')) {
                // Delete old photo if exists
                if ($teacher->avatar && file_exists(public_path($teacher->avatar))) {
                    unlink(public_path($teacher->avatar));
                }

                $photo = $request->file('photo');
                $photoName = time() . '-' . date('d-m-Y') . '_ed_' . $photo->getClientOriginalName();
                $photoPath = public_path('photos/teacher');
                $photo->move($photoPath, $photoName);
                $data['avatar'] = 'photos/teacher/' . $photoName;
            }

            // Handle CV upload
            if ($request->hasFile('cv')) {
                // Delete old CV if exists
                if ($teacher->cv && file_exists(public_path($teacher->cv))) {
                    unlink(public_path($teacher->cv));
                }
                $cv = $request->file('cv');
                $cvName = time() . '-' . date('d-m-Y') . '_ed_' . $cv->getClientOriginalName();
                $cvPath = public_path('photos/cv');
                $cv->move($cvPath, $cvName);
                $data['cv'] = 'photos/cv/' . $cvName;
            }

            // Update password if provided
            if (isset($data['password']) && !empty($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            } else {
                unset($data['password']);
            }

            $teacher->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Teacher updated successfully',
                'teacher' => $teacher->fresh('department')
            ]);
        } catch (\Exception $e) {
            Log::error('Teacher Update Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error updating teacher: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(User $teacher)
    {
        try {
            // Ensure we're only deleting teachers
            if (!$teacher->hasRole('teacher')) {
                return response()->json([
                    'success' => false,
                    'message' => 'User is not a teacher'
                ], 404);
            }

            // Delete associated files
            if ($teacher->avatar) {
                $photoPath = public_path($teacher->avatar);
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
<<<<<<< HEAD
            $teachers = User::role('teacher')->whereIn('id', $ids)->get();
=======
            $teachers = User::whereIn('id', $ids)->get();
>>>>>>> a1dacf9ae07cb648cbaa8dc5e4f5684a79de9010

            foreach ($teachers as $teacher) {
                // Delete associated files
                if ($teacher->avatar) {
                    $photoPath = public_path($teacher->avatar);
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
<<<<<<< HEAD
            $teachers = User::role('teacher')->whereIn('id', $ids)->get();
=======
            $teachers = User::whereIn('id', $ids)->get();
>>>>>>> a1dacf9ae07cb648cbaa8dc5e4f5684a79de9010
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

<<<<<<< HEAD
=======
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
    //             $teacher = User::findOrFail($teacherData['id']);
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

>>>>>>> a1dacf9ae07cb648cbaa8dc5e4f5684a79de9010
    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'teachers' => 'required|array',
            'teachers.*.id' => 'required|exists:users,id',
        ]);

        $updatedCount = 0;

        foreach ($request->input('teachers') as $teacherData) {
            $validator = Validator::make($teacherData, [
                'id' => 'required|exists:users,id',
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $teacherData['id'],
                'gender' => 'required|in:male,female',
                'date_of_birth' => 'required|date',
                'department_id' => 'required|exists:departments,id',
                'joining_date' => 'required|date',
                'qualification' => 'required|string|max:255',
                'experience' => 'nullable|string',
                'phone' => 'nullable|string|max:20',
                'address' => 'nullable|string',
                'specialization' => 'nullable|string',
                'salary' => 'nullable|numeric|min:0',
                'blood_group' => 'nullable|string|max:10',
                'nationality' => 'nullable|string|max:255',
                'religion' => 'nullable|string|max:255',
            ]);

            if ($validator->fails()) {
                Log::error("Validation failed for teacher ID {$teacherData['id']}: " . json_encode($validator->errors()));
                continue;
            }

            try {
                $teacher = User::findOrFail($teacherData['id']);
<<<<<<< HEAD
                // Ensure we're only updating teachers
                if ($teacher->hasRole('teacher')) {
                    $teacher->update($validator->validated());
                    $updatedCount++;
                }
=======
                $teacher->update($validator->validated());
                $updatedCount++;
>>>>>>> a1dacf9ae07cb648cbaa8dc5e4f5684a79de9010
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