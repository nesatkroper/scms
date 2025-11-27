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
    $feeId = $this->route('fee_id') ?? $this->input('fee_id');

    return [
      'fee_id' => ['required', 'integer', 'exists:fees,id'],

      'amount' => ['required', 'numeric', 'min:0.01'],

      'payment_date' => ['required', 'date'],

      'payment_method' => ['nullable', 'string', 'max:50'],

      'transaction_id' => [
        'nullable',
        'string',
        'max:100',
        \Illuminate\Validation\Rule::unique('payments')->ignore($this->route('payment')),
      ],

      'remarks' => ['nullable', 'string'],

      'received_by' => ['nullable', 'integer', 'exists:users,id'],
    ];
  }
}
