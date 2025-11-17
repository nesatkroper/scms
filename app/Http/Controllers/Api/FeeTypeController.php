<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FeeType;
use App\Http\Requests\FeeTypeRequest;
use App\Http\Resources\FeeTypeResource;
use Illuminate\Http\Request;

class FeeTypeController extends Controller
{
    public function index()
    {
        $items = FeeType::all();
        return FeeTypeResource::collection($items);
    }

    public function store(FeeTypeRequest $request)
    {
        $item = FeeType::create($request->validated());
        return new FeeTypeResource($item);
    }

    public function show($id)
    {
        $item = FeeType::findOrFail($id);
        return new FeeTypeResource($item);
    }

    public function update(FeeTypeRequest $request, $id)
    {
        $item = FeeType::findOrFail($id);
        $item->update($request->validated());
        return new FeeTypeResource($item);
    }

    public function destroy($id)
    {
        $item = FeeType::findOrFail($id);
        $item->delete();
        return response()->json(['message' => 'FeeType deleted successfully']);
    }
}