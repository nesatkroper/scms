<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::all();
        return view('admin.attendances.index', compact('attendances'));
    }

    public function create()
    {
        return view('admin.attendances.create');
    }

    public function store(StoreAttendanceRequest $request)
    {
        Attendance::create($request->validated());
        return redirect()->route('admin.attendances.index')->with('success', 'Attendance created successfully');
    }

    public function edit($id)
    {
        $attendance = Attendance::findOrFail($id);
        return view('admin.attendances.edit', compact('attendance'));
    }

    public function update(UpdateAttendanceRequest $request, $id)
    {
        $attendance = Attendance::findOrFail($id);
        $($request->validated());
        return redirect()->route('admin.attendances.index')->with('success', 'Attendance updated successfully');
    }

    public function destroy($id)
    {
        $attendance = Attendance::findOrFail($id);
        $();
        return redirect()->route('admin.attendances.index')->with('success', 'Attendance deleted successfully');
    }
}