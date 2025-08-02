<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFeeStructureRequest;
use App\Http\Requests\UpdateFeeStructureRequest;
use App\Http\Resources\FeeStructureResource;
use App\Models\FeeStructure;
use Illuminate\Http\JsonResponse;

class FeeStructureController extends Controller
{
  public function index(): JsonResponse
  {
    try {
      $feeStructures = FeeStructure::withTrashed()->with('gradeLevel')->paginate(10);
      return FeeStructureResource::collection($feeStructures)->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error retrieving fee structures: ' . $e->getMessage()], 500);
    }
  }

  public function store(StoreFeeStructureRequest $request): JsonResponse
  {
    try {
      $feeStructure = FeeStructure::create($request->validated());
      return (new FeeStructureResource($feeStructure))->response()->setStatusCode(201);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error creating fee structure: ' . $e->getMessage()], 500);
    }
  }

  public function show(FeeStructure $feeStructure): JsonResponse
  {
    try {
      $feeStructure->load('gradeLevel');
      return (new FeeStructureResource($feeStructure))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error retrieving fee structure: ' . $e->getMessage()], 500);
    }
  }

  public function update(UpdateFeeStructureRequest $request, FeeStructure $feeStructure): JsonResponse
  {
    try {
      $feeStructure->update($request->validated());
      return (new FeeStructureResource($feeStructure))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error updating fee structure: ' . $e->getMessage()], 500);
    }
  }

  public function destroy(FeeStructure $feeStructure): JsonResponse
  {
    try {
      $feeStructure->delete();
      return response()->json(['message' => 'Fee structure deleted successfully.'], 204);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error deleting fee structure: ' . $e->getMessage()], 500);
    }
  }

  public function restore(string $id): JsonResponse
  {
    try {
      $feeStructure = FeeStructure::onlyTrashed()->findOrFail($id);
      $feeStructure->restore();
      return (new FeeStructureResource($feeStructure))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error restoring fee structure: ' . $e->getMessage()], 500);
    }
  }

  public function forceDelete(string $id): JsonResponse
  {
    try {
      $feeStructure = FeeStructure::onlyTrashed()->findOrFail($id);
      $feeStructure->forceDelete();
      return response()->json(['message' => 'Fee structure permanently deleted.'], 204);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error permanently deleting fee structure: ' . $e->getMessage()], 500);
    }
  }
}
