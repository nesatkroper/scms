<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGradeLevelRequest;
use App\Http\Requests\UpdateGradeLevelRequest;
use App\Models\GradeLevel;

class GradeLevelController extends Controller
{
    public function index()
    {
        $gradeLevels = GradeLevel::with('sections')->paginate(10);
        return view('gradelevels.index', compact('gradeLevels'));
    }

    public function create()
    {
        return view('gradelevels.create');
    }

    public function store(StoreGradeLevelRequest $request)
    {
        $gradeLevel = GradeLevel::create($request->validated());
        $gradeLevel->load('sections');
        return redirect()->route('gradelevels.index')->with('success', 'Grade level added successfully!');
    }

    public function show(GradeLevel $gradeLevel)
    {
        $gradeLevel->load('sections');
        return view('gradelevels.show', compact('gradeLevel'));
    }

    public function edit(GradeLevel $gradeLevel)
    {
        $gradeLevel->load('sections');
        return view('gradelevels.edit', compact('gradeLevel'));
    }

    public function update(UpdateGradeLevelRequest $request, GradeLevel $gradeLevel)
    {
        $gradeLevel->update($request->validated());
        $gradeLevel->load('sections');
        return redirect()->route('gradelevels.show', $gradeLevel)->with('success', 'Grade level updated successfully!');
    }

    public function destroy(GradeLevel $gradeLevel)
    {
        $gradeLevel->delete();
        return redirect()->route('gradelevels.index')->with('success', 'Grade level deleted successfully!');
    }
}
