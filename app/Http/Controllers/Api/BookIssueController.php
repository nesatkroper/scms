<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookIssueRequest;
use App\Http\Requests\UpdateBookIssueRequest;
use App\Http\Resources\BookIssueResource;
use App\Models\BookIssue;
use Illuminate\Http\JsonResponse;

class BookIssueController extends Controller
{
  public function index(): JsonResponse
  {
    try {
      $bookIssues = BookIssue::withTrashed()->with(['book', 'student', 'teacher'])->paginate(10);
      return BookIssueResource::collection($bookIssues)->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error retrieving book issues: ' . $e->getMessage()], 500);
    }
  }

  public function store(StoreBookIssueRequest $request): JsonResponse
  {
    try {
      $bookIssue = BookIssue::create($request->validated());
      return (new BookIssueResource($bookIssue))->response()->setStatusCode(201);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error creating book issue: ' . $e->getMessage()], 500);
    }
  }

  public function show(BookIssue $bookIssue): JsonResponse
  {
    try {
      $bookIssue->load(['book', 'student', 'teacher']);
      return (new BookIssueResource($bookIssue))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error retrieving book issue: ' . $e->getMessage()], 500);
    }
  }

  public function update(UpdateBookIssueRequest $request, BookIssue $bookIssue): JsonResponse
  {
    try {
      $bookIssue->update($request->validated());
      return (new BookIssueResource($bookIssue))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error updating book issue: ' . $e->getMessage()], 500);
    }
  }

  public function destroy(BookIssue $bookIssue): JsonResponse
  {
    try {
      $bookIssue->delete();
      return response()->json(['message' => 'Book issue deleted successfully.'], 204);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error deleting book issue: ' . $e->getMessage()], 500);
    }
  }

  public function restore(string $id): JsonResponse
  {
    try {
      $bookIssue = BookIssue::onlyTrashed()->findOrFail($id);
      $bookIssue->restore();
      return (new BookIssueResource($bookIssue))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error restoring book issue: ' . $e->getMessage()], 500);
    }
  }

  public function forceDelete(string $id): JsonResponse
  {
    try {
      $bookIssue = BookIssue::onlyTrashed()->findOrFail($id);
      $bookIssue->forceDelete();
      return response()->json(['message' => 'Book issue permanently deleted.'], 204);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error permanently deleting book issue: ' . $e->getMessage()], 500);
    }
  }
}
