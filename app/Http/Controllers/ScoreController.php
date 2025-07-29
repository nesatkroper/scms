<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Models\Student;
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

    $query = Score::with(['student', 'exam']);

    // Apply filters
    if ($request->filled('student_id')) {
      $query->where('student_id', $request->student_id);
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

    return view('admin.scores.index', compact('scores', 'students', 'exams'));
  }

  public function create()
  {
    $students = Student::orderBy('name')->get();
    $exams = Exam::orderBy('name')->get();

    return response()->json([
      'success' => true,
      'html' => view('admin.scores.partials.create', compact('students', 'exams'))->render()
    ]);
  }

  public function store(Request $request)
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

    // Check if score already exists for this student and exam
    $existingScore = Score::where('student_id', $request->student_id)
      ->where('exam_id', $request->exam_id)
      ->first();

    if ($existingScore) {
      return response()->json([
        'success' => false,
        'message' => 'A score already exists for this student and exam combination.'
      ], 409);
    }

    try {
      $score = Score::create($validator->validated());

      return response()->json([
        'success' => true,
        'message' => 'Score created successfully!',
        'data' => $score
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'success' => false,
        'message' => 'Failed to create score: ' . $e->getMessage()
      ], 500);
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
