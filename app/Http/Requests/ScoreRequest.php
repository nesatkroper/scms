<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScoreRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'student_id' => 'required|exists:users,id',
      'exam_id'    => 'required|exists:exams,id',
      'score'      => 'required|integer|min:0',
      'grade'      => 'nullable|string|max:5',
      'remarks'    => 'nullable|string',
    ];
  }

  public function messages(): array
  {
    return [
      'student_id.required' => 'Student is required.',
      'exam_id.required'    => 'Exam is required.',
      'score.required'      => 'Score is required.',
      'score.integer'       => 'Score must be an integer.',
      'score.min'           => 'Score cannot be negative.',
    ];
  }
}
