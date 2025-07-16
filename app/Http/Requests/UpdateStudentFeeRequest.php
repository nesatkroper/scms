<?php

namespace App\Http\Requests;

use App\Enums\PaymentStatusEnum;  // Assuming you create this Enum
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentFeeRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'student_id' => ['sometimes', 'exists:students,id'],
      'fee_structure_id' => ['sometimes', 'exists:fee_structures,id'],
      'amount' => ['sometimes', 'numeric', 'min:0'],
      'discount' => ['sometimes', 'nullable', 'numeric', 'min:0', 'lt:amount'],
      'paid_amount' => ['sometimes', 'nullable', 'numeric', 'min:0', 'lte:amount'],
      'status' => ['sometimes', 'string', Rule::in(array_column(PaymentStatusEnum::cases(), 'value'))],
      'due_date' => ['sometimes', 'date'],
      'remarks' => ['sometimes', 'nullable', 'string'],
    ];
  }
}
