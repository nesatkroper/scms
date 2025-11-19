<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Score;
use App\Models\User;
use App\Models\Exam;
use App\Models\CourseOffering;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ScoreController extends Controller
{
  public function index()
  {
    $scores = Score::with(['student', 'exam', 'courseOffering'])
      ->latest()
      ->paginate(15);

    return view('admin.scores.index', compact('scores'));
  }

  public function create()
  {
    $exams = Exam::orderBy('name')->get();
    $courseOfferings = CourseOffering::with(['subject', 'teacher'])->get();

    $semesters = [
      'Fall 2025',
      'Spring 2025',
      'Summer 2024',
      'Fall 2024'
    ];

    $students = collect();
    $selectedExamId = null;
    $selectedCourseOfferingId = null;
    $selectedSemester = null;

    return view('admin.scores.create', compact(
      'exams',
      'courseOfferings',
      'semesters',
      'students',
      'selectedExamId',
      'selectedCourseOfferingId',
      'selectedSemester'
    ));
  }

  public function filterStudents(Request $request)
  {
    $request->validate([
      'exam_id' => ['required', 'exists:exams,id'],
      'course_offering_id' => ['required', 'exists:course_offerings,id'],
      'semester' => ['required', 'string', 'max:50'],
    ]);

    $selectedExamId = $request->input('exam_id');
    $selectedCourseOfferingId = $request->input('course_offering_id');
    $selectedSemester = $request->input('semester');

    $courseOffering = CourseOffering::with('students')->find($selectedCourseOfferingId);

    if (!$courseOffering) {
      return redirect()->back()->with('error', 'Course Offering not found.');
    }

    $allStudents = $courseOffering->students;

    $recordedStudentIds = Score::where('exam_id', $selectedExamId)
      ->where('course_offering_id', $selectedCourseOfferingId)
      ->where('semester', $selectedSemester)
      ->pluck('student_id')
      ->toArray();

    $students = $allStudents->map(function ($student) use ($recordedStudentIds) {
      $student->score_recorded = in_array($student->id, $recordedStudentIds);
      return $student;
    });

    $exams = Exam::orderBy('name')->get();
    $courseOfferings = CourseOffering::with(['subject', 'teacher'])->get();
    $semesters = ['Fall 2025', 'Spring 2025', 'Summer 2024', 'Fall 2024'];

    return view('admin.scores.create', compact(
      'exams',
      'courseOfferings',
      'semesters',
      'students',
      'selectedExamId',
      'selectedCourseOfferingId',
      'selectedSemester'
    ));
  }

  public function store(Request $request)
  {
    $request->validate([
      'exam_id' => ['required', 'exists:exams,id'],
      'course_offering_id' => ['required', 'exists:course_offerings,id'],
      'semester' => ['required', 'string', 'max:50'],
      'scores' => ['required', 'array'],
      'scores.*.student_id' => ['required', 'exists:users,id'],
      'scores.*.score' => ['nullable', 'numeric', 'min:0'],
      'scores.*.grade' => ['nullable', 'string', 'max:10'],
      'scores.*.remarks' => ['nullable', 'string', 'max:500'],
    ]);

    $examId = $request->input('exam_id');
    $courseOfferingId = $request->input('course_offering_id');
    $semester = $request->input('semester');
    $scoreEntries = $request->input('scores');
    $createdCount = 0;
    $updatedCount = 0;

    DB::beginTransaction();
    try {
      foreach ($scoreEntries as $entry) {
        if (isset($entry['score']) || isset($entry['grade']) || isset($entry['remarks'])) {

          $data = [
            'student_id' => $entry['student_id'],
            'exam_id' => $examId,
            'course_offering_id' => $courseOfferingId,
            'semester' => $semester,
            'score' => $entry['score'] ?? null,
            'grade' => $entry['grade'] ?? null,
            'remarks' => $entry['remarks'] ?? null,
          ];

          $existingScore = Score::where('student_id', $entry['student_id'])
            ->where('exam_id', $examId)
            ->where('course_offering_id', $courseOfferingId)
            ->where('semester', $semester)
            ->first();

          if ($existingScore) {
            $existingScore->update($data);
            $updatedCount++;
          } else {
            Score::create($data);
            $createdCount++;
          }
        }
      }
      DB::commit();
    } catch (\Exception $e) {
      DB::rollBack();
      return redirect()->back()
        ->withInput()
        ->with('error', 'Error saving scores: ' . $e->getMessage());
    }

    return redirect()->route('admin.scores.index')
      ->with('success', "Score batch saved successfully! ($createdCount created, $updatedCount updated).");
  }

  public function edit(Score $score)
  {
    $students = User::role('student')
      ->orderBy('name')
      ->get();
    $exams = Exam::orderBy('name')->get();
    $courseOfferings = CourseOffering::with(['subject', 'teacher'])->get();

    return view('admin.scores.edit', compact('score', 'students', 'exams', 'courseOfferings'));
  }

  public function update(Request $request, Score $score)
  {
    $validated = $request->validate([
      'student_id' => ['required', 'exists:users,id'],
      'exam_id' => ['required', 'exists:exams,id'],
      'course_offering_id' => ['required', 'exists:course_offerings,id'],
      'semester' => ['required', 'string', 'max:50'],
      'score' => ['required', 'numeric', 'min:0'],
      'grade' => ['nullable', 'string', 'max:10'],
      'remarks' => ['nullable', 'string', 'max:500'],
    ]);

    $score->update($validated);

    return redirect()->route('admin.scores.index')
      ->with('success', 'Score updated successfully!');
  }

  public function destroy(Score $score)
  {
    $score->delete();

    return redirect()->route('admin.scores.index')
      ->with('success', 'Score deleted successfully!');
  }
}
