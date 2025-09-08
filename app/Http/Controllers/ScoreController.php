<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Models\Student;
use App\Models\Subject;
use App\Models\GradeLevel;
use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ScoreController extends Controller
{
  public function index(Request $request)
  {
    $search = $request->input('search');
    $perPage = $request->input('per_page', 10);
    $viewType = $request->input('view', 'table');
    $semester = now()->month <= 6 ? 1 : 2;
    $query = Score::with(['student', 'exam', 'subject','GradeLevel']);

    // Apply filters
    if ($request->filled('student_id')) {
      $query->where('student_id', $request->student_id);
    }
    if ($request->filled('subject_id')) {
      $query->where('subject_id', $request->subject_id);
    }
    if ($request->filled('exam_id')) {
      $query->where('exam_id', $request->exam_id);
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

    // Apply search
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
          });
      });
    }

    $scores = $query->latest()
      ->paginate($perPage)
      ->appends([
        'search' => $search,
        'per_page' => $perPage,
        'view' => $viewType,
        'student_id' => $request->student_id,
        'exam_id' => $request->exam_id,
        'min_score' => $request->min_score,
        'max_score' => $request->max_score,
        'grade' => $request->grade
      ]);

    $students = Student::orderBy('name')->get();
    $exams = Exam::orderBy('name')->get();
    $subjects = Subject::orderBy('name')->get();

    if ($request->ajax()) {
      $html = [
        'table' => view('admin.scores.partials.table', compact('scores'))->render(),
        'cards' => view('admin.scores.partials.cardlist', compact('scores'))->render(),
        'pagination' => $scores->links()->toHtml()
      ];

      return response()->json([
        'success' => true,
        'html' => $html,
        'view' => $viewType
      ]);
    }

    return view('admin.scores.index', compact('scores', 'students', 'exams', 'subjects', 'semester'));
  }

  // public function create()
  // {
  //   $students = Student::orderBy('name')->get();
  //   $exams = Exam::orderBy('name')->get();

  //   return response()->json([
  //     'success' => true,
  //     'html' => view('admin.scores.partials.create', compact('students', 'exams'))->render()
  //   ]);
  // }

  // public function store(Request $request)
  // {
  //   $validator = Validator::make($request->all(), [
  //     'student_id' => 'required|exists:students,id',
  //     'exam_id' => 'required|exists:exams,id',
  //     'subject_id' => 'required|exists:subjects,id',
  //     'score' => 'required|numeric|min:0',
  //     'grade' => 'nullable|string|max:10',
  //     'remarks' => 'nullable|string|max:255',
  //   ]);

  //   if ($validator->fails()) {
  //     return response()->json([
  //       'success' => false,
  //       'errors' => $validator->errors()
  //     ], 422);
  //   }

  //   // Check if score already exists for this student and exam
  //   $existingScore = Score::where('student_id', $request->student_id)
  //     ->where('exam_id', $request->exam_id)
  //     ->first();

  //   if ($existingScore) {
  //     return response()->json([
  //       'success' => false,
  //       'message' => 'A score already exists for this student and exam combination.'
  //     ], 409);
  //   }

  //   try {
  //     $score = Score::create($validator->validated());

  //     return response()->json([
  //       'success' => true,
  //       'message' => 'Score created successfully!',
  //       'data' => $score
  //     ]);
  //   } catch (\Exception $e) {
  //     return response()->json([
  //       'success' => false,
  //       'message' => 'Failed to create score: ' . $e->getMessage()
  //     ], 500);
  //   }
  // }


  // public function create()
  // {
  //   $students = Student::orderBy('name')->get();
  //   $exams = Exam::orderBy('name')->get();
  //   $subjects = Subject::orderBy('name')->get();
  //   $scores = Score::with(['student', 'exam', 'subject']);
  //   $semester = now()->month <= 6 ? 1 : 2; // Default to current semester

  //   return view('admin.scores.create', compact('students', 'exams', 'subjects', 'semester', 'scores'));

  //   // return response()->json([
  //   //   'success' => true,
  //   //   'html' => view('admin.scores.partials.create', compact('students', 'exams', 'subjects', 'semester'))->render()
  //   // ]);
  // }
  public function create(Request $request)
  {
    $search = $request->input('search');
    $perPage = $request->input('per_page', 10);
    $semester = now()->month <= 6 ? 1 : 2;
    $query = Score::with(['student', 'exam', 'subject']);

    // Apply filters
    if ($request->filled('student_id')) {
      $query->where('student_id', $request->student_id);
    }
    if ($request->filled('subject_id')) {
      $query->where('subject_id', $request->subject_id);
    }
    if ($request->filled('exam_id')) {
      $query->where('exam_id', $request->exam_id);
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

    // Apply search
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
          });
      });
    }

    $scores = $query->latest()
      ->paginate($perPage)
      ->appends([
        'search' => $search,
        'per_page' => $perPage,
        'student_id' => $request->student_id,
        'exam_id' => $request->exam_id,
        'min_score' => $request->min_score,
        'max_score' => $request->max_score,
        'grade' => $request->grade
      ]);

    $students = Student::orderBy('name')->get();
    $exams = Exam::orderBy('name')->get();
    $subjects = Subject::orderBy('name')->get();

    if ($request->ajax()) {
      $html = [
        'table' => view('admin.scores.table', compact('scores'))->render(),
        'pagination' => $scores->links()->toHtml()
      ];

      return response()->json([
        'success' => true,
        'html' => $html,
      ]);
    }

    return view('admin.scores.create', compact('scores', 'students', 'exams', 'subjects', 'semester'));
  }

  // public function store(Request $request)
  // {
  //   // Validate the request data
  //   $validator = Validator::make($request->all(), [
  //     'scores' => 'required|array',
  //     'scores.*.student_id' => 'required|exists:students,id',
  //     'scores.*.exam_id' => 'required|exists:exams,id',
  //     'scores.*.subject_id' => 'required|exists:subjects,id',
  //     'scores.*.semester' => 'required|in:1,2',
  //     'scores.*.score' => 'required|numeric|min:0|max:100',
  //   ]);

  //   if ($validator->fails()) {
  //     return response()->json([
  //       'success' => false,
  //       'errors' => $validator->errors()
  //     ], 422);
  //   }

  //   $createdCount = 0;
  //   $errors = [];

  //   foreach ($request->input('scores') as $scoreData) {
  //     // Skip if score is empty
  //     if (empty($scoreData['score'])) {
  //       continue;
  //     }

  //     try {
  //       // Check if score already exists for this combination
  //       $existingScore = Score::where('student_id', $scoreData['student_id'])
  //         ->where('exam_id', $scoreData['exam_id'])
  //         ->where('subject_id', $scoreData['subject_id'])
  //         ->where('semester', $scoreData['semester'])
  //         ->first();

  //       if ($existingScore) {
  //         $errors[] = "Score already exists for student {$scoreData['student_id']}, subject {$scoreData['subject_id']}, exam {$scoreData['exam_id']}, semester {$scoreData['semester']}";
  //         continue;
  //       }

  //       // Calculate grade based on score (you can customize this)
  //       $grade = $this->calculateGrade($scoreData['score']);
  //       $remarks = $this->getRemarks($grade);

  //       // Create the score
  //       Score::create([
  //         'student_id' => $scoreData['student_id'],
  //         'exam_id' => $scoreData['exam_id'],
  //         'subject_id' => $scoreData['subject_id'],
  //         'semester' => $scoreData['semester'],
  //         'score' => $scoreData['score'],
  //         'grade' => $grade,
  //         'remarks' => $remarks,
  //       ]);

  //       $createdCount++;
  //     } catch (\Exception $e) {
  //       $errors[] = "Failed to create score for student {$scoreData['student_id']}: " . $e->getMessage();
  //     }
  //   }

  //   if (count($errors)) {
  //     return response()->json([
  //       'success' => $createdCount > 0,
  //       'message' => "Created {$createdCount} scores, but encountered some errors",
  //       'errors' => $errors
  //     ], $createdCount > 0 ? 200 : 500);
  //   }

  //   return response()->json([
  //     'success' => true,
  //     'message' => "Successfully created {$createdCount} scores"
  //   ]);
  // }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'exam_id' => 'required|exists:exams,id',
      'semester' => 'required|in:1,2',
      'grade_id' => 'required|exists:grades,id',
      'scores' => 'required|array',
      'scores.*.*.student_id' => 'required|exists:students,id',
      'scores.*.*.subject_id' => 'required|exists:subjects,id',
      'scores.*.*.grade_id' => 'required|exists:grades,id',
      'scores.*.*.score' => 'required|numeric|min:0|max:100',
    ]);

    if ($validator->fails()) {
      return response()->json([
        'success' => false,
        'errors' => $validator->errors()
      ], 422);
    }

    $createdCount = 0;
    $errors = [];

    foreach ($request->input('scores') as $studentId => $subjects) {
      foreach ($subjects as $subjectId => $scoreData) {
        try {
          $existingScore = Score::where([
            'student_id' => $studentId,
            'subject_id' => $subjectId,
            'exam_id' => $request->exam_id,
            'semester' => $request->semester,
            'grade_id' => $request->grade_id,
          ])->first();

          if ($existingScore) {
            $errors[] = "Score already exists for this combination";
            continue;
          }

          $grade = $this->calculateGrade($scoreData['score']);
          $remarks = $this->getRemarks($grade);

          Score::create([
            'student_id' => $studentId,
            'subject_id' => $subjectId,
            'exam_id' => $request->exam_id,
            'semester' => $request->semester,
            'grade_id' => $request->grade_id,
            'score' => $scoreData['score'],
            'grade' => $grade,
            'remarks' => $remarks,
          ]);

          $createdCount++;
        } catch (\Exception $e) {
          $errors[] = "Failed to create score: " . $e->getMessage();
        }
      }
    }

    if (!empty($errors)) {
      return response()->json([
        'success' => $createdCount > 0,
        'message' => "Created {$createdCount} scores, but encountered some errors",
        'errors' => $errors
      ], $createdCount > 0 ? 200 : 500);
    }

    return response()->json([
      'success' => true,
      'message' => "Successfully created {$createdCount} scores"
    ]);
  }

  // Helper method to calculate grade
  private function calculateGrade($score)
  {
    if ($score >= 90) return 'A';
    if ($score >= 80) return 'B';
    if ($score >= 70) return 'C';
    if ($score >= 60) return 'D';
    return 'F';
  }

  // Helper method to get remarks
  private function getRemarks($grade)
  {
    switch ($grade) {
      case 'A':
        return 'Excellent';
      case 'B':
        return 'Good';
      case 'C':
        return 'Average';
      case 'D':
        return 'Below Average';
      default:
        return 'Fail';
    }
  }

  public function show(Score $score)
  {
    $score->load(['student', 'exam']);
    return response()->json([
      'success' => true,
      'html' => view('admin.scores.partials.detail', compact('score'))->render()
    ]);
  }

  public function edit(Score $score)
  {
    $students = Student::orderBy('name')->get();
    $exams = Exam::orderBy('name')->get();

    return response()->json([
      'success' => true,
      'html' => view('admin.scores.partials.edit', compact('score', 'students', 'exams'))->render()
    ]);
  }

  public function update(Request $request, Score $score)
  {
    $validator = Validator::make($request->all(), [
      'student_id' => 'required|exists:students,id',
      'exam_id' => 'required|exists:exams,id',
      'score' => 'required|numeric|min:0',
      'grade' => 'nullable|string|max:10',
      'remarks' => 'nullable|string|max:255',
    ]);

    if ($validator->fails()) {
      return response()->json([
        'success' => false,
        'errors' => $validator->errors()
      ], 422);
    }

    // Check if another score already exists for this student and exam
    $existingScore = Score::where('student_id', $request->student_id)
      ->where('exam_id', $request->exam_id)
      ->where('id', '!=', $score->id)
      ->first();

    if ($existingScore) {
      return response()->json([
        'success' => false,
        'message' => 'A score already exists for this student and exam combination.'
      ], 409);
    }

    try {
      $score->update($validator->validated());

      return response()->json([
        'success' => true,
        'message' => 'Score updated successfully!',
        'data' => $score
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'success' => false,
        'message' => 'Failed to update score: ' . $e->getMessage()
      ], 500);
    }
  }

  public function destroy(Score $score)
  {
    try {
      $score->delete();

      return response()->json([
        'success' => true,
        'message' => 'Score deleted successfully!'
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'success' => false,
        'message' => 'Failed to delete score: ' . $e->getMessage()
      ], 500);
    }
  }

  public function bulkDelete(Request $request)
  {
    $ids = $request->input('ids');

    if (empty($ids)) {
      return response()->json([
        'success' => false,
        'message' => 'No scores selected for deletion'
      ], 400);
    }

    try {
      $count = Score::whereIn('id', $ids)->delete();

      return response()->json([
        'success' => true,
        'message' => $count . ' score(s) deleted successfully!'
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'success' => false,
        'message' => 'Failed to delete scores: ' . $e->getMessage()
      ], 500);
    }
  }

  public function getBulkData(Request $request)
  {
    $ids = $request->input('ids');

    if (empty($ids)) {
      return response()->json([
        'success' => false,
        'message' => 'No scores selected'
      ], 400);
    }

    if (count($ids) > 5) {
      return response()->json([
        'success' => false,
        'message' => 'You can only edit up to 5 scores at a time'
      ], 400);
    }

    try {
      $scores = Score::with(['student', 'exam'])
        ->whereIn('id', $ids)
        ->get();

      $students = Student::orderBy('name')->get();
      $exams = Exam::orderBy('name')->get();

      return response()->json([
        'success' => true,
        'html' => view('admin.scores.partials.bulkedit', compact('scores', 'students', 'exams'))->render()
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'success' => false,
        'message' => 'Failed to load score data: ' . $e->getMessage()
      ], 500);
    }
  }

  public function bulkUpdate(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'scores' => 'required|array',
      'scores.*.id' => 'required|exists:scores,id',
      'scores.*.student_id' => 'required|exists:students,id',
      'scores.*.exam_id' => 'required|exists:exams,id',
      'scores.*.score' => 'required|numeric|min:0',
      'scores.*.grade' => 'nullable|string|max:10',
      'scores.*.remarks' => 'nullable|string|max:255',
    ]);

    if ($validator->fails()) {
      return response()->json([
        'success' => false,
        'errors' => $validator->errors()
      ], 422);
    }

    $updatedCount = 0;
    $errors = [];

    foreach ($request->input('scores') as $scoreData) {
      try {
        $score = Score::find($scoreData['id']);

        // Check for duplicate student+exam combination
        $existingScore = Score::where('student_id', $scoreData['student_id'])
          ->where('exam_id', $scoreData['exam_id'])
          ->where('id', '!=', $scoreData['id'])
          ->first();

        if ($existingScore) {
          $errors[] = "Score for student {$scoreData['student_id']} and exam {$scoreData['exam_id']} already exists";
          continue;
        }

        $score->update([
          'student_id' => $scoreData['student_id'],
          'exam_id' => $scoreData['exam_id'],
          'score' => $scoreData['score'],
          'grade' => $scoreData['grade'] ?? null,
          'remarks' => $scoreData['remarks'] ?? null,
        ]);

        $updatedCount++;
      } catch (\Exception $e) {
        $errors[] = "Failed to update score ID {$scoreData['id']}: " . $e->getMessage();
      }
    }

    if (count($errors) > 0) {
      return response()->json([
        'success' => $updatedCount > 0,
        'message' => "Updated {$updatedCount} scores, but encountered some errors",
        'errors' => $errors
      ], $updatedCount > 0 ? 200 : 500);
    }

    return response()->json([
      'success' => true,
      'message' => "Successfully updated {$updatedCount} scores"
    ]);
  }
}
