<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Score;
use App\Http\Requests\ScoreRequest;
use App\Http\Resources\ScoreResource;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function index()
    {
        $items = Score::all();
        return ScoreResource::collection($items);
    }

    public function store(ScoreRequest $request)
    {
        $item = Score::create($request->validated());
        return new ScoreResource($item);
    }

    public function show($id)
    {
        $item = Score::findOrFail($id);
        return new ScoreResource($item);
    }

    public function update(ScoreRequest $request, $id)
    {
        $item = Score::findOrFail($id);
        $item->update($request->validated());
        return new ScoreResource($item);
    }

    public function destroy($id)
    {
        $item = Score::findOrFail($id);
        $item->delete();
        return response()->json(['message' => 'Score deleted successfully']);
    }
}