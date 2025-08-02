<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Http\Resources\TeacherResource;
use App\Models\Teacher;
use Illuminate\Http\JsonResponse;

class TeacherController extends Controller
{
  public function index(): JsonResponse
  {
    try {
      $teachers = Teacher::withTrashed()->with(['user', 'department'])->paginate(10);
      return TeacherResource::collection($teachers)->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error retrieving teachers: ' . $e->getMessage()], 500);
    }
  }

  public function store(StoreTeacherRequest $request): JsonResponse
  {
    try {
      $teacher = Teacher::create($request->validated());
      return (new TeacherResource($teacher))->response()->setStatusCode(201);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error creating teacher: ' . $e->getMessage()], 500);
    }
  }

  public function show(Teacher $teacher): JsonResponse
  {
    try {
      $teacher->load(['user', 'department']);
      return (new TeacherResource($teacher))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error retrieving teacher: ' . $e->getMessage()], 500);
    }
  }

  public function update(UpdateTeacherRequest $request, Teacher $teacher): JsonResponse
  {
    try {
      $teacher->update($request->validated());
      return (new TeacherResource($teacher))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error updating teacher: ' . $e->getMessage()], 500);
    }
  }

  public function destroy(Teacher $teacher): JsonResponse
  {
    try {
      $teacher->delete();
      return response()->json(['message' => 'Teacher deleted successfully.'], 204);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error deleting teacher: ' . $e->getMessage()], 500);
    }
  }

  public function restore(string $id): JsonResponse
  {
    try {
      $teacher = Teacher::onlyTrashed()->findOrFail($id);
      $teacher->restore();
      return (new TeacherResource($teacher))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error restoring teacher: ' . $e->getMessage()], 500);
    }
  }

  public function forceDelete(string $id): JsonResponse
  {
    try {
      $teacher = Teacher::onlyTrashed()->findOrFail($id);
      $teacher->forceDelete();
      return response()->json(['message' => 'Teacher permanently deleted.'], 204);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error permanently deleting teacher: ' . $e->getMessage()], 500);
    }
  }
}
