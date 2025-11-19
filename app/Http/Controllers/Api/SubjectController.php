<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Http\Requests\SubjectRequest;
use App\Http\Resources\SubjectResource;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $items = Subject::all();
        return SubjectResource::collection($items);
    }

    public function store(SubjectRequest $request)
    {
        $item = Subject::create($request->validated());
        return new SubjectResource($item);
    }

    public function show($id)
    {
        $item = Subject::findOrFail($id);
        return new SubjectResource($item);
    }

    public function update(SubjectRequest $request, $id)
    {
        $item = Subject::findOrFail($id);
        $item->update($request->validated());
        return new SubjectResource($item);
    }

    public function destroy($id)
    {
        $item = Subject::findOrFail($id);
        $item->delete();
        return response()->json(['message' => 'Subject deleted successfully']);
    }
}