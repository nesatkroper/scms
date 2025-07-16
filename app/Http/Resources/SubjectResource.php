<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubjectResource extends JsonResource
{
  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'name' => $this->name,
      'code' => $this->code,
      'department_id' => $this->department_id,
      'department' => new DepartmentResource($this->whenLoaded('department')),
      'description' => $this->description,
      'credit_hours' => $this->credit_hours,
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
      'deleted_at' => $this->deleted_at,
      'course_offerings' => CourseOfferingResource::collection($this->whenLoaded('courseOfferings')),
      'exams' => ExamResource::collection($this->whenLoaded('exams')),
    ];
  }
}
