<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourseOfferingRequest;
use App\Http\Requests\UpdateCourseOfferingRequest;
use App\Http\Resources\CourseOfferingResource;
use App\Models\CourseOffering;
use Illuminate\Http\JsonResponse;

class CourseOfferingController extends Controller
{
  public function index(): JsonResponse
  {
    try {
      $courseOfferings = CourseOffering::withTrashed()->with(['subject', 'teacher', 'classroom', 'section'])->paginate(10);
      return CourseOfferingResource::collection($courseOfferings)->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error retrieving course offerings: ' . $e->getMessage()], 500);
    }
  }

  public function store(StoreCourseOfferingRequest $request): JsonResponse
  {
    try {
      $courseOffering = CourseOffering::create($request->validated());
      return (new CourseOfferingResource($courseOffering))->response()->setStatusCode(201);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error creating course offering: ' . $e->getMessage()], 500);
    }
  }

  public function show(CourseOffering $courseOffering): JsonResponse
  {
    try {
      $courseOffering->load(['subject', 'teacher', 'classroom', 'section']);
      return (new CourseOfferingResource($courseOffering))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error retrieving course offering: ' . $e->getMessage()], 500);
    }
  }

  public function update(UpdateCourseOfferingRequest $request, CourseOffering $courseOffering): JsonResponse
  {
    try {
      $courseOffering->update($request->validated());
      return (new CourseOfferingResource($courseOffering))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error updating course offering: ' . $e->getMessage()], 500);
    }
  }

  public function destroy(CourseOffering $courseOffering): JsonResponse
  {
    try {
      $courseOffering->delete();
      return response()->json(['message' => 'Course offering deleted successfully.'], 204);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error deleting course offering: ' . $e->getMessage()], 500);
    }
  }

  public function restore(string $id): JsonResponse
  {
    try {
      $courseOffering = CourseOffering::onlyTrashed()->findOrFail($id);
      $courseOffering->restore();
      return (new CourseOfferingResource($courseOffering))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error restoring course offering: ' . $e->getMessage()], 500);
    }
  }

  public function forceDelete(string $id): JsonResponse
  {
    try {
      $courseOffering = CourseOffering::onlyTrashed()->findOrFail($id);
      $courseOffering->forceDelete();
      return response()->json(['message' => 'Course offering permanently deleted.'], 204);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error permanently deleting course offering: ' . $e->getMessage()], 500);
    }
  }
}
