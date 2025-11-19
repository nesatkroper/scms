<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeacherSubject;
use App\Models\User;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class TeacherSubjectController extends Controller
{
  private $timeSlots = ['morning', 'afternoon', 'evening'];

  public function index()
  {
    $assignments = TeacherSubject::with(['teacher', 'subject'])->paginate(15);
    return view('admin.assignments.index', compact('assignments'));
  }

  public function create()
  {
    $teachers = User::role('teacher')->orderBy('name')->get();
    $subjects = Subject::orderBy('name')->get();
    $timeSlots = $this->timeSlots;

    return view('admin.assignments.create', compact('teachers', 'subjects', 'timeSlots'));
  }

  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'teacher_id' => ['required', 'exists:users,id'],
      'subject_id' => ['required', 'exists:subjects,id'],
      'time_slot' => ['required', Rule::in($this->timeSlots)],
    ]);

    if (
      TeacherSubject::where('teacher_id', $validatedData['teacher_id'])
        ->where('subject_id', $validatedData['subject_id'])
        ->exists()
    ) {
      return redirect()->back()->with('error', 'This subject is already assigned to this teacher.')->withInput();
    }

    try {
      TeacherSubject::create($validatedData);
      return redirect()->route('admin.assignments.index')->with('success', 'Assignment created successfully.');
    } catch (\Exception $e) {
      Log::error('Error creating assignment: ' . $e->getMessage());
      return redirect()->back()->with('error', 'Error creating assignment.')->withInput();
    }
  }

  public function edit($teacher_id, $subject_id)
  {
    $assignment = TeacherSubject::where('teacher_id', $teacher_id)
      ->where('subject_id', $subject_id)
      ->firstOrFail();

    $teachers = User::role('teacher')->orderBy('name')->get();
    $subjects = Subject::orderBy('name')->get();
    $timeSlots = $this->timeSlots;

    return view('admin.assignments.edit', compact('assignment', 'teachers', 'subjects', 'timeSlots'));
  }

  public function update(Request $request, $teacher_id, $subject_id)
  {
    $assignment = TeacherSubject::where('teacher_id', $teacher_id)
      ->where('subject_id', $subject_id)
      ->firstOrFail();

    $validatedData = $request->validate([
      'teacher_id' => ['required', 'exists:users,id'],
      'subject_id' => ['required', 'exists:subjects,id'],
      'time_slot' => ['required', Rule::in($this->timeSlots)],
    ]);

    if (
      ($validatedData['teacher_id'] != $assignment->teacher_id ||
        $validatedData['subject_id'] != $assignment->subject_id) &&
      TeacherSubject::where('teacher_id', $validatedData['teacher_id'])
        ->where('subject_id', $validatedData['subject_id'])
        ->exists()
    ) {
      return redirect()->back()->with('error', 'The combination of this teacher and subject already exists.')->withInput();
    }

    try {
      $assignment->update($validatedData);
      return redirect()->route('admin.assignments.index')->with('success', 'Assignment updated successfully.');
    } catch (\Exception $e) {
      Log::error('Error updating assignment: ' . $e->getMessage());
      return redirect()->back()->with('error', 'Error updating assignment.')->withInput();
    }
  }

  public function destroy($teacher_id, $subject_id)
  {
    $assignment = TeacherSubject::where('teacher_id', $teacher_id)
      ->where('subject_id', $subject_id)
      ->firstOrFail();

    try {
      $assignment->delete();
      return redirect()->route('admin.assignments.index')->with('success', 'Assignment deleted successfully.');
    } catch (\Exception $e) {
      Log::error('Error deleting assignment: ' . $e->getMessage());
      return redirect()->back()->with('error', 'Error deleting assignment.');
    }
  }
}
