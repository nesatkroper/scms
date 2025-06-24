<?php


namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TimetableEntryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'timetable' => new TimetableResource($this->whenLoaded('timetable')),
            'class_subject' => new ClassSubjectResource($this->whenLoaded('classSubject')),
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'day' => $this->day,
            'room' => $this->room,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
