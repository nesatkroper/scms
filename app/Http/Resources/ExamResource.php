<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExamResource extends JsonResource
{
  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'name' => $this->name,
      'description' => $this->description,
      'subject_id' => $this->subject_id,
      'subject' => new SubjectResource($this->whenLoaded('subject')),
      'date' => $this->date->format('Y-m-d'),
      'total_marks' => $this->total_marks,
      'passing_marks' => $this->passing_marks,
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
      'deleted_at' => $this->deleted_at,
      'grades' => GradeResource::collection($this->whenLoaded('grades')),
    ];
  }
}
