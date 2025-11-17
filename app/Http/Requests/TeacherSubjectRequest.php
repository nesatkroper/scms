<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherSubjectRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'teacher_id' => 'required|exists:users,id',
      'subject_id' => 'required|exists:subjects,id',
    ];
  }

  public function messages(): array
  {
    return [
      'teacher_id.required' => 'Teacher is required.',
      'teacher_id.exists' => 'Selected teacher does not exist.',
      'subject_id.required' => 'Subject is required.',
      'subject_id.exists' => 'Selected subject does not exist.',
    ];
  }
}
