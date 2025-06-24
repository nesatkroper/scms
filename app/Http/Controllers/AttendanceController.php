<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use App\Http\Resources\AttendanceResource;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::with(['student', 'classSubject'])->paginate(10);
        return AttendanceResource::collection($attendances);
    }

    public function store(StoreAttendanceRequest $request)
    {
        $attendance = Attendance::create($request->validated());
        $attendance->load(['student', 'classSubject']);
        return new AttendanceResource($attendance);
    }

    public function show(Attendance $attendance)
    {
        $attendance->load(['student', 'classSubject']);
        return new AttendanceResource($attendance);
    }

    public function update(UpdateAttendanceRequest $request, Attendance $attendance)
    {
        $attendance->update($request->validated());
        $attendance->load(['student', 'classSubject']);
        return new AttendanceResource($attendance);
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return response()->json(['message' => 'Attendance deleted'], 204);
    }
}