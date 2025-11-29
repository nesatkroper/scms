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
      'payment_date'   => ['required', 'date'],
      'payment_method' => ['nullable', 'string', 'max:50'],
      'transaction_id' => ['nullable', 'string', 'max:100'],
      'remarks'        => ['nullable', 'string'],
      'received_by'    => ['nullable', 'exists:users,id'],
    ];
  }
}
