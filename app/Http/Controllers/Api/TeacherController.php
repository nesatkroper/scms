<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Http\Resources\TeacherResource;
use App\Models\Teacher;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::with('department')->paginate(10);
        return TeacherResource::collection($teachers);
    }

    public function store(StoreTeacherRequest $request)
    {
        $teacher = Teacher::create($request->validated());
        $teacher->load('department');
        return new TeacherResource($teacher);
    }

    public function show(Teacher $teacher)
    {
        $teacher->load('department');
        return new TeacherResource($teacher);
    }

    public function update(UpdateTeacherRequest $request, Teacher $teacher)
    {
        $teacher->update($request->validated());
        $teacher->load('department');
        return new TeacherResource($teacher);
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return response()->json(['message' => 'Teacher deleted'], 204);
    }
}