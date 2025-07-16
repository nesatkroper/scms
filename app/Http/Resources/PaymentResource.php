<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'student_fee_id' => $this->student_fee_id,
      'student_fee' => new StudentFeeResource($this->whenLoaded('studentFee')),
      'amount' => $this->amount,
      'payment_date' => $this->payment_date->format('Y-m-d'),
      'payment_method' => $this->payment_method,
      'transaction_id' => $this->transaction_id,
      'remarks' => $this->remarks,
      'received_by' => $this->received_by,
      'receiver' => new UserResource($this->whenLoaded('receivedBy')),
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
      'deleted_at' => $this->deleted_at,
    ];
  }
}
