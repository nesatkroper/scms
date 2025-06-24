<?php


namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TeacherResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'teacher_id' => $this->teacher_id,
            'department' => new DepartmentResource($this->whenLoaded('department')),
            'joining_date' => $this->joining_date,
            'qualification' => $this->qualification,
            'specialization' => $this->specialization,
            'salary' => $this->salary,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}