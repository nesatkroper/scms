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
      'category_id' => $this->category_id,
      'category' => new BookCategoryResource($this->whenLoaded('category')),
      'author' => $this->author,
      'isbn' => $this->isbn,
      'publication_year' => $this->publication_year,
      'publisher' => $this->publisher,
      'quantity' => $this->quantity,
      'description' => $this->description,
      'cover_image' => $this->cover_image,
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
      'deleted_at' => $this->deleted_at,
      'issues' => BookIssueResource::collection($this->whenLoaded('issues')),
    ];
  }
}
