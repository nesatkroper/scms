<?php


namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'date' => $this->date,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'location' => $this->location,
            'type' => $this->type,
            'is_holiday' => $this->is_holiday,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
