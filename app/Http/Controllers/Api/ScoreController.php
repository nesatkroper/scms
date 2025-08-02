<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Score;
use App\Models\Student;
use App\Models\Exam;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
  public function index()
  {
    $scores = Score::with(['student', 'exam'])->latest()->get();
    return response()->json($scores);
  }

  public function create()
  {
    $students = Student::all();
    $exams = Exam::all();
    return response()->json(['students' => $students, 'exams' => $exams]);
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
      return response()->json(['message' => 'Score for this student and exam already exists.'], 409);
    }

    $score = Score::create($validatedData);

    return response()->json($score, 201);
  }

  public function show(Score $score)
  {
    $score->load(['student', 'exam']);
    return response()->json($score);
  }

  public function edit(Score $score)
  {
    $students = Student::all();
    $exams = Exam::all();
    return response()->json(['score' => $score, 'students' => $students, 'exams' => $exams]);
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
      return response()->json(['message' => 'Score for this student and exam already exists.'], 409);
    }

    $score->update($validatedData);

    return response()->json($score);
  }

  public function destroy(Score $score)
  {
    $score->delete();

    return response()->json(null, 204);
  }
}
