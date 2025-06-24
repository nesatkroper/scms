<?php

namespace App\Http\Controllers;



use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClassroomRequest;
use App\Http\Requests\UpdateClassroomRequest;
use App\Http\Resources\ClassroomResource;
use App\Models\Classroom;

class ClassroomController extends Controller
{
    public function index()
    {
        return ClassroomResource::collection(Classroom::paginate(10));
    }

    public function store(StoreClassroomRequest $request)
    {
        $classroom = Classroom::create($request->validated());
        return new ClassroomResource($classroom);
    }

    public function show(Classroom $classroom)
    {
        return new ClassroomResource($classroom);
    }

    public function update(UpdateClassroomRequest $request, Classroom $classroom)
    {
        $classroom->update($request->validated());
        return new ClassroomResource($classroom);
    }

    public function destroy(Classroom $classroom)
    {
        $classroom->delete();
        return response()->json(['message' => 'Classroom deleted'], 204);
    }
}
