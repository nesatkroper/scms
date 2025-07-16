<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseOfferingRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'subject_id' => ['required', 'exists:subjects,id'],
      'teacher_id' => ['required', 'exists:teachers,id'],
      'classroom_id' => ['required', 'exists:classrooms,id'],
      'section_id' => ['nullable', 'exists:sections,id'],
      'semester' => ['nullable', 'string', 'max:255'],
      'academic_year' => ['required', 'integer', 'min:1900', 'max:' . (date('Y') + 5)],
    ];
  }
}
