<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GradeResource extends JsonResource
{
  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'student_id' => $this->student_id,
      'student' => new StudentResource($this->whenLoaded('student')),
      'exam_id' => $this->exam_id,
      'exam' => new ExamResource($this->whenLoaded('exam')),
      'marks_obtained' => $this->marks_obtained,
      'comments' => $this->comments,
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
      'deleted_at' => $this->deleted_at,
    ];
  }
}
