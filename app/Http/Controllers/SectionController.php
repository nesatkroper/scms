<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSectionRequest;
use App\Http\Requests\UpdateSectionRequest;
use App\Http\Resources\SectionResource;
use App\Models\Section;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::with(['gradeLevel', 'teacher'])->paginate(10);
        return SectionResource::collection($sections);
    }

    public function store(StoreSectionRequest $request)
    {
        $section = Section::create($request->validated());
        $section->load(['gradeLevel', 'teacher']);
        return new SectionResource($section);
    }

    public function show(Section $section)
    {
        $section->load(['gradeLevel', 'teacher']);
        return new SectionResource($section);
    }

    public function update(UpdateSectionRequest $request, Section $section)
    {
        $section->update($request->validated());
        $section->load(['gradeLevel', 'teacher']);
        return new SectionResource($section);
    }

    public function destroy(Section $section)
    {
        $section->delete();
        return response()->json(['message' => 'Section deleted'], 204);
    }
}