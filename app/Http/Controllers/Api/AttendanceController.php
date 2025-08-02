<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use App\Http\Resources\AttendanceResource;
use App\Models\Attendance;
use Illuminate\Http\JsonResponse;

class AttendanceController extends Controller
{
  public function index(): JsonResponse
  {
    try {
      $attendances = Attendance::withTrashed()->with(['student', 'courseOffering'])->paginate(10);
      return AttendanceResource::collection($attendances)->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error retrieving attendances: ' . $e->getMessage()], 500);
    }
  }

  public function store(StoreAttendanceRequest $request): JsonResponse
  {
    try {
      $attendance = Attendance::create($request->validated());
      return (new AttendanceResource($attendance))->response()->setStatusCode(201);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error creating attendance: ' . $e->getMessage()], 500);
    }
  }

  public function show(Attendance $attendance): JsonResponse
  {
    try {
      $attendance->load(['student', 'courseOffering']);
      return (new AttendanceResource($attendance))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error retrieving attendance: ' . $e->getMessage()], 500);
    }
  }

  public function update(UpdateAttendanceRequest $request, Attendance $attendance): JsonResponse
  {
    try {
      $attendance->update($request->validated());
      return (new AttendanceResource($attendance))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error updating attendance: ' . $e->getMessage()], 500);
    }
  }

  public function destroy(Attendance $attendance): JsonResponse
  {
    try {
      $attendance->delete();
      return response()->json(['message' => 'Attendance deleted successfully.'], 204);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error deleting attendance: ' . $e->getMessage()], 500);
    }
  }

  public function restore(string $id): JsonResponse
  {
    try {
      $attendance = Attendance::onlyTrashed()->findOrFail($id);
      $attendance->restore();
      return (new AttendanceResource($attendance))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error restoring attendance: ' . $e->getMessage()], 500);
    }
  }

  public function forceDelete(string $id): JsonResponse
  {
    try {
      $attendance = Attendance::onlyTrashed()->findOrFail($id);
      $attendance->forceDelete();
      return response()->json(['message' => 'Attendance permanently deleted.'], 204);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error permanently deleting attendance: ' . $e->getMessage()], 500);
    }
  }
}
