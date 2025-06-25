<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentGuardianRequest;
use App\Http\Resources\StudentGuardianResource;
use App\Models\Student;

class StudentGuardianController extends Controller
{
    public function store(StoreStudentGuardianRequest $request)
    {
        $student = Student::findOrFail($request->student_id);
        $student->guardians()->attach($request->guardian_id);
        return new StudentGuardianResource($request->validated());
    }

    public function destroy(Student $student, Guardian $guardian)
    {
        $student->guardians()->detach($guardian->id);
        return response()->json(['message' => 'Student-Guardian relationship deleted'], 204);
    }
}