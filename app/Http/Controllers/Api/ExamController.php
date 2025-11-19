<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Http\Requests\ExamRequest;
use App\Http\Resources\ExamResource;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index()
    {
        $items = Exam::all();
        return ExamResource::collection($items);
    }

    public function store(ExamRequest $request)
    {
        $item = Exam::create($request->validated());
        return new ExamResource($item);
    }

    public function show($id)
    {
        $item = Exam::findOrFail($id);
        return new ExamResource($item);
    }

    public function update(ExamRequest $request, $id)
    {
        $item = Exam::findOrFail($id);
        $item->update($request->validated());
        return new ExamResource($item);
    }

    public function destroy($id)
    {
        $item = Exam::findOrFail($id);
        $item->delete();
        return response()->json(['message' => 'Exam deleted successfully']);
    }
}