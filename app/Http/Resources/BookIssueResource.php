<?php


namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookIssueResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'book' => new BookResource($this->whenLoaded('book')),
            'user' => new UserResource($this->whenLoaded('user')),
            'issue_date' => $this->issue_date,
            'due_date' => $this->due_date,
            'return_date' => $this->return_date,
            'fine' => $this->fine,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}