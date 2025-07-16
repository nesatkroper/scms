<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'student_fee_id' => ['required', 'exists:student_fees,id'],
      'amount' => ['required', 'numeric', 'min:0'],
      'payment_date' => ['required', 'date', 'before_or_equal:today'],
      'payment_method' => ['required', 'string', 'max:255'],
      'transaction_id' => ['nullable', 'string', 'max:255'],
      'remarks' => ['nullable', 'string'],
      'received_by' => ['required', 'exists:users,id'],
    ];
  }
}
