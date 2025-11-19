<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Http\Requests\AttendanceRequest;
use App\Http\Resources\AttendanceResource;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $items = Attendance::all();
        return AttendanceResource::collection($items);
    }

    public function store(AttendanceRequest $request)
    {
        $item = Attendance::create($request->validated());
        return new AttendanceResource($item);
    }

    public function show($id)
    {
        $item = Attendance::findOrFail($id);
        return new AttendanceResource($item);
    }

    public function update(AttendanceRequest $request, $id)
    {
        $item = Attendance::findOrFail($id);
        $item->update($request->validated());
        return new AttendanceResource($item);
    }

    public function destroy($id)
    {
        $item = Attendance::findOrFail($id);
        $item->delete();
        return response()->json(['message' => 'Attendance deleted successfully']);
    }
}