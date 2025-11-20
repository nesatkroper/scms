<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScoreRequest;
use App\Models\Score;
use App\Models\Exam;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ScoreController extends Controller
{
  public function index(Request $request)
  {
    $search = $request->input('search');
    $examId = $request->input('exam_id');
    $perPage = $request->input('per_page', 8);

    $exam = Exam::findOrFail($examId);

    $scores = Score::query()
      ->with(['student:id,name', 'exam:id,name'])
      ->when($search, function ($query) use ($search) {
        $query->where('grade', 'like', "%{$search}%")
          ->orWhere('remarks', 'like', "%{$search}%")
          ->orWhereHas('student', function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%");
          })
          ->orWhereHas('exam', function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%");
          });
      })
      ->when($examId, function ($query) use ($examId) {
        $query->where('exam_id', $examId);
      })
      ->orderBy('created_at', 'desc')
      ->paginate($perPage)
      ->appends($request->query());

    return view('admin.scores.index', compact('scores', 'exam'));
  }


  public function create(Request $request)
  {
    $students = User::role('student')->orderBy('name')->get(['id', 'name']);

    $examId = $request->input('exam_id');
    $exam = null;

    if ($examId) {
      $exam = Exam::findOrFail($examId, ['id', 'type']);
    }

    $grades = ['A+', 'A', 'B+', 'B', 'C+', 'C', 'D', 'F'];

    return view('admin.scores.create', compact(
      'students',
      'exam',
      'grades',
      'examId'
    ));
  }


  public function store(ScoreRequest $request)
  {
    $exists = Score::where('student_id', $request->student_id)
      ->where('exam_id', $request->exam_id)
      ->exists();

    if ($exists) {
      return redirect()->route('admin.scores.create', ['exam_id' => $request->exam_id])
        ->with('error', 'A score for this student in this exam already exists.')
        ->withInput();
    }

    try {
      Score::create($request->validated());
      return redirect()->route('admin.scores.index', ['exam_id' => $request->exam_id])->with('success', 'Score recorded successfully!');
    } catch (\Exception $e) {
      Log::error('Error creating Score: ' . $e->getMessage());
      return redirect()->route('admin.scores.create', ['exam_id' => $request->exam_id])->with('error', 'Error recording score.')->withInput();
    }
  }


  public function edit($student_id, $exam_id)
  {
    $score = Score::where('student_id', $student_id)
      ->where('exam_id', $exam_id)
      ->firstOrFail();

    $student = User::findOrFail($student_id, ['id', 'name']);
    $exam = Exam::findOrFail($exam_id, ['id', 'name']);

    $grades = ['A+', 'A', 'B+', 'B', 'C+', 'C', 'D', 'F'];

    return view('admin.scores.edit', compact('score', 'student', 'exam', 'grades'));
  }

  public function update(ScoreRequest $request, $student_id, $exam_id)
  {
    $score = Score::where('student_id', $student_id)
      ->where('exam_id', $exam_id)
      ->firstOrFail();

    $score->update($request->validated());
    return redirect()->route('admin.scores.index', ['exam_id' => $exam_id])->with('success', 'Score updated successfully');
  }

  public function destroy($student_id, $exam_id)
  {
    $score = Score::where('student_id', $student_id)
      ->where('exam_id', $exam_id)
      ->firstOrFail();

    $examId = $score->exam_id;
    $score->delete();

    return redirect()->route('admin.scores.index', ['exam_id' => $examId])->with('success', 'Score deleted successfully');
  }
}
