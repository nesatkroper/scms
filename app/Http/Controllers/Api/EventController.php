<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\JsonResponse;

class EventController extends Controller
{
  public function index(): JsonResponse
  {
    try {
      $events = Event::withTrashed()->paginate(10);
      return EventResource::collection($events)->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error retrieving events: ' . $e->getMessage()], 500);
    }
  }

  public function store(StoreEventRequest $request): JsonResponse
  {
    try {
      $event = Event::create($request->validated());
      return (new EventResource($event))->response()->setStatusCode(201);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error creating event: ' . $e->getMessage()], 500);
    }
  }

  public function show(Event $event): JsonResponse
  {
    try {
      return (new EventResource($event))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error retrieving event: ' . $e->getMessage()], 500);
    }
  }

  public function update(UpdateEventRequest $request, Event $event): JsonResponse
  {
    try {
      $event->update($request->validated());
      return (new EventResource($event))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error updating event: ' . $e->getMessage()], 500);
    }
  }

  public function destroy(Event $event): JsonResponse
  {
    try {
      $event->delete();
      return response()->json(['message' => 'Event deleted successfully.'], 204);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error deleting event: ' . $e->getMessage()], 500);
    }
  }

  public function restore(string $id): JsonResponse
  {
    try {
      $event = Event::onlyTrashed()->findOrFail($id);
      $event->restore();
      return (new EventResource($event))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error restoring event: ' . $e->getMessage()], 500);
    }
  }

  public function forceDelete(string $id): JsonResponse
  {
    try {
      $event = Event::onlyTrashed()->findOrFail($id);
      $event->forceDelete();
      return response()->json(['message' => 'Event permanently deleted.'], 204);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error permanently deleting event: ' . $e->getMessage()], 500);
    }
  }
}
