<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTimetableRequest;
use App\Http\Requests\UpdateTimetableRequest;
use App\Http\Resources\TimetableResource;
use App\Models\Timetable;

class TimetableController extends Controller
{
    public function index()
    {
        $timetables = Timetable::with(['section', 'entries'])->paginate(10);
        return TimetableResource::collection($timetables);
    }

    public function store(StoreTimetableRequest $request)
    {
        $timetable = Timetable::create($request->validated());
        $timetable->load(['section', 'entries']);
        return new TimetableResource($timetable);
    }

    public function show(Timetable $timetable)
    {
        $timetable->load(['section', 'entries']);
        return new TimetableResource($timetable);
    }

    public function update(UpdateTimetableRequest $request, Timetable $timetable)
    {
        $timetable->update($request->validated());
        $timetable->load(['section', 'entries']);
        return new TimetableResource($timetable);
    }

    public function destroy(Timetable $timetable)
    {
        $timetable->delete();
        return response()->json(['message' => 'Timetable deleted'], 204);
    }
}