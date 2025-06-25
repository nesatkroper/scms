<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTimetableEntryRequest;
use App\Http\Requests\UpdateTimetableEntryRequest;
use App\Http\Resources\TimetableEntryResource;
use App\Models\TimetableEntry;

class TimetableEntryController extends Controller
{
    public function index()
    {
        $timetableEntries = TimetableEntry::with(['timetable', 'classSubject'])->paginate(10);
        return TimetableEntryResource::collection($timetableEntries);
    }

    public function store(StoreTimetableEntryRequest $request)
    {
        $timetableEntry = TimetableEntry::create($request->validated());
        $timetableEntry->load(['timetable', 'classSubject']);
        return new TimetableEntryResource($timetableEntry);
    }

    public function show(TimetableEntry $timetableEntry)
    {
        $timetableEntry->load(['timetable', 'classSubject']);
        return new TimetableEntryResource($timetableEntry);
    }

    public function update(UpdateTimetableEntryRequest $request, TimetableEntry $timetableEntry)
    {
        $timetableEntry->update($request->validated());
        $timetableEntry->load(['timetable', 'classSubject']);
        return new TimetableEntryResource($timetableEntry);
    }

    public function destroy(TimetableEntry $timetableEntry)
    {
        $timetableEntry->delete();
        return response()->json(['message' => 'Timetable entry deleted'], 204);
    }
}