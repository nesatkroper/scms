<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookIssueResource extends JsonResource
{
  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'book_id' => $this->book_id,
      'book' => new BookResource($this->whenLoaded('book')),
      'student_id' => $this->student_id,
      'student' => new StudentResource($this->whenLoaded('student')),
      'teacher_id' => $this->teacher_id,
      'teacher' => new TeacherResource($this->whenLoaded('teacher')),
      'issue_date' => $this->issue_date->format('Y-m-d'),
      'due_date' => $this->due_date->format('Y-m-d'),
      'return_date' => $this->whenNotNull($this->return_date ? $this->return_date->format('Y-m-d') : null),
      'fine' => $this->fine,
      'status' => $this->status,
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
      'deleted_at' => $this->deleted_at,
    ];
  }
}
