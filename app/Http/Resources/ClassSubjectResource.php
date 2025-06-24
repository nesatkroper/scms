<?php


namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClassSubjectResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'section' => new SectionResource($this->whenLoaded('section')),
            'subject' => new SubjectResource($this->whenLoaded('subject')),
            'teacher' => new TeacherResource($this->whenLoaded('teacher')),
            'room' => $this->room,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'day' => $this->day,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
