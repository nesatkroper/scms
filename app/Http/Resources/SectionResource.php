<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SectionResource extends JsonResource
{
  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'name' => $this->name,
      'grade_level_id' => $this->grade_level_id,
      'grade_level' => new GradeLevelResource($this->whenLoaded('gradeLevel')),
      'teacher_id' => $this->teacher_id,
      'teacher' => new TeacherResource($this->whenLoaded('teacher')),
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
      'deleted_at' => $this->deleted_at,
      'course_offerings' => CourseOfferingResource::collection($this->whenLoaded('courseOfferings')),
      'timetables' => TimetableResource::collection($this->whenLoaded('timetables')),
    ];
  }
}
