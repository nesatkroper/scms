<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScoreRequest;
use App\Models\Score;
use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
}
