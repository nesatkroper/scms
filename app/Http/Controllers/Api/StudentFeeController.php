<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentFeeRequest;
use App\Http\Requests\UpdateStudentFeeRequest;
use App\Http\Resources\StudentFeeResource;
use App\Models\StudentFee;
use Illuminate\Http\JsonResponse;

class StudentFeeController extends Controller
{
  public function index(): JsonResponse
  {
    try {
      $studentFees = StudentFee::withTrashed()->with(['student', 'feeStructure'])->paginate(10);
      return StudentFeeResource::collection($studentFees)->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error retrieving student fees: ' . $e->getMessage()], 500);
    }
  }

  public function store(StoreStudentFeeRequest $request): JsonResponse
  {
    try {
      $studentFee = StudentFee::create($request->validated());
      return (new StudentFeeResource($studentFee))->response()->setStatusCode(201);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error creating student fee: ' . $e->getMessage()], 500);
    }
  }

  public function show(StudentFee $studentFee): JsonResponse
  {
    try {
      $studentFee->load(['student', 'feeStructure']);
      return (new StudentFeeResource($studentFee))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error retrieving student fee: ' . $e->getMessage()], 500);
    }
  }

  public function update(UpdateStudentFeeRequest $request, StudentFee $studentFee): JsonResponse
  {
    try {
      $studentFee->update($request->validated());
      return (new StudentFeeResource($studentFee))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error updating student fee: ' . $e->getMessage()], 500);
    }
  }

  public function destroy(StudentFee $studentFee): JsonResponse
  {
    try {
      $studentFee->delete();
      return response()->json(['message' => 'Student fee deleted successfully.'], 204);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error deleting student fee: ' . $e->getMessage()], 500);
    }
  }

  public function restore(string $id): JsonResponse
  {
    try {
      $studentFee = StudentFee::onlyTrashed()->findOrFail($id);
      $studentFee->restore();
      return (new StudentFeeResource($studentFee))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error restoring student fee: ' . $e->getMessage()], 500);
    }
  }

  public function forceDelete(string $id): JsonResponse
  {
    try {
      $studentFee = StudentFee::onlyTrashed()->findOrFail($id);
      $studentFee->forceDelete();
      return response()->json(['message' => 'Student fee permanently deleted.'], 204);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error permanently deleting student fee: ' . $e->getMessage()], 500);
    }
  }
}
