<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with(['user', 'section', 'guardians'])->paginate(10);
        return StudentResource::collection($students);
    }

    public function store(StoreStudentRequest $request)
    {
        $student = Student::create($request->validated());
        $student->load(['user', 'section', 'guardians']);
        return new StudentResource($student);
    }

    public function show(Student $student)
    {
        $student->load(['user', 'section', 'guardians']);
        return new StudentResource($student);
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->update($request->validated());
        $student->load(['user', 'section', 'guardians']);
        return new StudentResource($student);
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return response()->json(['message' => 'Student deleted successfully'], 204);
    }

    public function attachGuardian(Request $request, Student $student)
    {
        $request->validate([
            'guardian_id' => 'required|exists:guardians,id',
        ]);

        $student->guardians()->attach($request->guardian_id);
        return response()->json(['message' => 'Guardian attached successfully']);
    }
}