<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSectionRequest;
use App\Http\Requests\UpdateSectionRequest;
use App\Models\Section;
use App\Models\GradeLevel; 
use App\Models\Teacher;    

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::with(['gradeLevel', 'teacher'])->paginate(10);
        return view('sections.index', compact('sections'));
    }

    public function create()
    {
        $gradeLevels = GradeLevel::all();
        $teachers = Teacher::all();
        return view('sections.create', compact('gradeLevels', 'teachers'));
    }

    public function store(StoreSectionRequest $request)
    {
        $section = Section::create($request->validated());
        return redirect()->route('sections.index')->with('success', 'Section created successfully!');
    }

    public function show(Section $section)
    {
        $section->load(['gradeLevel', 'teacher']);
        return view('sections.show', compact('section'));
    }

    public function edit(Section $section)
    {
        $section->load(['gradeLevel', 'teacher']);
        $gradeLevels = GradeLevel::all();
        $teachers = Teacher::all();
        return view('sections.edit', compact('section', 'gradeLevels', 'teachers'));
    }

    public function update(UpdateSectionRequest $request, Section $section)
    {
        $section->update($request->validated());
        return redirect()->route('sections.show', $section)->with('success', 'Section updated successfully!');
    }

    public function destroy(Section $section)
    {
        $section->delete();
        return redirect()->route('sections.index')->with('success', 'Section deleted successfully!');
    }
}
