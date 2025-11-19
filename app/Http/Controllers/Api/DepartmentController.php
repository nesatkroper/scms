<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Http\Requests\DepartmentRequest;
use App\Http\Resources\DepartmentResource;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $items = Department::all();
        return DepartmentResource::collection($items);
    }

    public function store(DepartmentRequest $request)
    {
        $item = Department::create($request->validated());
        return new DepartmentResource($item);
    }

    public function show($id)
    {
        $item = Department::findOrFail($id);
        return new DepartmentResource($item);
    }

    public function update(DepartmentRequest $request, $id)
    {
        $item = Department::findOrFail($id);
        $item->update($request->validated());
        return new DepartmentResource($item);
    }

    public function destroy($id)
    {
        $item = Department::findOrFail($id);
        $item->delete();
        return response()->json(['message' => 'Department deleted successfully']);
    }
}