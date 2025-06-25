<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentGuardianRequest;
use App\Models\Student;
use App\Models\Guardian;
use Illuminate\Http\Request;



class StudentGuardianController extends Controller
{
    
    public function create(Student $student)
    {
        $guardians = Guardian::all();
        $attachedGuardians = $student->guardians->pluck('id')->toArray();
        return view('student_guardians.create', compact('student', 'guardians', 'attachedGuardians'));
    }

    public function store(StoreStudentGuardianRequest $request)
    {
        $student = Student::findOrFail($request->student_id);
        $guardian = Guardian::findOrFail($request->guardian_id);

        if (!$student->guardians->contains($guardian->id)) {
            $student->guardians()->attach($guardian->id);
            return redirect()->route('students.show', $student)->with('success', 'Guardian attached successfully!');
        }

        return redirect()->route('students.show', $student)->with('info', 'Guardian is already attached to this student.');
    }

    
    public function confirmDetach(Student $student, Guardian $guardian)
    {
        return view('student_guardians.confirm_detach', compact('student', 'guardian'));
    }

    
    public function destroy(Student $student, Guardian $guardian)
    {
        $student->guardians()->detach($guardian->id);
        return redirect()->route('students.show', $student)->with('success', 'Guardian detached successfully!');
    }
}
