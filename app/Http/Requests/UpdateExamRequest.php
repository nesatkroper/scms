<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExamRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'name' => ['sometimes', 'string', 'max:255'],
      'description' => ['sometimes', 'nullable', 'string'],
      'subject_id' => ['sometimes', 'exists:subjects,id'],
      'date' => ['sometimes', 'date', 'after_or_equal:today'],
      'total_marks' => ['sometimes', 'integer', 'min:1'],
      'passing_marks' => ['sometimes', 'integer', 'min:0', 'lt:total_marks'],
    ];
  }
}
