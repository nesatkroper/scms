<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTimetableSlotRequest;
use App\Http\Requests\UpdateTimetableSlotRequest;
use App\Http\Resources\TimetableSlotResource;
use App\Models\TimetableSlot;
use Illuminate\Http\JsonResponse;

class TimetableSlotController extends Controller
{
  public function index(): JsonResponse
  {
    try {
      $timetableSlots = TimetableSlot::withTrashed()->with('courseOffering')->paginate(10);
      return TimetableSlotResource::collection($timetableSlots)->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error retrieving timetable slots: ' . $e->getMessage()], 500);
    }
  }

  public function store(StoreTimetableSlotRequest $request): JsonResponse
  {
    try {
      $timetableSlot = TimetableSlot::create($request->validated());
      return (new TimetableSlotResource($timetableSlot))->response()->setStatusCode(201);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error creating timetable slot: ' . $e->getMessage()], 500);
    }
  }

  public function show(TimetableSlot $timetableSlot): JsonResponse
  {
    try {
      $timetableSlot->load('courseOffering');
      return (new TimetableSlotResource($timetableSlot))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error retrieving timetable slot: ' . $e->getMessage()], 500);
    }
  }

  public function update(UpdateTimetableSlotRequest $request, TimetableSlot $timetableSlot): JsonResponse
  {
    try {
      $timetableSlot->update($request->validated());
      return (new TimetableSlotResource($timetableSlot))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error updating timetable slot: ' . $e->getMessage()], 500);
    }
  }

  public function destroy(TimetableSlot $timetableSlot): JsonResponse
  {
    try {
      $timetableSlot->delete();
      return response()->json(['message' => 'Timetable slot deleted successfully.'], 204);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error deleting timetable slot: ' . $e->getMessage()], 500);
    }
  }

  public function restore(string $id): JsonResponse
  {
    try {
      $timetableSlot = TimetableSlot::onlyTrashed()->findOrFail($id);
      $timetableSlot->restore();
      return (new TimetableSlotResource($timetableSlot))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error restoring timetable slot: ' . $e->getMessage()], 500);
    }
  }

  public function forceDelete(string $id): JsonResponse
  {
    try {
      $timetableSlot = TimetableSlot::onlyTrashed()->findOrFail($id);
      $timetableSlot->forceDelete();
      return response()->json(['message' => 'Timetable slot permanently deleted.'], 204);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error permanently deleting timetable slot: ' . $e->getMessage()], 500);
    }
  }
}
