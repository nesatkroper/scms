<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NoticeResource extends JsonResource
{
  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'title' => $this->title,
      'content' => $this->content,
      'audience' => $this->audience,
      'start_date' => $this->start_date->format('Y-m-d'),
      'end_date' => $this->end_date->format('Y-m-d'),
      'is_published' => $this->is_published,
      'created_by' => $this->created_by,
      'creator' => new UserResource($this->whenLoaded('createdBy')),
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
      'deleted_at' => $this->deleted_at,
    ];
  }
}
