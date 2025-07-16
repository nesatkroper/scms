<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGuardianRequest;
use App\Http\Requests\UpdateGuardianRequest;
use App\Http\Resources\GuardianResource;
use App\Models\Guardian;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class GuardianController extends Controller
{
  public function index(): JsonResponse
  {
    try {
      $guardians = Guardian::withTrashed()->paginate(10);
      return GuardianResource::collection($guardians)->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error retrieving guardians: ' . $e->getMessage()], 500);
    }
  }

  public function store(StoreGuardianRequest $request): JsonResponse
  {
    DB::beginTransaction();
    try {
      $guardian = Guardian::create($request->validated());

      if ($request->has('students')) {
        $studentsToAttach = [];
        foreach ($request->input('students') as $studentData) {
          $studentsToAttach[$studentData['student_id']] = ['relation_to_student' => $studentData['relation_to_student'] ?? null];
        }
        $guardian->students()->attach($studentsToAttach);
      }

      DB::commit();
      return (new GuardianResource($guardian->load('students')))->response()->setStatusCode(201);
    } catch (\Exception $e) {
      DB::rollBack();
      return response()->json(['message' => 'Error creating guardian: ' . $e->getMessage()], 500);
    }
  }

  public function show(Guardian $guardian): JsonResponse
  {
    try {
      $guardian->load('students');
      return (new GuardianResource($guardian))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error retrieving guardian: ' . $e->getMessage()], 500);
    }
  }

  public function update(UpdateGuardianRequest $request, Guardian $guardian): JsonResponse
  {
    DB::beginTransaction();
    try {
      $guardian->update($request->validated());

      if ($request->has('students')) {
        $studentsToSync = [];
        foreach ($request->input('students') as $studentData) {
          $studentsToSync[$studentData['student_id']] = ['relation_to_student' => $studentData['relation_to_student'] ?? null];
        }
        $guardian->students()->sync($studentsToSync);
      }

      DB::commit();
      return (new GuardianResource($guardian->load('students')))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      DB::rollBack();
      return response()->json(['message' => 'Error updating guardian: ' . $e->getMessage()], 500);
    }
  }

  public function destroy(Guardian $guardian): JsonResponse
  {
    DB::beginTransaction();
    try {
      $guardian->students()->detach();  // Detach students before soft deleting
      $guardian->delete();
      DB::commit();
      return response()->json(['message' => 'Guardian deleted successfully.'], 204);
    } catch (\Exception $e) {
      DB::rollBack();
      return response()->json(['message' => 'Error deleting guardian: ' . $e->getMessage()], 500);
    }
  }

  public function restore(string $id): JsonResponse
  {
    try {
      $guardian = Guardian::onlyTrashed()->findOrFail($id);
      $guardian->restore();
      return (new GuardianResource($guardian))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error restoring guardian: ' . $e->getMessage()], 500);
    }
  }

  public function forceDelete(string $id): JsonResponse
  {
    DB::beginTransaction();
    try {
      $guardian = Guardian::onlyTrashed()->findOrFail($id);
      $guardian->students()->detach();  // Detach students before force deleting
      $guardian->forceDelete();
      DB::commit();
      return response()->json(['message' => 'Guardian permanently deleted.'], 204);
    } catch (\Exception $e) {
      DB::rollBack();
      return response()->json(['message' => 'Error permanently deleting guardian: ' . $e->getMessage()], 500);
    }
  }
}
