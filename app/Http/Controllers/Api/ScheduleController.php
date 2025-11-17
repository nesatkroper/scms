<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Http\Requests\ScheduleRequest;
use App\Http\Resources\ScheduleResource;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $items = Schedule::all();
        return ScheduleResource::collection($items);
    }

    public function store(ScheduleRequest $request)
    {
        $item = Schedule::create($request->validated());
        return new ScheduleResource($item);
    }

    public function show($id)
    {
        $item = Schedule::findOrFail($id);
        return new ScheduleResource($item);
    }

    public function update(ScheduleRequest $request, $id)
    {
        $item = Schedule::findOrFail($id);
        $item->update($request->validated());
        return new ScheduleResource($item);
    }

    public function destroy($id)
    {
        $item = Schedule::findOrFail($id);
        $item->delete();
        return response()->json(['message' => 'Schedule deleted successfully']);
    }
}