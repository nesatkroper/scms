<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookCategoryRequest;
use App\Http\Requests\UpdateBookCategoryRequest;
use App\Http\Resources\BookCategoryResource;
use App\Models\BookCategory;
use Illuminate\Http\JsonResponse;

class BookCategoryController extends Controller
{
  public function index(): JsonResponse
  {
    try {
      $bookCategories = BookCategory::withTrashed()->paginate(10);
      return BookCategoryResource::collection($bookCategories)->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error retrieving book categories: ' . $e->getMessage()], 500);
    }
  }

  public function store(StoreBookCategoryRequest $request): JsonResponse
  {
    try {
      $bookCategory = BookCategory::create($request->validated());
      return (new BookCategoryResource($bookCategory))->response()->setStatusCode(201);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error creating book category: ' . $e->getMessage()], 500);
    }
  }

  public function show(BookCategory $bookCategory): JsonResponse
  {
    try {
      return (new BookCategoryResource($bookCategory))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error retrieving book category: ' . $e->getMessage()], 500);
    }
  }

  public function update(UpdateBookCategoryRequest $request, BookCategory $bookCategory): JsonResponse
  {
    try {
      $bookCategory->update($request->validated());
      return (new BookCategoryResource($bookCategory))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error updating book category: ' . $e->getMessage()], 500);
    }
  }

  public function destroy(BookCategory $bookCategory): JsonResponse
  {
    try {
      $bookCategory->delete();
      return response()->json(['message' => 'Book category deleted successfully.'], 204);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error deleting book category: ' . $e->getMessage()], 500);
    }
  }

  public function restore(string $id): JsonResponse
  {
    try {
      $bookCategory = BookCategory::onlyTrashed()->findOrFail($id);
      $bookCategory->restore();
      return (new BookCategoryResource($bookCategory))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error restoring book category: ' . $e->getMessage()], 500);
    }
  }

  public function forceDelete(string $id): JsonResponse
  {
    try {
      $bookCategory = BookCategory::onlyTrashed()->findOrFail($id);
      $bookCategory->forceDelete();
      return response()->json(['message' => 'Book category permanently deleted.'], 204);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error permanently deleting book category: ' . $e->getMessage()], 500);
    }
  }
}
