<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TimetableResource extends JsonResource
{
  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'section_id' => $this->section_id,
      'section' => new SectionResource($this->whenLoaded('section')),
      'title' => $this->title,
      'description' => $this->description,
      'is_active' => $this->is_active,
      'start_date' => $this->start_date->format('Y-m-d'),
      'end_date' => $this->end_date->format('Y-m-d'),
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
      'deleted_at' => $this->deleted_at,
    ];
  }
}
