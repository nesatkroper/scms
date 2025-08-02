<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExamRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'name' => ['required', 'string', 'max:255'],
      'description' => ['nullable', 'string'],
      'subject_id' => ['required', 'exists:subjects,id'],
      'date' => ['required', 'date', 'after_or_equal:today'],
      'total_marks' => ['required', 'integer', 'min:1'],
      'passing_marks' => ['required', 'integer', 'min:0', 'lt:total_marks'],
    ];
  }
}
