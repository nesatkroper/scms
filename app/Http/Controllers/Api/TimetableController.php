<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTimetableRequest;
use App\Http\Requests\UpdateTimetableRequest;
use App\Http\Resources\TimetableResource;
use App\Models\Timetable;
use Illuminate\Http\JsonResponse;

class TimetableController extends Controller
{
  public function index(): JsonResponse
  {
    try {
      $timetables = Timetable::withTrashed()->with('section')->paginate(10);
      return TimetableResource::collection($timetables)->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error retrieving timetables: ' . $e->getMessage()], 500);
    }
  }

  public function store(StoreTimetableRequest $request): JsonResponse
  {
    try {
      $timetable = Timetable::create($request->validated());
      return (new TimetableResource($timetable))->response()->setStatusCode(201);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error creating timetable: ' . $e->getMessage()], 500);
    }
  }

  public function show(Timetable $timetable): JsonResponse
  {
    try {
      $timetable->load('section');
      return (new TimetableResource($timetable))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error retrieving timetable: ' . $e->getMessage()], 500);
    }
  }

  public function update(UpdateTimetableRequest $request, Timetable $timetable): JsonResponse
  {
    try {
      $timetable->update($request->validated());
      return (new TimetableResource($timetable))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error updating timetable: ' . $e->getMessage()], 500);
    }
  }

  public function destroy(Timetable $timetable): JsonResponse
  {
    try {
      $timetable->delete();
      return response()->json(['message' => 'Timetable deleted successfully.'], 204);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error deleting timetable: ' . $e->getMessage()], 500);
    }
  }

  public function restore(string $id): JsonResponse
  {
    try {
      $timetable = Timetable::onlyTrashed()->findOrFail($id);
      $timetable->restore();
      return (new TimetableResource($timetable))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error restoring timetable: ' . $e->getMessage()], 500);
    }
  }

  public function forceDelete(string $id): JsonResponse
  {
    try {
      $timetable = Timetable::onlyTrashed()->findOrFail($id);
      $timetable->forceDelete();
      return response()->json(['message' => 'Timetable permanently deleted.'], 204);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error permanently deleting timetable: ' . $e->getMessage()], 500);
    }
  }
}
