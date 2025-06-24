<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExamRequest;
use App\Http\Requests\UpdateExamRequest;
use App\Http\Resources\ExamResource;
use App\Models\Exam;

class ExamController extends Controller
{
    public function index()
    {
        $exams = Exam::with('subject')->paginate(10);
        return ExamResource::collection($exams);
    }

    public function store(StoreExamRequest $request)
    {
        $exam = Exam::create($request->validated());
        $exam->load('subject');
        return new ExamResource($exam);
    }

    public function show(Exam $exam)
    {
        $exam->load('subject');
        return new ExamResource($exam);
    }

    public function update(UpdateExamRequest $request, Exam $exam)
    {
        $exam->update($request->validated());
        $exam->load('subject');
        return new ExamResource($exam);
    }

    public function destroy(Exam $exam)
    {
        $exam->delete();
        return response()->json(['message' => 'Exam deleted'], 204);
    }
}