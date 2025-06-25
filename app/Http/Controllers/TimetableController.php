<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTimetableRequest;
use App\Http\Requests\UpdateTimetableRequest;
use App\Models\Timetable;
use App\Models\Section; 

class TimetableController extends Controller
{
    public function index()
    {
        $timetables = Timetable::with(['section', 'entries'])->paginate(10);
        return view('timetables.index', compact('timetables'));
    }

    public function create()
    {
        $sections = Section::all();
        return view('timetables.create', compact('sections'));
    }

    public function store(StoreTimetableRequest $request)
    {
        $timetable = Timetable::create($request->validated());
        return redirect()->route('timetables.index')->with('success', 'Timetable created successfully!');
    }

    public function show(Timetable $timetable)
    {
        $timetable->load(['section', 'entries']);
        return view('timetables.show', compact('timetable'));
    }

    public function edit(Timetable $timetable)
    {
        $timetable->load(['section', 'entries']);
        $sections = Section::all();
        return view('timetables.edit', compact('timetable', 'sections'));
    }

    public function update(UpdateTimetableRequest $request, Timetable $timetable)
    {
        $timetable->update($request->validated());
        return redirect()->route('timetables.show', $timetable)->with('success', 'Timetable updated successfully!');
    }

    public function destroy(Timetable $timetable)
    {
        $timetable->delete();
        return redirect()->route('timetables.index')->with('success', 'Timetable deleted successfully!');
    }
}
