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
            'grade_level' => new GradeLevelResource($this->whenLoaded('gradeLevel')),
            'teacher' => new TeacherResource($this->whenLoaded('teacher')),
            'capacity' => $this->capacity,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}