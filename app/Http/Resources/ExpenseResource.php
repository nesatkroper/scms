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
      'date' => $this->date->format('Y-m-d'),
      'expense_category_id' => $this->expense_category_id,
      'category' => new ExpenseCategoryResource($this->whenLoaded('category')),
      'approved_by' => $this->approved_by,
      'approver' => new UserResource($this->whenLoaded('approvedBy')),
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
      'deleted_at' => $this->deleted_at,
    ];
  }
}
