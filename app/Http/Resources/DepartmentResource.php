<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentResource extends JsonResource
{
  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'name' => $this->name,
      'description' => $this->description,
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
      'deleted_at' => $this->deleted_at,
      'teachers' => TeacherResource::collection($this->whenLoaded('teachers')),
      'subjects' => SubjectResource::collection($this->whenLoaded('subjects')),
    ];
  }
}
