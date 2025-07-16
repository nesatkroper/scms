<?php

namespace App\Http\Controllers\Api;  // Updated Namespace

use App\Http\Controllers\Controller;  // Use base Controller
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;
use Illuminate\Http\JsonResponse;

class DepartmentController extends Controller
{
  public function index(): JsonResponse
  {
    try {
      $departments = Department::withTrashed()->paginate(10);
      return DepartmentResource::collection($departments)->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error retrieving departments: ' . $e->getMessage()], 500);
    }
  }

  public function store(StoreDepartmentRequest $request): JsonResponse
  {
    try {
      $department = Department::create($request->validated());
      return (new DepartmentResource($department))->response()->setStatusCode(201);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error creating department: ' . $e->getMessage()], 500);
    }
  }

  public function show(Department $department): JsonResponse
  {
    try {
      return (new DepartmentResource($department))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error retrieving department: ' . $e->getMessage()], 500);
    }
  }

  public function update(UpdateDepartmentRequest $request, Department $department): JsonResponse
  {
    try {
      $department->update($request->validated());
      return (new DepartmentResource($department))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error updating department: ' . $e->getMessage()], 500);
    }
  }

  public function destroy(Department $department): JsonResponse
  {
    try {
      $department->delete();
      return response()->json(['message' => 'Department deleted successfully.'], 204);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error deleting department: ' . $e->getMessage()], 500);
    }
  }

  public function restore(string $id): JsonResponse
  {
    try {
      $department = Department::onlyTrashed()->findOrFail($id);
      $department->restore();
      return (new DepartmentResource($department))->response()->setStatusCode(200);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error restoring department: ' . $e->getMessage()], 500);
    }
  }

  public function forceDelete(string $id): JsonResponse
  {
    try {
      $department = Department::onlyTrashed()->findOrFail($id);
      $department->forceDelete();
      return response()->json(['message' => 'Department permanently deleted.'], 204);
    } catch (\Exception $e) {
      return response()->json(['message' => 'Error permanently deleting department: ' . $e->getMessage()], 500);
    }
  }
}
