<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeeRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'student_id' => 'required|exists:users,id',
      'fee_type_id' => 'required|exists:fee_types,id',
      'enrollment_id' => 'required|exists:enrollments,id',
      'amount' => 'required|numeric|min:0',
      'due_date' => 'nullable|date',
      'payment_date' => 'nullable|date',
      'payment_method' => 'nullable|string|max:100',
      'transaction_id' => 'nullable|string|max:255',
      'received_by' => 'nullable|exists:users,id',
      'remarks' => 'nullable|string',
    ];
  }


  public function messages(): array
  {
    return [
      'student_id.required' => 'Student is required.',
      'fee_type_id.required' => 'Fee type is required.',
      'enrollment_id.required' => 'Enrollment is required.',
      'amount.required' => 'Amount is required.',
    ];
  }
}
