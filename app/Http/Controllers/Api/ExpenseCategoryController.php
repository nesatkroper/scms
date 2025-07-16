<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExpenseCategoryRequest;
use App\Http\Requests\UpdateExpenseCategoryRequest;
use App\Http\Resources\ExpenseCategoryResource;
use App\Models\ExpenseCategory;
use Illuminate\Http\JsonResponse;

class ExpenseCategoryController extends Controller
{
  public function index(): JsonResponse
  {
    try {
      $expenseCategories = ExpenseCategory::withTrashed()->paginate(10);
      return ExpenseCategoryResource::collection($expenseCategories)->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error retrieving expense categories: ' . $e->getMessage()], 500);
    }
  }

  public function store(StoreExpenseCategoryRequest $request): JsonResponse
  {
    try {
      $expenseCategory = ExpenseCategory::create($request->validated());
      return (new ExpenseCategoryResource($expenseCategory))->response()->setStatusCode(201);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error creating expense category: ' . $e->getMessage()], 500);
    }
  }

  public function show(ExpenseCategory $expenseCategory): JsonResponse
  {
    try {
      return (new ExpenseCategoryResource($expenseCategory))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error retrieving expense category: ' . $e->getMessage()], 500);
    }
  }

  public function update(UpdateExpenseCategoryRequest $request, ExpenseCategory $expenseCategory): JsonResponse
  {
    try {
      $expenseCategory->update($request->validated());
      return (new ExpenseCategoryResource($expenseCategory))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error updating expense category: ' . $e->getMessage()], 500);
    }
  }

  public function destroy(ExpenseCategory $expenseCategory): JsonResponse
  {
    try {
      $expenseCategory->delete();
      return response()->json(['message' => 'Expense category deleted successfully.'], 204);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error deleting expense category: ' . $e->getMessage()], 500);
    }
  }

  public function restore(string $id): JsonResponse
  {
    try {
      $expenseCategory = ExpenseCategory::onlyTrashed()->findOrFail($id);
      $expenseCategory->restore();
      return (new ExpenseCategoryResource($expenseCategory))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error restoring expense category: ' . $e->getMessage()], 500);
    }
  }

  public function forceDelete(string $id): JsonResponse
  {
    try {
      $expenseCategory = ExpenseCategory::onlyTrashed()->findOrFail($id);
      $expenseCategory->forceDelete();
      return response()->json(['message' => 'Expense category permanently deleted.'], 204);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error permanently deleting expense category: ' . $e->getMessage()], 500);
    }
  }
}
