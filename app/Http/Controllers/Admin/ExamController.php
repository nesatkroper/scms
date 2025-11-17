<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Http\Requests\StoreExamRequest;
use App\Http\Requests\UpdateExamRequest;

class ExamController extends Controller
{
    public function index()
    {
        $exams = Exam::all();
        return view('admin.exams.index', compact('exams'));
    }

    public function create()
    {
        return view('admin.exams.create');
    }

    public function store(StoreExamRequest $request)
    {
        Exam::create($request->validated());
        return redirect()->route('admin.exams.index')->with('success', 'Exam created successfully');
    }

    public function edit($id)
    {
        $exam = Exam::findOrFail($id);
        return view('admin.exams.edit', compact('exam'));
    }

    public function update(UpdateExamRequest $request, $id)
    {
        $exam = Exam::findOrFail($id);
        $($request->validated());
        return redirect()->route('admin.exams.index')->with('success', 'Exam updated successfully');
    }

    public function destroy($id)
    {
        $exam = Exam::findOrFail($id);
        $();
        return redirect()->route('admin.exams.index')->with('success', 'Exam deleted successfully');
    }
}