<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TeacherSubject;
use App\Http\Requests\TeacherSubjectRequest;
use App\Http\Resources\TeacherSubjectResource;
use Illuminate\Http\Request;

class TeacherSubjectController extends Controller
{
    public function index()
    {
        $items = TeacherSubject::all();
        return TeacherSubjectResource::collection($items);
    }

    public function store(TeacherSubjectRequest $request)
    {
        $item = TeacherSubject::create($request->validated());
        return new TeacherSubjectResource($item);
    }

    public function show($id)
    {
        $item = TeacherSubject::findOrFail($id);
        return new TeacherSubjectResource($item);
    }

    public function update(TeacherSubjectRequest $request, $id)
    {
        $item = TeacherSubject::findOrFail($id);
        $item->update($request->validated());
        return new TeacherSubjectResource($item);
    }

    public function destroy($id)
    {
        $item = TeacherSubject::findOrFail($id);
        $item->delete();
        return response()->json(['message' => 'TeacherSubject deleted successfully']);
    }
}