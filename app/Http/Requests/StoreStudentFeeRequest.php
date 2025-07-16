<?php

namespace App\Http\Requests;

use App\Enums\PaymentStatusEnum;  // Assuming you create this Enum
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreStudentFeeRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'student_id' => ['required', 'exists:students,id'],
      'fee_structure_id' => ['required', 'exists:fee_structures,id'],
      'amount' => ['required', 'numeric', 'min:0'],
      'discount' => ['nullable', 'numeric', 'min:0', 'lt:amount'],
      'paid_amount' => ['nullable', 'numeric', 'min:0', 'lte:amount'],
      'status' => ['required', 'string', Rule::in(array_column(PaymentStatusEnum::cases(), 'value'))],
      'due_date' => ['required', 'date'],
      'remarks' => ['nullable', 'string'],
    ];
  }
}
