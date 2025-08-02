<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseOfferingRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'subject_id' => ['sometimes', 'exists:subjects,id'],
      'teacher_id' => ['sometimes', 'exists:teachers,id'],
      'classroom_id' => ['sometimes', 'exists:classrooms,id'],
      'section_id' => ['sometimes', 'nullable', 'exists:sections,id'],
      'semester' => ['sometimes', 'nullable', 'string', 'max:255'],
      'academic_year' => ['sometimes', 'integer', 'min:1900', 'max:' . (date('Y') + 5)],
    ];
  }
}
