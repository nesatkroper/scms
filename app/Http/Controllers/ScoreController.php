<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Models\Student;
use App\Models\Subject;
use App\Models\GradeLevel;
use App\Models\Department;
use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ScoreController extends Controller
{
  public function index(Request $request)
  {
    // Params
    $search   = $request->input('search');
    $perPage  = $request->input('per_page', 10);
    $viewType = $request->input('view', 'table');
    $semester = now()->month <= 6 ? 1 : 2;
    // Query base
    $query = Score::with(['student.department', 'exam', 'subject', 'GradeLevel'])->latest();
    // === Filters ===
    if ($request->filled('department_id')) {
      $query->whereHas('student', function ($q) use ($request) {
        $q->where('department_id', $request->department_id);
      });
    }

    if ($request->filled('student_id')) {
      $query->where('student_id', $request->student_id);
    }

    if ($request->filled('subject_id')) {
      $query->where('subject_id', $request->subject_id);
    }

    if ($request->filled('exam_id')) {
      $query->where('exam_id', $request->exam_id);
    }

    if ($request->filled('gradelevel_id')) {
      $query->whereHas('student', function ($q) use ($request) {
        $q->where('grade_level_id', $request->gradelevel_id);
      });
    }

    if ($request->filled('min_score')) {
      $query->where('score', '>=', $request->min_score);
    }

    if ($request->filled('max_score')) {
      $query->where('score', '<=', $request->max_score);
    }

    if ($request->filled('grade')) {
      $query->where('grade', 'like', '%' . $request->grade . '%');
    }

    // === Search ===
    if ($search) {
      $query->where(function ($q) use ($search) {
        $q->where('score', 'like', "%{$search}%")
          ->orWhere('grade', 'like', "%{$search}%")
          ->orWhere('remarks', 'like', "%{$search}%")
          ->orWhereHas('student', function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%");
          })
          ->orWhereHas('subject', function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%");
          })
          ->orWhereHas('exam', function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%");
          })
          ->orWhereHas('student.department', function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%");
          });
      });
    }

    // === Pagination ===
    $scores = $query->latest()
      ->paginate($perPage)
      ->appends($request->all());

    // Data for filters
    $students    = Student::orderBy('name')->get();
    $exams       = Exam::orderBy('name')->get();
    $subjects    = Subject::orderBy('name')->get();
    $departments = Department::orderBy('name')->get();
    $gradeLevels = GradeLevel::orderBy('name')->get();

    // === Calculate total, average, grade, GPA per student ===
    foreach ($students as $student) {
      $studentScores = $scores->where('student_id', $student->id);

      $total = $studentScores->sum('score');
      $count = $studentScores->count();

      $average = $count > 0 ? round($total / $count, 2) : 0;

      // Grade and GPA
      switch (true) {
        case ($average >= 90):
          $grade = 'A';
          $gpa = 4.0;
          break;
        case ($average >= 80):
          $grade = 'B';
          $gpa = 3.0;
          break;
        case ($average >= 70):
          $grade = 'C';
          $gpa = 2.0;
          break;
        case ($average >= 60):
          $grade = 'D';
          $gpa = 1.0;
          break;
        default:
          $grade = 'F';
          $gpa = 0.0;
          break;
      }

      $student->total_points = $total;
      $student->average = $average;
      $student->grade = $grade;
      $student->gpa = $gpa;
      // Format GPA with 1 decimal place
      $student->gpa = number_format($gpa, 1);
    }

    // === Calculate rank ===
    $ranked = $students->sortByDesc('average')->values();
    $currentRank = 1;
    foreach ($ranked as $index => $stu) {
      if ($index > 0 && $stu->average < $ranked[$index - 1]->average) {
        $currentRank = $index + 1;
      }
      $stu->rank = $currentRank;
    }
    // === Pagination manually (optional) ===
    $studentsPaginated = $students->forPage($request->input('page', 10), $perPage);
    // === Ajax Response ===
    if ($request->ajax()) {
      $html = [
        'table'      => view('admin.scores.partials.table', compact('scores'))->render(),
        'cards'      => view('admin.scores.partials.cardlist', compact('scores'))->render(),
        'pagination' => $studentsPaginated->links()->toHtml(),
      ];

      return response()->json([
        'success' => true,
        'html'    => $html,
        'view'    => $viewType,
      ]);
    }

    // === Normal Response ===
    return view('admin.scores.index', compact(
      'scores',
      'students',
      'exams',
      'subjects',
      'semester',
      'departments',
      'gradeLevels'
    ));
  }

  // public function store(Request $request)
  // {
  //   $request->validate([
  //     'exam_id' => 'required|exists:exams,id',
  //     'semester' => 'required|in:1,2',
  //     'scores' => 'required|array',
  //     'scores.*.student_id' => 'required|exists:students,id',
  //     'scores.*.subject_id' => 'required|exists:subjects,id',
  //     'scores.*.score' => 'nullable|numeric|min:0|max:100',
  //   ]);

  //   foreach ($request->scores as $data) {
  //     // ប្រើ updateOrCreate ដើម្បីបញ្ចូល ឬកែទិន្នន័យចាស់
  //     Score::updateOrCreate(
  //       [
  //         'student_id' => $data['student_id'],
  //         'subject_id' => $data['subject_id'],
  //         'exam_id'    => $request->exam_id,
  //         'semester'   => $request->semester,
  //       ],
  //       [
  //         'score' => $data['score'] ?? null,
  //       ]
  //     );
  //   }

  //   return redirect()->route('admin.scores.index')
  //     ->with('success', 'Scores saved successfully!');
  // }


  public function store(Request $request)
  {
    $request->validate([
      'exam_id' => 'required|exists:exams,id',
      'semester' => 'required|in:1,2',
      'scores' => 'required|array',
    ]);

    foreach ($request->scores as $studentId => $subjects) {
      foreach ($subjects as $subjectId => $data) {
        $scoreValue = $data['score'] ?? 0; // បើ null → 0

        Score::updateOrCreate(
          [
            'student_id' => $studentId,
            'subject_id' => $subjectId,
            'exam_id'    => $request->exam_id,
            'semester'   => $request->semester,
          ],
          [
            'score' => $scoreValue,
          ]
        );
      }
    }


    return redirect()->route('admin.scores.index')
      ->with('success', 'Scores saved successfully!');
  }

  public function show($examId)
  {
    try {
      // Fetch all scores for the given exam
      $scores = Score::with(['student', 'subject'])
        ->where('exam_id', $examId)
        ->get();

      // Get all students and subjects
      $students = Student::orderBy('name')->get();
      $subjects = Subject::orderBy('name')->get();

      // Prepare data: map scores by student_id & subject_id
      $scoreData = [];
      foreach ($scores as $score) {
        $scoreData[$score->student_id][$score->subject_id] = $score->score;
      }

      return response()->json([
        'success' => true,
        'students' => $students,
        'subjects' => $subjects,
        'scores' => $scoreData,
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'success' => false,
        'message' => $e->getMessage()
      ], 500);
    }
  }


  public function update(Request $request)
  {
    $request->validate([
      'exam_id' => 'required|exists:exams,id',
      'semester' => 'required|in:1,2',
      'scores' => 'required|array',
    ]);

    foreach ($request->scores as $studentId => $subjects) {
      foreach ($subjects as $subjectId => $data) {
        Score::updateOrCreate(
          [
            'student_id' => $studentId,
            'subject_id' => $subjectId,
            'exam_id'    => $request->exam_id,
            'semester'   => $request->semester,
          ],
          [
            'score' => $data['score'] ?? null,
          ]
        );
      }
    }

    return redirect()->route('admin.scores.index')
      ->with('success', 'Scores updated successfully!');
  }
}
