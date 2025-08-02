<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AttendanceResource extends JsonResource
{
  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'student_id' => $this->student_id,
      'student' => new StudentResource($this->whenLoaded('student')),
      'course_offering_id' => $this->course_offering_id,
      'course_offering' => new CourseOfferingResource($this->whenLoaded('courseOffering')),
      'date' => $this->date->format('Y-m-d'),
      'status' => $this->status,
      'remarks' => $this->remarks,
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
      'deleted_at' => $this->deleted_at,
    ];
  }
}
