<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttendanceRequest;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::with(['student', 'classSubject'])->paginate(10);
        return view('attendances.index', compact('attendances'));
    }

    public function create()
    {
        return view('attendances.create');
    }

    public function store(AttendanceRequest $request)
    {
        Attendance::create($request->validated());
        return redirect()->route('attendances.index')->with('success', 'Attendance recorded successfully!');
    }

    public function show(Attendance $attendance)
    {
        $attendance->load(['student', 'classSubject']);
        return view('attendances.show', compact('attendance'));
    }

    public function edit(Attendance $attendance)
    {
        $attendance->load(['student', 'classSubject']);
        return view('attendances.edit', compact('attendance'));
    }

    public function update(AttendanceRequest $request, Attendance $attendance)
    {
        $attendance->update($request->validated());
        return redirect()->route('attendances.show', $attendance)->with('success', 'Attendance updated successfully!');
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return redirect()->route('attendances.index')->with('success', 'Attendance deleted successfully!');
    }
}
