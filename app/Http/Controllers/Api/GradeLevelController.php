<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGradeLevelRequest;
use App\Http\Requests\UpdateGradeLevelRequest;
use App\Http\Resources\GradeLevelResource;
use App\Models\GradeLevel;
use Illuminate\Http\JsonResponse;

class GradeLevelController extends Controller
{
  public function index(): JsonResponse
  {
    try {
      $gradeLevels = GradeLevel::withTrashed()->paginate(10);
      return GradeLevelResource::collection($gradeLevels)->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error retrieving grade levels: ' . $e->getMessage()], 500);
    }
  }

  public function store(StoreGradeLevelRequest $request): JsonResponse
  {
    try {
      $gradeLevel = GradeLevel::create($request->validated());
      return (new GradeLevelResource($gradeLevel))->response()->setStatusCode(201);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error creating grade level: ' . $e->getMessage()], 500);
    }
  }

  public function show(GradeLevel $gradeLevel): JsonResponse
  {
    try {
      return (new GradeLevelResource($gradeLevel))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error retrieving grade level: ' . $e->getMessage()], 500);
    }
  }

  public function update(UpdateGradeLevelRequest $request, GradeLevel $gradeLevel): JsonResponse
  {
    try {
      $gradeLevel->update($request->validated());
      return (new GradeLevelResource($gradeLevel))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error updating grade level: ' . $e->getMessage()], 500);
    }
  }

  public function destroy(GradeLevel $gradeLevel): JsonResponse
  {
    try {
      $gradeLevel->delete();
      return response()->json(['message' => 'Grade level deleted successfully.'], 204);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error deleting grade level: ' . $e->getMessage()], 500);
    }
  }

  public function restore(string $id): JsonResponse
  {
    try {
      $gradeLevel = GradeLevel::onlyTrashed()->findOrFail($id);
      $gradeLevel->restore();
      return (new GradeLevelResource($gradeLevel))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error restoring grade level: ' . $e->getMessage()], 500);
    }
  }

  public function forceDelete(string $id): JsonResponse
  {
    try {
      $event = GradeLevel::onlyTrashed()->findOrFail($id);
      $event->forceDelete();
      return response()->json(['message' => 'Grade permanently deleted.'], 204);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error permanently deleting grade: ' . $e->getMessage()], 500);
    }
  }
}
