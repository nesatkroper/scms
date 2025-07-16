<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TimetableSlotResource extends JsonResource
{
  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'course_offering_id' => $this->course_offering_id,
      'course_offering' => new CourseOfferingResource($this->whenLoaded('courseOffering')),
      'start_time' => $this->start_time->format('H:i:s'),
      'end_time' => $this->end_time->format('H:i:s'),
      'day' => $this->day,
      'room_override' => $this->room_override,
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
      'deleted_at' => $this->deleted_at,
    ];
  }
}
