<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentFeeResource extends JsonResource
{
  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'student_id' => $this->student_id,
      'student' => new StudentResource($this->whenLoaded('student')),
      'fee_structure_id' => $this->fee_structure_id,
      'fee_structure' => new FeeStructureResource($this->whenLoaded('feeStructure')),
      'amount' => $this->amount,
      'discount' => $this->discount,
      'paid_amount' => $this->paid_amount,
      'status' => $this->status,
      'due_date' => $this->due_date->format('Y-m-d'),
      'remarks' => $this->remarks,
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
      'deleted_at' => $this->deleted_at,
      'payments' => PaymentResource::collection($this->whenLoaded('payments')),
    ];
  }
}
