<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScoreRequest;
use App\Models\Score;
use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ScoreController extends Controller
{
  public function index(Request $request)
  {
    $examId = $request->input('exam_id');
    $perPage = $request->input('per_page', 8);
    $search = $request->input('search');

    $exam = Exam::with('courseOffering.students')->findOrFail($examId);

    $studentsQuery = $exam->courseOffering->students();

    // Optional search
    if ($search) {
      $studentsQuery = $studentsQuery->where(function ($q) use ($search) {
        $q->where('name', 'like', "%{$search}%")
          ->orWhere('email', 'like', "%{$search}%");
      });
    }

    // Eager load score for this exam
    $students = $studentsQuery->with(['scores' => function ($q) use ($examId) {
      $q->where('exam_id', $examId);
    }])->paginate($perPage)->appends($request->query());

    return view('admin.scores.index', compact('students', 'exam'));
  }

  public function store(ScoreRequest $request)
  {
    $data = $request->validated();

    // Auto assign grade
    $score = $data['score'];
    if ($score >= 90) $data['grade'] = 'A+';
    elseif ($score >= 80) $data['grade'] = 'A';
    elseif ($score >= 70) $data['grade'] = 'B+';
    elseif ($score >= 60) $data['grade'] = 'B';
    elseif ($score >= 50) $data['grade'] = 'C+';
    elseif ($score >= 40) $data['grade'] = 'C';
    elseif ($score >= 30) $data['grade'] = 'D';
    else $data['grade'] = 'F';

    try {
      Score::updateOrCreate(
        ['student_id' => $data['student_id'], 'exam_id' => $data['exam_id']],
        $data
      );

      return redirect()->route('admin.scores.index', ['exam_id' => $data['exam_id']])
        ->with('success', 'Score saved successfully!');
    } catch (\Exception $e) {
      Log::error('Error saving score: ' . $e->getMessage());
      return redirect()->route('admin.scores.index', ['exam_id' => $data['exam_id']])
        ->with('error', 'Failed to save score.')->withInput();
    }
  }
}
