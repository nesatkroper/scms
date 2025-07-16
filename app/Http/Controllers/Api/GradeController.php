<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGradeRequest;
use App\Http\Requests\UpdateGradeRequest;
use App\Http\Resources\GradeResource;
use App\Models\Grade;
use Illuminate\Http\JsonResponse;

class GradeController extends Controller
{
  public function index(): JsonResponse
  {
    try {
      $grades = Grade::withTrashed()->with(['student', 'exam'])->paginate(10);
      return GradeResource::collection($grades)->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error retrieving grades: ' . $e->getMessage()], 500);
    }
  }

  public function store(StoreGradeRequest $request): JsonResponse
  {
    try {
      $grade = Grade::create($request->validated());
      return (new GradeResource($grade))->response()->setStatusCode(201);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error creating grade: ' . $e->getMessage()], 500);
    }
  }

  public function show(Grade $grade): JsonResponse
  {
    try {
      $grade->load(['student', 'exam']);
      return (new GradeResource($grade))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error retrieving grade: ' . $e->getMessage()], 500);
    }
  }

  public function update(UpdateGradeRequest $request, Grade $grade): JsonResponse
  {
    try {
      $grade->update($request->validated());
      return (new GradeResource($grade))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error updating grade: ' . $e->getMessage()], 500);
    }
  }

  public function destroy(Grade $grade): JsonResponse
  {
    try {
      $grade->delete();
      return response()->json(['message' => 'Grade deleted successfully.'], 204);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error deleting grade: ' . $e->getMessage()], 500);
    }
  }

  public function restore(string $id): JsonResponse
  {
    try {
      $grade = Grade::onlyTrashed()->findOrFail($id);
      $grade->restore();
      return (new GradeResource($grade))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error restoring grade: ' . $e->getMessage()], 500);
    }
  }

  public function forceDelete(string $id): JsonResponse
  {
    try {
      $grade = Grade::onlyTrashed()->findOrFail($id);
      $grade->forceDelete();
      return response()->json(['message' => 'Grade permanently deleted.'], 204);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error permanently deleting grade: ' . $e->getMessage()], 500);
    }
  }
}
