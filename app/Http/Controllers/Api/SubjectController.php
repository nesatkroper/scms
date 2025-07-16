<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Http\Resources\SubjectResource;
use App\Models\Subject;
use Illuminate\Http\JsonResponse;

class SubjectController extends Controller
{
  public function index(): JsonResponse
  {
    try {
      $subjects = Subject::withTrashed()->with('department')->paginate(10);
      return SubjectResource::collection($subjects)->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error retrieving subjects: ' . $e->getMessage()], 500);
    }
  }

  public function store(StoreSubjectRequest $request): JsonResponse
  {
    try {
      $subject = Subject::create($request->validated());
      return (new SubjectResource($subject))->response()->setStatusCode(201);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error creating subject: ' . $e->getMessage()], 500);
    }
  }

  public function show(Subject $subject): JsonResponse
  {
    try {
      $subject->load('department');
      return (new SubjectResource($subject))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error retrieving subject: ' . $e->getMessage()], 500);
    }
  }

  public function update(UpdateSubjectRequest $request, Subject $subject): JsonResponse
  {
    try {
      $subject->update($request->validated());
      return (new SubjectResource($subject))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error updating subject: ' . $e->getMessage()], 500);
    }
  }

  public function destroy(Subject $subject): JsonResponse
  {
    try {
      $subject->delete();
      return response()->json(['message' => 'Subject deleted successfully.'], 204);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error deleting subject: ' . $e->getMessage()], 500);
    }
  }

  public function restore(string $id): JsonResponse
  {
    try {
      $subject = Subject::onlyTrashed()->findOrFail($id);
      $subject->restore();
      return (new SubjectResource($subject))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error restoring subject: ' . $e->getMessage()], 500);
    }
  }

  public function forceDelete(string $id): JsonResponse
  {
    try {
      $subject = Subject::onlyTrashed()->findOrFail($id);
      $subject->forceDelete();
      return response()->json(['message' => 'Subject permanently deleted.'], 204);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error permanently deleting subject: ' . $e->getMessage()], 500);
    }
  }
}
