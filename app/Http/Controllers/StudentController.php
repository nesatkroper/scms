<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Support\Facades\Log;
use App\Models\Student;
use App\Models\GradeLevel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);
        $viewType = $request->input('view', 'table');
        $users = User::all();
        $gradeLevels = GradeLevel::all();

        $students = Student::with('gradeLevel')
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%")
                    ->orWhere('admission_date', 'like', "%{$search}%")
                    ->orWhereHas('gradeLevel', function ($q) use ($search) {
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
                'table' => view('admin.students.partials.table', compact('students'))->render(),
                'cards' => view('admin.students.partials.cardlist', compact('students'))->render(),
                'pagination' => $students->links()->toHtml()
            ];

            return response()->json([
                'success' => true,
                'html' => $html,
                'view' => $viewType
            ]);
        }

        return view('admin.students.index', compact('students', 'gradeLevels', 'users'));
    }

    public function store(StoreStudentRequest $request)
    {
        try {
            $validated = $request->validated();
            $studentPhotoPath = public_path('photos/student');

            if (!file_exists($studentPhotoPath)) {
                mkdir($studentPhotoPath, 0755, true);
            }

            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');
                $photoName = time() . '-' . date('d-m-Y') . '_add' . $photo->getClientOriginalName();
                $photo->move($studentPhotoPath, $photoName);
                $validated['photo'] = 'photos/student/' . $photoName;
            }
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make('password'),
                'avatar' => $validated['photo'] ?? null,
            ]);
            $validated['user_id'] = $user->id;
            $user->assignRole('student');
            $student = Student::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Student created successfully!',
                'student' => $student
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating student: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show(Student $student)
    {
        $student->load('gradeLevel', 'user', 'guardians');
        return response()->json([
            'success' => true,
            'student' => $student
        ]);
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        try {
            $data = $request->validated();
            // Handle photo upload
            if ($request->hasFile('photo')) {
                // Delete old photo if exists
                if ($student->photo && file_exists(public_path($student->photo))) {
                    unlink(public_path($student->photo));
                }

                $photo = $request->file('photo');
                $photoName = time() . '-' . date('d-m-Y') . '_ed' . $photo->getClientOriginalName();
                $photoPath = public_path('photos/student');
                $photo->move($photoPath, $photoName);
                $data['photo'] = 'photos/student/' . $photoName;
            }
            if ($student->user) {
                $student->user->update([
                    'name'   => $data['name'] ?? $student->name,
                    'email'  => $data['email'] ?? $student->email,
                    'avatar' => $data['photo'] ?? $student->photo,
                ]);
            }
            $student->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Student updated successfully',
                'student' => $student->fresh('gradeLevel')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating student: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Student $student)
    {
        try {
            // Delete associated files
            if ($student->photo) {
                $photoPath = public_path($student->photo);
                if (file_exists($photoPath)) {
                    unlink($photoPath);
                }
            }

            $student->delete();

            return response()->json([
                'success' => true,
                'message' => 'Student deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting student: ' . $e->getMessage()
            ], 500);
        }
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');

        if (empty($ids)) {
            return response()->json([
                'success' => false,
                'message' => 'No students selected'
            ], 400);
        }

        try {
            $students = Student::whereIn('id', $ids)->get();

            foreach ($students as $student) {
                // Delete associated files
                if ($student->photo) {
                    $photoPath = public_path($student->photo);
                    if (file_exists($photoPath)) {
                        unlink($photoPath);
                    }
                }
                $student->delete();
            }

            return response()->json([
                'success' => true,
                'message' => count($students) . ' students deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting students: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getBulkData(Request $request)
    {
        $ids = $request->input('ids');

        if (empty($ids)) {
            return response()->json([
                'success' => false,
                'message' => 'No students selected'
            ], 400);
        }

        if (count($ids) > 5) {
            return response()->json([
                'success' => false,
                'message' => 'You can only edit up to 5 students at a time'
            ], 400);
        }

        try {
            $students = Student::whereIn('id', $ids)->get();
            return response()->json([
                'success' => true,
                'data' => $students
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching students: ' . $e->getMessage()
            ], 500);
        }
    }

    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'students' => 'required|array',
            'students.*.id' => 'required|exists:students,id',
        ]);

        $updatedCount = 0;

        foreach ($request->input('students') as $studentData) {
            $validator = Validator::make($studentData, [
                'id' => 'required|exists:students,id',
                'name' => 'required|string|max:255',
                'gender' => 'required|in:male,female,other',
                'dob' => 'required|date',
                'grade_level_id' => 'required|exists:grade_levels,id',
                'user_id' => 'nullable|exists:users,id',
                'phone' => 'nullable|string|max:20',
                'email' => 'nullable|email|max:255',
                'address' => 'nullable|string',
                'blood_group' => 'nullable|string|max:10',
                'nationality' => 'nullable|string|max:100',
                'religion' => 'nullable|string|max:100',
                'admission_date' => 'required|date',
            ]);

            if ($validator->fails()) {
                Log::error("Validation failed for student ID {$studentData['id']}: " . json_encode($validator->errors()));
                continue;
            }

            try {
                $student = Student::findOrFail($studentData['id']);
                $student->update($validator->validated());
                $updatedCount++;
            } catch (\Exception $e) {
                Log::error("Error updating student: " . $e->getMessage());
            }
        }

        return response()->json([
            'success' => true,
            'message' => "Successfully updated $updatedCount students",
            'redirect' => route('admin.students.index')
        ]);
    }
}
