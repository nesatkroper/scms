<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EnrollmentRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'student_id'        => 'required|exists:users,id',
      'course_offering_id' => 'required|exists:course_offerings,id',
      'status'            => 'required|string|in:studying,suspended,dropped,completed',
      'remarks'           => 'nullable|string|max:500',
    ];
  }

  public function messages(): array
  {
    return [
      'student_id.required'          => 'Student is required.',
      'student_id.exists'            => 'Selected student does not exist.',
      'course_offering_id.required'  => 'Course offering is required.',
      'course_offering_id.exists'    => 'Selected course offering does not exist.',
      'status.required'              => 'Status is required.',
      'status.in'                    => 'Invalid student status.',
      'remarks.max'                  => 'Remarks must not exceed 500 characters.',
    ];
  }
}
