<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExamRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'name' => 'required|string|max:255',
      'description' => 'nullable|string',
      'subject_id' => 'required|exists:subjects,id',
      'date' => 'required|date',
      'total_marks' => 'required|integer|min:1',
      'passing_marks' => 'required|integer|min:0|lte:total_marks',
    ];
  }

  public function messages(): array
  {
    return [
      'name.required' => 'Exam name is required.',
      'subject_id.required' => 'Subject is required.',
      'subject_id.exists' => 'Selected subject does not exist.',
      'date.required' => 'Date is required.',
      'total_marks.required' => 'Total marks are required.',
      'total_marks.min' => 'Total marks must be at least 1.',
      'passing_marks.required' => 'Passing marks are required.',
      'passing_marks.lte' => 'Passing marks cannot exceed total marks.',
    ];
  }
}
