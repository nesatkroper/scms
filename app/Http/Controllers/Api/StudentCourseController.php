<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StudentCourse;
use App\Http\Requests\StudentCourseRequest;
use App\Http\Resources\StudentCourseResource;
use Illuminate\Http\Request;

class StudentCourseController extends Controller
{
    public function index()
    {
        $items = StudentCourse::all();
        return StudentCourseResource::collection($items);
    }

    public function store(StudentCourseRequest $request)
    {
        $item = StudentCourse::create($request->validated());
        return new StudentCourseResource($item);
    }

    public function show($id)
    {
        $item = StudentCourse::findOrFail($id);
        return new StudentCourseResource($item);
    }

    public function update(StudentCourseRequest $request, $id)
    {
        $item = StudentCourse::findOrFail($id);
        $item->update($request->validated());
        return new StudentCourseResource($item);
    }

    public function destroy($id)
    {
        $item = StudentCourse::findOrFail($id);
        $item->delete();
        return response()->json(['message' => 'StudentCourse deleted successfully']);
    }
}