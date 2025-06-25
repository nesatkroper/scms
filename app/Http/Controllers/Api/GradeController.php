<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGradeRequest;
use App\Http\Requests\UpdateGradeRequest;
use App\Http\Resources\GradeResource;
use App\Models\Grade;

class GradeController extends Controller
{
    public function index()
    {
        $grades = Grade::with(['student', 'exam'])->paginate(10);
        return GradeResource::collection($grades);
    }

    public function store(StoreGradeRequest $request)
    {
        $grade = Grade::create($request->validated());
        $grade->load(['student', 'exam']);
        return new GradeResource($grade);
    }

    public function show(Grade $grade)
    {
        $grade->load(['student', 'exam']);
        return new GradeResource($grade);
    }

    public function update(UpdateGradeRequest $request, Grade $grade)
    {
        $grade->update($request->validated());
        $grade->load(['student', 'exam']);
        return new GradeResource($grade);
    }

    public function destroy(Grade $grade)
    {
        $grade->delete();
        return response()->json(['message' => 'Grade deleted'], 204);
    }
}
