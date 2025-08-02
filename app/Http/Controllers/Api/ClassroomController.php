<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClassroomRequest;
use App\Http\Requests\UpdateClassroomRequest;
use App\Http\Resources\ClassroomResource;
use App\Models\Classroom;
use Illuminate\Http\JsonResponse;

class ClassroomController extends Controller
{
  public function index(): JsonResponse
  {
    try {
      $classrooms = Classroom::withTrashed()->paginate(10);  // Include soft-deleted
      return ClassroomResource::collection($classrooms)->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error retrieving classrooms: ' . $e->getMessage()], 500);
    }
  }

  public function store(StoreClassroomRequest $request): JsonResponse
  {
    try {
      $classroom = Classroom::create($request->validated());
      return (new ClassroomResource($classroom))->response()->setStatusCode(201);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error creating classroom: ' . $e->getMessage()], 500);
    }
  }

  public function show(Classroom $classroom): JsonResponse
  {
    try {
      // If you want to allow showing soft-deleted classrooms, adjust route model binding or fetch withTrashed
      // For route model binding, define in RouteServiceProvider boot method:
      // Route::bind('classroom', fn ($value) => Classroom::withTrashed()->findOrFail($value));
      return (new ClassroomResource($classroom))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error retrieving classroom: ' . $e->getMessage()], 500);
    }
  }

  public function update(UpdateClassroomRequest $request, Classroom $classroom): JsonResponse
  {
    try {
      $classroom->update($request->validated());
      return (new ClassroomResource($classroom))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error updating classroom: ' . $e->getMessage()], 500);
    }
  }

  public function destroy(Classroom $classroom): JsonResponse
  {
    try {
      $classroom->delete();  // Soft delete
      return response()->json(['message' => 'Classroom deleted successfully.'], 204);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error deleting classroom: ' . $e->getMessage()], 500);
    }
  }

  public function restore(string $id): JsonResponse
  {
    try {
      $classroom = Classroom::onlyTrashed()->findOrFail($id);
      $classroom->restore();
      return (new ClassroomResource($classroom))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error restoring classroom: ' . $e->getMessage()], 500);
    }
  }

  public function forceDelete(string $id): JsonResponse
  {
    try {
      $classroom = Classroom::onlyTrashed()->findOrFail($id);
      $classroom->forceDelete();
      return response()->json(['message' => 'Classroom permanently deleted.'], 204);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error permanently deleting classroom: ' . $e->getMessage()], 500);
    }
  }
}
