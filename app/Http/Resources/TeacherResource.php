<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TeacherResource extends JsonResource
{
  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'teacher_id' => $this->teacher_id,
      'department_id' => $this->department_id,
      'department' => new DepartmentResource($this->whenLoaded('department')),
      'user_id' => $this->user_id,
      'user' => new UserResource($this->whenLoaded('user')),
      'joining_date' => $this->joining_date->format('Y-m-d'),
      'qualification' => $this->qualification,
      'experience' => $this->experience,
      'phone' => $this->phone,
      'email' => $this->email,
      'address' => $this->address,
      'specialization' => $this->specialization,
      'salary' => $this->salary,
      'photo' => $this->photo,
      'cv' => $this->cv,
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
      'deleted_at' => $this->deleted_at,
      'sections' => SectionResource::collection($this->whenLoaded('sections')),
      'course_offerings' => CourseOfferingResource::collection($this->whenLoaded('courseOfferings')),
      'book_issues' => BookIssueResource::collection($this->whenLoaded('bookIssues')),
    ];
  }
}
