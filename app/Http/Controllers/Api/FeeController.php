<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Fee;
use App\Http\Requests\FeeRequest;
use App\Http\Resources\FeeResource;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    public function index()
    {
        $items = Fee::all();
        return FeeResource::collection($items);
    }

    public function store(FeeRequest $request)
    {
        $item = Fee::create($request->validated());
        return new FeeResource($item);
    }

    public function show($id)
    {
        $item = Fee::findOrFail($id);
        return new FeeResource($item);
    }

    public function update(FeeRequest $request, $id)
    {
        $item = Fee::findOrFail($id);
        $item->update($request->validated());
        return new FeeResource($item);
    }

    public function destroy($id)
    {
        $item = Fee::findOrFail($id);
        $item->delete();
        return response()->json(['message' => 'Fee deleted successfully']);
    }
}