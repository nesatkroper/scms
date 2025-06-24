<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGradeScaleRequest;
use App\Http\Requests\UpdateGradeScaleRequest;
use App\Http\Resources\GradeScaleResource;
use App\Models\GradeScale;

class GradeScaleController extends Controller
{
    public function index()
    {
        return GradeScaleResource::collection(GradeScale::paginate(10));
    }

    public function store(StoreGradeScaleRequest $request)
    {
        $gradeScale = GradeScale::create($request->validated());
        return new GradeScaleResource($gradeScale);
    }

    public function show(GradeScale $gradeScale)
    {
        return new GradeScaleResource($gradeScale);
    }

    public function update(UpdateGradeScaleRequest $request, GradeScale $gradeScale)
    {
        $gradeScale->update($request->validated());
        return new GradeScaleResource($gradeScale);
    }

    public function destroy(GradeScale $gradeScale)
    {
        $gradeScale->delete();
        return response()->json(['message' => 'Grade scale deleted'], 204);
    }
}