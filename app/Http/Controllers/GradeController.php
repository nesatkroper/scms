<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGradeRequest;
use App\Http\Requests\UpdateGradeRequest;
use App\Models\Grade;

class GradeController extends Controller
{
    public function index()
    {
        $grades = Grade::with(['student', 'exam'])->paginate(10);
        return view('grades.index', compact('grades'));
    }

    public function create()
    {
        return view('grades.create');
    }

    public function store(StoreGradeRequest $request)
    {
        $grade = Grade::create($request->validated());
        $grade->load(['student', 'exam']);
        return redirect()->route('grades.index')->with('success', 'Grade added successfully!');
    }

    public function show(Grade $grade)
    {
        $grade->load(['student', 'exam']);
        return view('grades.show', compact('grade'));
    }

    public function edit(Grade $grade)
    {
        $grade->load(['student', 'exam']);
        return view('grades.edit', compact('grade'));
    }

    public function update(UpdateGradeRequest $request, Grade $grade)
    {
        $grade->update($request->validated());
        $grade->load(['student', 'exam']);
        return redirect()->route('grades.show', $grade)->with('success', 'Grade updated successfully!');
    }

    public function destroy(Grade $grade)
    {
        $grade->delete();
        return redirect()->route('grades.index')->with('success', 'Grade deleted successfully!');
    }
}
