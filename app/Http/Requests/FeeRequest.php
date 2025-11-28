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
      'student_course_id' => 'required|exists:student_course,id',
      'amount' => 'required|numeric|min:0',
      'due_date' => 'nullable|date',
      'status' => 'required|in:unpaid,partially_paid,paid',
      'remarks' => 'nullable|string',
    ];
  }

  public function messages(): array
  {
    return [
      'student_id.required' => 'Student is required.',
      'student_id.exists' => 'Selected student does not exist.',
      'fee_type_id.required' => 'Fee type is required.',
      'student_course_id.required' => 'Fee type is required.',
      'fee_type_id.exists' => 'Selected fee type does not exist.',
      'amount.required' => 'Amount is required.',
      'amount.numeric' => 'Amount must be a number.',
      'status.required' => 'Fee status is required.',
      'status.in' => 'Status must be unpaid, partially_paid, or paid.',
    ];
  }
}
