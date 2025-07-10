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

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);
        $viewType = $request->input('view', 'table');
        $users = User::all();
        $sections = Section::all();
        
        $students = Student::with(['user', 'section'])
            ->when($search, function ($query) use ($search) {
                return $query->where('admission_date', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%")
                          ->orWhere('email', 'like', "%{$search}%");
                    })
                    ->orWhereHas('section', function ($q) use ($search) {
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

        return view('students.index', compact('students', 'sections', 'users'));
    }

    public function store(StoreStudentRequest $request)
    {
        try {
            $student = Student::create($request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Student created successfully!',
                'student' => $student->load(['user', 'section'])
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
        $student->load(['user', 'section']);
        return response()->json([
            'success' => true,
            'student' => $student
        ]);
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        try {
            $student->update($request->validated());
            return response()->json([
                'success' => true,
                'message' => 'Student updated successfully',
                'student' => $student->fresh(['user', 'section'])
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
            $count = Student::whereIn('id', $ids)->delete();
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
                'user_id' => 'required|exists:users,id|unique:students,user_id,'.$studentData['id'],
                'section_id' => 'required|exists:sections,id',
                'admission_date' => 'required|date',
            ]);

            if ($validator->fails()) {
                Log::error("Validation failed for student ID {$studentData['id']}: " . json_encode($validator->errors()));
                continue; // Skip invalid
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
            'redirect' => route('students.index')
        ]);
    }
}