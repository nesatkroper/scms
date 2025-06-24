<?php


namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'key' => $this->key,
            'value' => $this->value,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }


    public function with($request)
    {
        return [
            'meta' => [
                'status' => 'success',
                'message' => 'Setting retrieved successfully',
            ],
        ];
    }
}
