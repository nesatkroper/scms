<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExamRequest;
use App\Http\Requests\UpdateExamRequest;
use App\Models\Exam;

class ExamController extends Controller
{
    public function index()
    {
        $exams = Exam::with('subject')->paginate(10);
        return view('exams.index', compact('exams'));
    }

    public function create()
    {
        return view('exams.create');
    }

    public function store(StoreExamRequest $request)
    {
        $exam = Exam::create($request->validated());
        $exam->load('subject'); 
        return redirect()->route('exams.index')->with('success', 'Exam added successfully!');
    }

    public function show(Exam $exam)
    {
        $exam->load('subject');
        return view('exams.show', compact('exam'));
    }

    public function edit(Exam $exam)
    {
        $exam->load('subject');
        return view('exams.edit', compact('exam'));
    }

    public function update(UpdateExamRequest $request, Exam $exam)
    {
        $exam->update($request->validated());
        $exam->load('subject'); 
        return redirect()->route('exams.show', $exam)->with('success', 'Exam updated successfully!');
    }

    public function destroy(Exam $exam)
    {
        $exam->delete();
        return redirect()->route('exams.index')->with('success', 'Exam deleted successfully!');
    }
}
