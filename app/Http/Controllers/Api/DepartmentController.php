<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Http\Resources\DepartmentResource;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::with(['head', 'teachers', 'subjects'])->paginate(10);
        return DepartmentResource::collection($departments);
    }

    public function store(StoreDepartmentRequest $request)
    {
        $department = Department::create($request->validated());
        $department->load(['head', 'teachers', 'subjects']);
        return new DepartmentResource($department);
    }

    public function show(Department $department)
    {
        $department->load(['head', 'teachers', 'subjects']);
        return new DepartmentResource($department);
    }

    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        $department->update($request->validated());
        $department->load(['head', 'teachers', 'subjects']);
        return new DepartmentResource($department);
    }

    public function destroy(Department $department)
    {
        $department->delete();
        return response()->json(['message' => 'Department deleted'], 204);
    }
}
