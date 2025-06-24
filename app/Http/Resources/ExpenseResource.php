<?php


namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'amount' => $this->amount,
            'date' => $this->date,
            'category' => $this->category,
            'approved_by' => new UserResource($this->whenLoaded('approver')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}