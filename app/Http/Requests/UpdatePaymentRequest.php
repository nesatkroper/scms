<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePaymentRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'student_fee_id' => ['sometimes', 'exists:student_fees,id'],
      'amount' => ['sometimes', 'numeric', 'min:0'],
      'payment_date' => ['sometimes', 'date', 'before_or_equal:today'],
      'payment_method' => ['sometimes', 'string', 'max:255'],
      'transaction_id' => ['sometimes', 'nullable', 'string', 'max:255'],
      'remarks' => ['sometimes', 'nullable', 'string'],
      'received_by' => ['sometimes', 'exists:users,id'],
    ];
  }
}
