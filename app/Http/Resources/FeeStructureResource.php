<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FeeStructureResource extends JsonResource
{
  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'name' => $this->name,
      'grade_level_id' => $this->grade_level_id,
      'grade_level' => new GradeLevelResource($this->whenLoaded('gradeLevel')),
      'amount' => $this->amount,
      'frequency' => $this->frequency,
      'effective_from' => $this->effective_from->format('Y-m-d'),
      'effective_to' => $this->whenNotNull($this->effective_to ? $this->effective_to->format('Y-m-d') : null),
      'description' => $this->description,
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
      'deleted_at' => $this->deleted_at,
      'student_fees' => StudentFeeResource::collection($this->whenLoaded('studentFees')),
    ];
  }
}
