<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Http\Resources\ExpenseResource;
use App\Models\Expense;
use Illuminate\Http\JsonResponse;

class ExpenseController extends Controller
{
  public function index(): JsonResponse
  {
    try {
      $expenses = Expense::withTrashed()->with(['category', 'approvedBy'])->paginate(10);
      return ExpenseResource::collection($expenses)->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error retrieving expenses: ' . $e->getMessage()], 500);
    }
  }

  public function store(StoreExpenseRequest $request): JsonResponse
  {
    try {
      $expense = Expense::create($request->validated());
      return (new ExpenseResource($expense))->response()->setStatusCode(201);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error creating expense: ' . $e->getMessage()], 500);
    }
  }

  public function show(Expense $expense): JsonResponse
  {
    try {
      $expense->load(['category', 'approvedBy']);
      return (new ExpenseResource($expense))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error retrieving expense: ' . $e->getMessage()], 500);
    }
  }

  public function update(UpdateExpenseRequest $request, Expense $expense): JsonResponse
  {
    try {
      $expense->update($request->validated());
      return (new ExpenseResource($expense))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error updating expense: ' . $e->getMessage()], 500);
    }
  }

  public function destroy(Expense $expense): JsonResponse
  {
    try {
      $expense->delete();
      return response()->json(['message' => 'Expense deleted successfully.'], 204);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error deleting expense: ' . $e->getMessage()], 500);
    }
  }

  public function restore(string $id): JsonResponse
  {
    try {
      $expense = Expense::onlyTrashed()->findOrFail($id);
      $expense->restore();
      return (new ExpenseResource($expense))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error restoring expense: ' . $e->getMessage()], 500);
    }
  }

  public function forceDelete(string $id): JsonResponse
  {
    try {
      $expense = Expense::onlyTrashed()->findOrFail($id);
      $expense->forceDelete();
      return response()->json(['message' => 'Expense permanently deleted.'], 204);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error permanently deleting expense: ' . $e->getMessage()], 500);
    }
  }
}
