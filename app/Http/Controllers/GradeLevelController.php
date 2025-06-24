<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGradeLevelRequest;
use App\Http\Requests\UpdateGradeLevelRequest;
use App\Http\Resources\GradeLevelResource;
use App\Models\GradeLevel;

class GradeLevelController extends Controller
{
    public function index()
    {
        $gradeLevels = GradeLevel::with('sections')->paginate(10);
        return GradeLevelResource::collection($gradeLevels);
    }

    public function store(StoreGradeLevelRequest $request)
    {
        $gradeLevel = GradeLevel::create($request->validated());
        $gradeLevel->load('sections');
        return new GradeLevelResource($gradeLevel);
    }

    public function show(GradeLevel $gradeLevel)
    {
        $gradeLevel->load('sections');
        return new GradeLevelResource($gradeLevel);
    }

    public function update(UpdateGradeLevelRequest $request, GradeLevel $gradeLevel)
    {
        $gradeLevel->update($request->validated());
        $gradeLevel->load('sections');
        return new GradeLevelResource($gradeLevel);
    }

    public function destroy(GradeLevel $gradeLevel)
    {
        $gradeLevel->delete();
        return response()->json(['message' => 'Grade level deleted'], 204);
    }
}