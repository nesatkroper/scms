<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ScoreExport;
use App\Models\CourseOffering;
use App\Models\Enrollment;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Score;
use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;

class ScoreController extends BaseController
{
  public function __construct()
  {
    parent::__construct();
    $this->applyPermissions();
  }

  protected function ModelPermissionName(): string
  {
    return 'Score';
  }

  public function index(Request $request)
  {
    $examId = $request->input('exam_id');
    $search = $request->input('search');
    $exam = Exam::with('courseOffering.students')->findOrFail($examId);

    $studentsQuery = $exam->courseOffering->students();

    if ($studentsQuery->count() === 0) {
      return redirect()
        ->route('admin.enrollments.create', ['course_offering_id' => $exam->courseOffering->id])
        ->with('error', 'You need to enroll student first.');
    }

    if ($search) {
      $studentsQuery = $studentsQuery->where(function ($q) use ($search) {
        $q->where('name', 'like', "%{$search}%")
          ->orWhere('email', 'like', "%{$search}%");
      });
    }

    $students = $studentsQuery->with([
      'scores' => function ($q) use ($examId) {
        $q->where('exam_id', $examId);
      }
    ])->get();

    return view('admin.scores.index', compact('students', 'exam'));
  }

  public function exportExamScores($examId)
  {
    $exam = Exam::with('courseOffering')->findOrFail($examId);

    $fileName = 'Scores_' . $exam->title . '_' . $exam->courseOffering->subject->name . '.xlsx';

    return Excel::download(new ScoreExport($examId), $fileName);
  }

  public function saveAll(Request $request)
  {
    $examId = $request->exam_id;
    $exam = Exam::with('courseOffering.students')->findOrFail($examId);

    foreach ($exam->courseOffering->students as $student) {
      $scoreValue = $request->input("score_{$student->id}", 0);
      $remarks = $request->input("remarks_{$student->id}");

      if ($scoreValue >= 90) $grade = 'A+';
      elseif ($scoreValue >= 80) $grade = 'A';
      elseif ($scoreValue >= 70) $grade = 'B+';
      elseif ($scoreValue >= 60) $grade = 'B';
      elseif ($scoreValue >= 50) $grade = 'C+';
      elseif ($scoreValue >= 40) $grade = 'C';
      elseif ($scoreValue >= 30) $grade = 'D';
      else $grade = 'F';

      Score::updateOrCreate(
        ['student_id' => $student->id, 'exam_id' => $examId],
        [
          'score'   => $scoreValue,
          'grade'   => $grade,
          'remarks' => $remarks,
        ]
      );
    }

    return back()->with('success', 'All scores saved successfully!');
  }

  public function assignFinalGrades(Request $request)
  {
    $courseOfferingId = $request->course_offering_id;

    $courseOffering = CourseOffering::with([
      'students',
      'students.scores' => function ($q) use ($courseOfferingId) {
        $q->whereHas('exam', function ($examQuery) use ($courseOfferingId) {
          $examQuery->where('course_offering_id', $courseOfferingId);
        });
      }
    ])->findOrFail($courseOfferingId);

    foreach ($courseOffering->students as $student) {

      $scores = $student->scores;

      if ($scores->count() === 0) {
        continue;
      }

      $finalScore = round($scores->avg('score'));

      if ($finalScore >= 90) $finalGrade = 'A+';
      elseif ($finalScore >= 80) $finalGrade = 'A';
      elseif ($finalScore >= 70) $finalGrade = 'B+';
      elseif ($finalScore >= 60) $finalGrade = 'B';
      elseif ($finalScore >= 50) $finalGrade = 'C+';
      elseif ($finalScore >= 40) $finalGrade = 'C';
      elseif ($finalScore >= 30) $finalGrade = 'D';
      else $finalGrade = 'F';

      Enrollment::where('student_id', $student->id)
        ->where('course_offering_id', $courseOfferingId)
        ->update([
          'grade_final' => $finalGrade,
          'remarks'     => "Final grade auto-calculated",
        ]);
    }

    return back()->with('success', 'Final grades assigned successfully!');
  }
}
