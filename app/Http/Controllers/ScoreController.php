<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Models\Student;
use App\Models\Exam;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
  public function index(Request $request)
  {
    $query = Score::with(['student', 'exam'])->withTrashed();

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

    $scores = $query->latest()->get();

    $students = Student::orderBy('name')->get();
    $exams = Exam::orderBy('name')->get();

    return view('admin.scores.index', compact('scores', 'students', 'exams'));
  }

  public function create()
  {
    $students = Student::all();
    $exams = Exam::all();

    return view('admin.scores.create', compact('students', 'exams'));
  }

  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'student_id' => 'required|exists:students,id',
      'exam_id' => 'required|exists:exams,id',
      'score' => 'required|integer|min:0',
      'grade' => 'nullable|string|max:10',
      'remarks' => 'nullable|string',
    ]);

    $existingScore = Score::where('student_id', $validatedData['student_id'])
      ->where('exam_id', $validatedData['exam_id'])
      ->first();

    if ($existingScore) {
      return redirect()->back()->withErrors(['message' => 'Score for this student and exam already exists.'])->withInput();
    }

    Score::create($validatedData);

    return redirect()->route('admin.scores.index')->with('success', 'Score recorded successfully!');
  }

  public function show(Score $score)
  {
    $score->load(['student', 'exam']);

    return view('admin.scores.show', compact('score'));
  }

  public function edit(Score $score)
  {
    $students = Student::all();
    $exams = Exam::all();

    return view('admin.scores.edit', compact('score', 'students', 'exams'));
  }

  public function update(Request $request, Score $score)
  {
    $validatedData = $request->validate([
      'student_id' => 'required|exists:students,id',
      'exam_id' => 'required|exists:exams,id',
      'score' => 'required|integer|min:0',
      'grade' => 'nullable|string|max:10',
      'remarks' => 'nullable|string',
    ]);

    $existingScore = Score::where('student_id', $validatedData['student_id'])
      ->where('exam_id', $validatedData['exam_id'])
      ->where('id', '!=', $score->id)
      ->first();

    if ($existingScore) {
      return redirect()->back()->withErrors(['message' => 'Score for this student and exam already exists.'])->withInput();
    }

    $score->update($validatedData);

    return redirect()->route('admin.scores.index')->with('success', 'Score updated successfully!');
  }

  public function destroy(Score $score)
  {
    $score->delete();

    return redirect()->route('admin.scores.index')->with('success', 'Score deleted successfully!');
  }
}