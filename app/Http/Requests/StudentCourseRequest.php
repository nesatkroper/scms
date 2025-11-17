<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentCourseRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'student_id' => 'required|exists:users,id',
      'subject_id' => 'required|exists:subjects,id',
      'grade_final' => 'nullable|numeric|between:0,100',
    ];
  }

  public function messages(): array
  {
    return [
      'student_id.required' => 'Student is required.',
      'student_id.exists' => 'Selected student does not exist.',
      'subject_id.required' => 'Subject is required.',
      'subject_id.exists' => 'Selected subject does not exist.',
      'grade_final.numeric' => 'Grade must be a number.',
      'grade_final.between' => 'Grade must be between 0 and 100.',
    ];
  }
}
