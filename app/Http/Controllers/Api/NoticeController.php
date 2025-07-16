<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNoticeRequest;
use App\Http\Requests\UpdateNoticeRequest;
use App\Http\Resources\NoticeResource;
use App\Models\Notice;
use Illuminate\Http\JsonResponse;

class NoticeController extends Controller
{
  public function index(): JsonResponse
  {
    try {
      $notices = Notice::withTrashed()->with('createdBy')->paginate(10);
      return NoticeResource::collection($notices)->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error retrieving notices: ' . $e->getMessage()], 500);
    }
  }

  public function store(StoreNoticeRequest $request): JsonResponse
  {
    try {
      $notice = Notice::create($request->validated());
      return (new NoticeResource($notice))->response()->setStatusCode(201);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error creating notice: ' . $e->getMessage()], 500);
    }
  }

  public function show(Notice $notice): JsonResponse
  {
    try {
      $notice->load('createdBy');
      return (new NoticeResource($notice))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error retrieving notice: ' . $e->getMessage()], 500);
    }
  }

  public function update(UpdateNoticeRequest $request, Notice $notice): JsonResponse
  {
    try {
      $notice->update($request->validated());
      return (new NoticeResource($notice))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error updating notice: ' . $e->getMessage()], 500);
    }
  }

  public function destroy(Notice $notice): JsonResponse
  {
    try {
      $notice->delete();
      return response()->json(['message' => 'Notice deleted successfully.'], 204);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error deleting notice: ' . $e->getMessage()], 500);
    }
  }

  public function restore(string $id): JsonResponse
  {
    try {
      $notice = Notice::onlyTrashed()->findOrFail($id);
      $notice->restore();
      return (new NoticeResource($notice))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error restoring notice: ' . $e->getMessage()], 500);
    }
  }

  public function forceDelete(string $id): JsonResponse
  {
    try {
      $notice = Notice::onlyTrashed()->findOrFail($id);
      $notice->forceDelete();
      return response()->json(['message' => 'Notice permanently deleted.'], 204);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error permanently deleting notice: ' . $e->getMessage()], 500);
    }
  }
}
