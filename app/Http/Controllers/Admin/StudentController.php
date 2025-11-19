<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\GradeLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 12);
        $viewType = $request->input('view', 'table');

        $students = User::role('student')
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%")
                    ->orWhere('admission_date', 'like', "%{$search}%");
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

        return view('admin.students.index', compact('students'));
    }

    public function store(UserRequest $request)
    {
        try {
            $validated = $request->validated();
            $studentPhotoPath = public_path('uploads/students');

            if (!file_exists($studentPhotoPath)) {
                mkdir($studentPhotoPath, 0755, true);
            }

            if ($request->hasFile('avatar')) {
                $avatar = $request->file('avatar');
                $photoName = time() . '-' . date('d-m-Y') . '_add_avatar.' . $avatar->getClientOriginalExtension();
                $avatar->move($studentPhotoPath, $photoName);
                $validated['avatar'] = 'uploads/students/' . $photoName;
            }

            // Create user with student role
            $user = User::create($validated + [
                'password' => Hash::make('password123'),
            ]);

            $user->assignRole('student');

            return response()->json([
                'success' => true,
                'message' => 'Student created successfully!',
                'data' => $user->load('gradeLevel')
            ]);
        } catch (\Exception $e) {
            Log::error('Error creating student: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error creating student: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show(User $student)
    {
        // Ensure the user is a student
        if (!$student->hasRole('student')) {
            return response()->json([
                'success' => false,
                'message' => 'Student not found'
            ], 404);
        }

        $student->load('gradeLevel');
        $student->age = $student->date_of_birth ? \Carbon\Carbon::parse($student->date_of_birth)->age : null;

        return response()->json([
            'success' => true,
            'data' => $student
        ]);
    }

    public function update(UserRequest $request, User $student)
    {
        try {
            // Ensure the user is a student
            if (!$student->hasRole('student')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Student not found'
                ], 404);
            }

            $data = $request->validated();

            // Handle avatar upload
            if ($request->hasFile('avatar')) {
                // Delete old photo if exists
                if ($student->avatar && file_exists(public_path($student->avatar))) {
                    unlink(public_path($student->avatar));
                }

                $avatar = $request->file('avatar');
                $photoName = time() . '-' . date('d-m-Y') . '_ed_avatar.' . $avatar->getClientOriginalExtension();
                $photoPath = public_path('uploads/students');
                $avatar->move($photoPath, $photoName);
                $data['avatar'] = 'uploads/students/' . $photoName;
            }

            $student->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Student updated successfully!',
                'data' => $student->fresh('gradeLevel')
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating student: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error updating student: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(User $student)
    {
        try {
            // Ensure the user is a student
            if (!$student->hasRole('student')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Student not found'
                ], 404);
            }

            // Delete avatar if exists
            if ($student->avatar && file_exists(public_path($student->avatar))) {
                unlink(public_path($student->avatar));
            }

            $student->delete();

            return response()->json([
                'success' => true,
                'message' => 'Student deleted successfully!'
            ]);
        } catch (\Exception $e) {
            Log::error('Error deleting student: ' . $e->getMessage());
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
            $students = User::role('student')->whereIn('id', $ids)->get();

            foreach ($students as $student) {
                // Delete associated files
                if ($student->avatar && file_exists(public_path($student->avatar))) {
                    unlink(public_path($student->avatar));
                }
                $student->delete();
            }

            return response()->json([
                'success' => true,
                'message' => count($students) . ' students deleted successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Error deleting students: ' . $e->getMessage());
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
            $students = User::role('student')->whereIn('id', $ids)->get();
            return response()->json([
                'success' => true,
                'data' => $students
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching students: ' . $e->getMessage());
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
            'students.*.id' => 'required|exists:users,id',
        ]);

        $updatedCount = 0;

        foreach ($request->input('students') as $studentData) {
            $validator = Validator::make($studentData, [
                'id' => 'required|exists:users,id',
                'name' => 'required|string|max:255',
                'gender' => 'required|in:male,female,other',
                'dob' => 'required|date',
                'grade_level_id' => 'required|exists:grade_levels,id',
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
                $student = User::findOrFail($studentData['id']);
                $validatedData = $validator->validated();

                // Map dob to date_of_birth
                $validatedData['date_of_birth'] = $validatedData['dob'];
                unset($validatedData['dob']);

                $student->update($validatedData);
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

    public function profile(User $student)
    {
        // Ensure the user is a student
        if (!$student->hasRole('student')) {
            abort(404, 'Student not found');
        }

        // Eager load relationships
        $student->load([
            'gradeLevel:id,name',
            'guardians:id,name,phone,email,occupation,address',
        ]);

        // Calculate age
        $student->age = $student->date_of_birth ? \Carbon\Carbon::parse($student->date_of_birth)->age : null;

        // Calculate academic statistics
        $academicStats = $this->calculateAcademicStats($student);

        // Format data for the view
        $formattedData = $this->formatStudentData($student, $academicStats);

        return view('admin.students.profile', $formattedData);
    }

    /**
     * Calculate academic statistics for the student
     */
    private function calculateAcademicStats($student)
    {
        // You can implement your actual logic here based on your application's needs
        // For now, returning placeholder data

        return [
            'gpa' => '3.8',
            'gpa_percentage' => '95.0',
            'attendance_rate' => '92',
            'fee_progress' => '85',
            'present_days' => 46,
            'absent_days' => 4,
            'total_fees' => 1000,
            'paid_fees' => 850,
            'due_fees' => 150,
        ];
    }

    /**
     * Format student data for the view
     */
    private function formatStudentData($student, $academicStats)
    {
        return [
            'student' => $student,
            'academicStats' => $academicStats,
            'recentBookIssues' => collect([]), // Placeholder - implement based on your app
            'recentFees' => collect([]), // Placeholder - implement based on your app
            'recentAttendances' => collect([]), // Placeholder - implement based on your app
            'courseGrades' => collect([]), // Placeholder - implement based on your app
            'guardians' => $student->guardians ?? collect([]),
        ];
    }
}
