<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTimetableEntryRequest;
use App\Http\Requests\UpdateTimetableEntryRequest;
use App\Models\TimetableEntry;
use App\Models\Timetable; 
use App\Models\ClassSubject; 
use App\Models\Teacher; 

class TimetableEntryController extends Controller
{
    public function index()
    {
        $timetableEntries = TimetableEntry::with(['timetable', 'classSubject'])->paginate(10);
        return view('timetable_entries.index', compact('timetableEntries'));
    }

    public function create()
    {
        $timetables = Timetable::all();
        $classSubjects = ClassSubject::all(); 
        return view('timetable_entries.create', compact('timetables', 'classSubjects'));
    }

    public function store(StoreTimetableEntryRequest $request)
    {
        $timetableEntry = TimetableEntry::create($request->validated());
        return redirect()->route('timetable_entries.index')->with('success', 'Timetable entry created successfully!');
    }

    public function show(TimetableEntry $timetableEntry)
    {
        $timetableEntry->load(['timetable', 'classSubject']);
        return view('timetable_entries.show', compact('timetableEntry'));
    }

    public function edit(TimetableEntry $timetableEntry)
    {
        $timetableEntry->load(['timetable', 'classSubject']);
        $timetables = Timetable::all();
        $classSubjects = ClassSubject::all();
        return view('timetable_entries.edit', compact('timetableEntry', 'timetables', 'classSubjects'));
    }

    public function update(UpdateTimetableEntryRequest $request, TimetableEntry $timetableEntry)
    {
        $timetableEntry->update($request->validated());
        return redirect()->route('timetable_entries.show', $timetableEntry)->with('success', 'Timetable entry updated successfully!');
    }

    public function destroy(TimetableEntry $timetableEntry)
    {
        $timetableEntry->delete();
        return redirect()->route('timetable_entries.index')->with('success', 'Timetable entry deleted successfully!');
    }
}
