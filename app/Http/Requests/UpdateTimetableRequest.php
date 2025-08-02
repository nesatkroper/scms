<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTimetableRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'section_id' => ['sometimes', 'exists:sections,id'],
      'title' => ['sometimes', 'string', 'max:255'],
      'description' => ['sometimes', 'nullable', 'string'],
      'is_active' => ['sometimes', 'boolean'],
      'start_date' => ['sometimes', 'date'],
      'end_date' => ['sometimes', 'date', 'after_or_equal:start_date'],
    ];
  }
}
