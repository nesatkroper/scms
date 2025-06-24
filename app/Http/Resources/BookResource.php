<?php


namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'author' => $this->author,
            'isbn' => $this->isbn,
            'publication_year' => $this->publication_year,
            'publisher' => $this->publisher,
            'quantity' => $this->quantity,
            'description' => $this->description,
            'category' => $this->category,
            'cover_image' => $this->cover_image ? asset('storage/' . $this->cover_image) : null,
            'issues' => BookIssueResource::collection($this->whenLoaded('issues')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}