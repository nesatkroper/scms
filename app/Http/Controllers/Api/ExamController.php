<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExamRequest;
use App\Http\Requests\UpdateExamRequest;
use App\Http\Resources\ExamResource;
use App\Models\Exam;
use Illuminate\Http\JsonResponse;

class ExamController extends Controller
{
  public function index(): JsonResponse
  {
    try {
      $exams = Exam::withTrashed()->with('subject')->paginate(10);
      return ExamResource::collection($exams)->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error retrieving exams: ' . $e->getMessage()], 500);
    }
  }

  public function store(StoreExamRequest $request): JsonResponse
  {
    try {
      $exam = Exam::create($request->validated());
      return (new ExamResource($exam))->response()->setStatusCode(201);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error creating exam: ' . $e->getMessage()], 500);
    }
  }

  public function show(Exam $exam): JsonResponse
  {
    try {
      $exam->load('subject');
      return (new ExamResource($exam))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error retrieving exam: ' . $e->getMessage()], 500);
    }
  }

  public function update(UpdateExamRequest $request, Exam $exam): JsonResponse
  {
    try {
      $exam->update($request->validated());
      return (new ExamResource($exam))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error updating exam: ' . $e->getMessage()], 500);
    }
  }

  public function destroy(Exam $exam): JsonResponse
  {
    try {
      $exam->delete();
      return response()->json(['message' => 'Exam deleted successfully.'], 204);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error deleting exam: ' . $e->getMessage()], 500);
    }
  }

  public function restore(string $id): JsonResponse
  {
    try {
      $exam = Exam::onlyTrashed()->findOrFail($id);
      $exam->restore();
      return (new ExamResource($exam))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error restoring exam: ' . $e->getMessage()], 500);
    }
  }

  public function forceDelete(string $id): JsonResponse
  {
    try {
      $exam = Exam::onlyTrashed()->findOrFail($id);
      $exam->forceDelete();
      return response()->json(['message' => 'Exam permanently deleted.'], 204);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error permanently deleting exam: ' . $e->getMessage()], 500);
    }
  }
}
