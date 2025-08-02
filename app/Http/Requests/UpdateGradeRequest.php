<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateGradeRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'student_id' => ['sometimes', 'exists:students,id'],
      'exam_id' => [
        'sometimes',
        'exists:exams,id',
        // Ensure a student only has one grade per exam, ignoring current record
        Rule::unique('grades')
          ->ignore($this->route('grade'))
          ->where(function ($query) {
            $studentId = $this->input('student_id', $this->grade->student_id);
            return $query->where('student_id', $studentId);
          }),
      ],
      'marks_obtained' => ['sometimes', 'numeric', 'min:0'],
      'comments' => ['sometimes', 'nullable', 'string'],
    ];
  }

  public function messages(): array
  {
    return [
      'exam_id.unique' => 'This student already has a grade for this exam.',
    ];
  }
}
