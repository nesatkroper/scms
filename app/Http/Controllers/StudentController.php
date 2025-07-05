<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use App\Models\User;     
use App\Models\Section;  
use App\Models\Guardian; 
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with(['user', 'section', 'guardians'])->paginate(10);
        return view('students.index', compact('students'));
    }

    public function create()
    {
        $users = User::all(); 
        $sections = Section::all();
        $guardians = Guardian::all(); 
        return view('students.partials.create', compact('users', 'sections', 'guardians'));
    }

    public function store(StoreStudentRequest $request)
    {
        $student = Student::create($request->validated());

        
        if ($request->has('guardian_ids') && is_array($request->guardian_ids)) {
            $student->guardians()->attach($request->guardian_ids);
        }

        return redirect()->route('students.index')->with('success', 'Student created successfully!');
    }

    public function show(Student $student)
    {
        $student->load(['user', 'section', 'guardians']);
        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        $student->load(['user', 'section', 'guardians']);
        $users = User::all();
        $sections = Section::all();
        $guardians = Guardian::all();
        $attachedGuardians = $student->guardians->pluck('id')->toArray();

        return view('students.edit', compact('student', 'users', 'sections', 'guardians', 'attachedGuardians'));
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->update($request->validated());

        
        if ($request->has('guardian_ids') && is_array($request->guardian_ids)) {
            $student->guardians()->sync($request->guardian_ids);
        } else {
            $student->guardians()->detach(); 
        }

        return redirect()->route('students.show', $student)->with('success', 'Student updated successfully!');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    }

    
    public function attachGuardianForm(Student $student)
    {
        $guardians = Guardian::all();
        $attachedGuardians = $student->guardians->pluck('id')->toArray();
        return view('students.attach_guardian', compact('student', 'guardians', 'attachedGuardians'));
    }

    public function attachGuardian(Request $request, Student $student)
    {
        $request->validate([
            'guardian_id' => 'required|exists:guardians,id',
        ]);

        if (!$student->guardians->contains($request->guardian_id)) {
            $student->guardians()->attach($request->guardian_id);
            return redirect()->route('students.show', $student)->with('success', 'Guardian attached successfully!');
        }
        return redirect()->route('students.show', $student)->with('info', 'Guardian already attached.');
    }

    public function detachGuardian(Student $student, Guardian $guardian)
    {
        $student->guardians()->detach($guardian->id);
        return redirect()->route('students.show', $student)->with('success', 'Guardian detached successfully!');
    }
}
