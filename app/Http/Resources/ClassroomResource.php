<?php


namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClassroomResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'room_number' => $this->room_number,
            'capacity' => $this->capacity,
            'facilities' => $this->facilities,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}