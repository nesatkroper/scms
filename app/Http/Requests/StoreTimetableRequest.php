<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTimetableRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'section_id' => ['required', 'exists:sections,id'],
      'title' => ['required', 'string', 'max:255'],
      'description' => ['nullable', 'string'],
      'is_active' => ['boolean'],
      'start_date' => ['required', 'date'],
      'end_date' => ['required', 'date', 'after_or_equal:start_date'],
    ];
  }
}
