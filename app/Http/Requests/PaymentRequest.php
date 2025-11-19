<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'amount' => 'required|numeric|min:0',
      'payment_date' => 'required|date',
      'payment_method' => 'required|string|max:255',
      'transaction_id' => 'nullable|string|max:255',
      'remarks' => 'nullable|string',
      'received_by' => 'required|exists:users,id',
      'student_id' => 'required|exists:users,id',
      'fee_id' => 'nullable|exists:fees,id',
    ];
  }
}
