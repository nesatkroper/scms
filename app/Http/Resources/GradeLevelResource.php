<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GradeLevelResource extends JsonResource
{
  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'name' => $this->name,
      'code' => $this->code,
      'description' => $this->description,
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
      'deleted_at' => $this->deleted_at,
      'sections' => SectionResource::collection($this->whenLoaded('sections')),
      'students' => StudentResource::collection($this->whenLoaded('students')),
      'fee_structures' => FeeStructureResource::collection($this->whenLoaded('feeStructures')),
    ];
  }
}
