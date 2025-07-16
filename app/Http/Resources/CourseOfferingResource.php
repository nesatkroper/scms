<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseOfferingResource extends JsonResource
{
  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'subject_id' => $this->subject_id,
      'subject' => new SubjectResource($this->whenLoaded('subject')),
      'teacher_id' => $this->teacher_id,
      'teacher' => new TeacherResource($this->whenLoaded('teacher')),
      'classroom_id' => $this->classroom_id,
      'classroom' => new ClassroomResource($this->whenLoaded('classroom')),
      'section_id' => $this->section_id,
      'section' => new SectionResource($this->whenLoaded('section')),
      'semester' => $this->semester,
      'academic_year' => $this->academic_year,
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
      'deleted_at' => $this->deleted_at,
      'timetable_slots' => TimetableSlotResource::collection($this->whenLoaded('timetableSlots')),
      'students' => StudentResource::collection($this->whenLoaded('students')),
      'attendances' => AttendanceResource::collection($this->whenLoaded('attendances')),
    ];
  }
}
