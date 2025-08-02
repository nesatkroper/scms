<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\JsonResponse;

class BookController extends Controller
{
  public function index(): JsonResponse
  {
    try {
      $books = Book::withTrashed()->with('category')->paginate(10);
      return BookResource::collection($books)->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error retrieving books: ' . $e->getMessage()], 500);
    }
  }

  public function store(StoreBookRequest $request): JsonResponse
  {
    try {
      $book = Book::create($request->validated());
      return (new BookResource($book))->response()->setStatusCode(201);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error creating book: ' . $e->getMessage()], 500);
    }
  }

  public function show(Book $book): JsonResponse
  {
    try {
      $book->load('category');
      return (new BookResource($book))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error retrieving book: ' . $e->getMessage()], 500);
    }
  }

  public function update(UpdateBookRequest $request, Book $book): JsonResponse
  {
    try {
      $book->update($request->validated());
      return (new BookResource($book))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error updating book: ' . $e->getMessage()], 500);
    }
  }

  public function destroy(Book $book): JsonResponse
  {
    try {
      $book->delete();
      return response()->json(['message' => 'Book deleted successfully.'], 204);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error deleting book: ' . $e->getMessage()], 500);
    }
  }

  public function restore(string $id): JsonResponse
  {
    try {
      $book = Book::onlyTrashed()->findOrFail($id);
      $book->restore();
      return (new BookResource($book))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error restoring book: ' . $e->getMessage()], 500);
    }
  }

  public function forceDelete(string $id): JsonResponse
  {
    try {
      $book = Book::onlyTrashed()->findOrFail($id);
      $book->forceDelete();
      return response()->json(['message' => 'Book permanently deleted.'], 204);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error permanently deleting book: ' . $e->getMessage()], 500);
    }
  }
}
