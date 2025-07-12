<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Support\Facades\Log;
use App\Models\Student;
use App\Models\Section;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);
        $viewType = $request->input('view', 'table');
        $sections = Section::all();
        $users = User::all();

        $students = Student::with(['section', 'user'])
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('admission_date', 'like', "%{$search}%")
                    ->orWhereHas('section', function($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('user', function($q) use ($search) {
                        $q->where('email', 'like', "%{$search}%");
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
                'table' => view('students.partials.table', compact('students'))->render(),
                'cards' => view('students.partials.cardlist', compact('students'))->render(),
                'pagination' => $students->links()->toHtml()
            ];

            return response()->json([
                'success' => true,
                'html' => $html,
                'view' => $viewType
            ]);
        }

        return view('students.index', compact('students','users', 'sections'));
    }

    public function store(StoreStudentRequest $request)
    {
        try {
            // Handle image upload
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('student_images', 'public');
            }

            // Create user first
            $user = User::create([
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => 'student',
            ]);

            // Create student with user relationship
            $student = $user->student()->create([
                'name' => $request->name,
                'image' => $imagePath,
                'admission_date' => $request->admission_date,
                'section_id' => $request->section_id,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Student created successfully!',
                'student' => $student->load(['section', 'user'])
            ]);
        } catch (\Exception $e) {
            // Clean up if there's an error
            if (isset($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            if (isset($user)) {
                $user->delete();
            }

            return response()->json([
                'success' => false,
                'message' => 'Error creating student: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show(Student $student)
    {
        $student->load(['section', 'user']);
        return response()->json([
            'success' => true,
            'student' => $student
        ]);
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        try {
            $data = $request->validated();
            
            // Handle image upload if new image is provided
            if ($request->hasFile('image')) {
                // Delete old image if it exists
                if ($student->image) {
                    Storage::disk('public')->delete($student->image);
                }
                $data['image'] = $request->file('image')->store('student_images', 'public');
            }

            // Update student
            $student->update($data);

            // Update user email if changed
            if ($request->has('email')) {
                $student->user->update(['email' => $request->email]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Student updated successfully',
                'student' => $student->fresh(['section', 'user'])
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
            // Delete associated user
            $user = $student->user;
            
            // Delete image if exists
            if ($student->image) {
                Storage::disk('public')->delete($student->image);
            }
            
            $student->delete();
            $user->delete();

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
            $students = Student::whereIn('id', $ids)->with('user')->get();
            $count = 0;

            foreach ($students as $student) {
                // Delete image if exists
                if ($student->image) {
                    Storage::disk('public')->delete($student->image);
                }
                
                // Delete student and user
                $student->user->delete();
                $student->delete();
                $count++;
            }

            return response()->json([
                'success' => true,
                'message' => $count . ' students deleted successfully'
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
            $students = Student::with(['section', 'user'])->whereIn('id', $ids)->get();
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
                'name' => 'sometimes|string|max:255',
                'email' => [
                    'sometimes',
                    'email',
                    Rule::unique('users', 'email')->ignore(Student::find($studentData['id'])->user_id, 'id'),
                ],
                'admission_date' => 'sometimes|date',
                'section_id' => 'sometimes|exists:sections,id',
            ]);

            if ($validator->fails()) {
                Log::error("Validation failed for student ID {$studentData['id']}: " . json_encode($validator->errors()));
                continue; // Skip invalid
            }

            try {
                $student = Student::findOrFail($studentData['id']);
                
                // Update student data
                $student->update([
                    'name' => $studentData['name'] ?? $student->name,
                    'admission_date' => $studentData['admission_date'] ?? $student->admission_date,
                    'section_id' => $studentData['section_id'] ?? $student->section_id,
                ]);

                // Update user email if provided
                if (isset($studentData['email'])) {
                    $student->user->update(['email' => $studentData['email']]);
                }

                $updatedCount++;
            } catch (\Exception $e) {
                Log::error("Error updating student: " . $e->getMessage());
            }
        }

        return response()->json([
            'success' => true,
            'message' => "Successfully updated $updatedCount students",
            'redirect' => route('students.index')
        ]);
    }
}