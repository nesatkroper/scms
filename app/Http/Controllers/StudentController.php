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
        $perPage = $request->input('per_page', 12);
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
                $photoPath = 'photos/student/' . $photoName;
                $validated['photo'] = $photoPath;
            }

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'gender' => $validated['gender'],
                'date_of_birth' => $validated['dob'],
                'password' => Hash::make('password'),
                'avatar' => $validated['photo'] ?? null,
            ]);
            $user->assignRole('student');
            $validated['user_id'] = $user->id;
            $student = Student::create($validated);
            return response()->json([
                'success' => true,
                'message' => 'Student created successfully!',
                'data' => $student
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
        $student->age = \Carbon\Carbon::parse($student->dob)->age;
        return response()->json([
            'success' => true,
            'data' => $student
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

            $student->update($data);
            if ($student->user) {
                $student->user->update([
                    'name' => $data['name'] ?? $student->name,
                    'email' => $data['email'] ?? $student->email,
                    'phone' => $data['phone'] ?? $student->phone,
                    'gender' => $data['gender'] ?? $student->gender,
                    'date_of_birth' => $data['dob'] ?? $student->dob,
                    'avatar' => $data['photo'] ?? $student->photo,
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Student updated successfully',
                'data' => $student->fresh('gradeLevel')
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
            if ($student->user) {
                $student->user->delete();
            }
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
                if ($student->user) {
                    $student->user->delete();
                }
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

    // ========

    public function profile(Student $student)
    {
        // Eager load all relationships with necessary fields
        $student->load([
            'user:id,name,email,phone,gender,date_of_birth,avatar',
            'gradeLevel:id,name',
            'guardians:id,name,phone,email,occupation,address',
            // 'courseOfferings:id,name',
            // 'bookIssues:id,book_title,issued_at,due_date,returned_at,status',
            // 'attendances:id,date,status,remarks',
            // 'grades:id,subject,score',
            // 'studentFees:id,fee_type,amount,paid_at,status'
        ]);

        // Calculate age
        $student->age = $student->dob ? \Carbon\Carbon::parse($student->dob)->age : null;

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
        // Calculate overall GPA (example logic)
        $totalGrades = $student->grades->count();
        $sumGrades = $student->grades->sum('score');
        $gpa = $totalGrades > 0 ? $sumGrades / $totalGrades : 0;
        $gpaPercentage = ($gpa / 100) * 4; // Convert to 4.0 scale

        // Calculate attendance rate
        $totalAttendance = $student->attendances->count();
        $presentAttendance = $student->attendances->where('status', 'present')->count();
        $attendanceRate = $totalAttendance > 0 ? ($presentAttendance / $totalAttendance) * 100 : 0;

        // Calculate fee payment progress
        $totalFees = $student->studentFees->sum('amount');
        $paidFees = $student->studentFees->where('status', 'paid')->sum('amount');
        $feeProgress = $totalFees > 0 ? ($paidFees / $totalFees) * 100 : 0;

        return [
            'gpa' => number_format($gpaPercentage, 1),
            'gpa_percentage' => number_format($gpa, 1),
            'attendance_rate' => number_format($attendanceRate, 0),
            'fee_progress' => number_format($feeProgress, 0),
            'present_days' => $presentAttendance,
            'absent_days' => $totalAttendance - $presentAttendance,
            'total_fees' => $totalFees,
            'paid_fees' => $paidFees,
            'due_fees' => $totalFees - $paidFees,
        ];
    }

    /**
     * Format student data for the view
     */
    private function formatStudentData($student, $academicStats)
    {
        // Get recent activities (last 5 of each type)
        $recentBookIssues = $student->bookIssues->sortByDesc('issued_at')->take(5);
        $recentFees = $student->studentFees->sortByDesc('paid_at')->take(5);
        $recentAttendances = $student->attendances->sortByDesc('date')->take(10);

        // Get course grades with calculated letter grades
        $courseGrades = $student->courseOfferings->map(function ($course) use ($student) {
            $grade = $student->grades->where('subject', $course->name)->first();
            return [
                'name' => $course->name,
                'grade' => $grade ? $this->calculateLetterGrade($grade->score) : 'N/A',
                'score' => $grade ? $grade->score : 0,
                'progress' => $grade ? $grade->score : 0,
            ];
        });

        return [
            'student' => $student,
            'academicStats' => $academicStats,
            'recentBookIssues' => $recentBookIssues,
            'recentFees' => $recentFees,
            'recentAttendances' => $recentAttendances,
            'courseGrades' => $courseGrades,
            'guardians' => $student->guardians,
        ];
    }

    /**
     * Calculate letter grade based on score
     */
    private function calculateLetterGrade($score)
    {
        if ($score >= 90) return 'A';
        if ($score >= 80) return 'B';
        if ($score >= 70) return 'C';
        if ($score >= 60) return 'D';
        return 'F';
    }
}
