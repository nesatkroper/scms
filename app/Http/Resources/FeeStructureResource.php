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
            'grade_level' => new GradeLevelResource($this->whenLoaded('gradeLevel')),
            'amount' => $this->amount,
            'frequency' => $this->frequency,
            'effective_from' => $this->effective_from,
            'effective_to' => $this->effective_to,
            'description' => $this->description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}