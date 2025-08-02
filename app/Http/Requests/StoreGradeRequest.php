<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreGradeRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'student_id' => ['required', 'exists:students,id'],
      'exam_id' => [
        'required',
        'exists:exams,id',
        // Ensure a student only has one grade per exam
        Rule::unique('grades')->where(function ($query) {
          return $query->where('student_id', $this->student_id);
        }),
      ],
      'marks_obtained' => ['required', 'numeric', 'min:0'],
      'comments' => ['nullable', 'string'],
    ];
  }

  public function messages(): array
  {
    return [
      'exam_id.unique' => 'This student already has a grade for this exam.',
    ];
  }
}
