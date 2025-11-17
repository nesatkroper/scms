<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Http\Requests\ClassroomRequest;
use App\Http\Resources\ClassroomResource;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function index()
    {
        $items = Classroom::all();
        return ClassroomResource::collection($items);
    }

    public function store(ClassroomRequest $request)
    {
        $item = Classroom::create($request->validated());
        return new ClassroomResource($item);
    }

    public function show($id)
    {
        $item = Classroom::findOrFail($id);
        return new ClassroomResource($item);
    }

    public function update(ClassroomRequest $request, $id)
    {
        $item = Classroom::findOrFail($id);
        $item->update($request->validated());
        return new ClassroomResource($item);
    }

    public function destroy($id)
    {
        $item = Classroom::findOrFail($id);
        $item->delete();
        return response()->json(['message' => 'Classroom deleted successfully']);
    }
}