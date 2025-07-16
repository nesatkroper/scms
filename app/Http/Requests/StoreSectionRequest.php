<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSectionRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'name' => [
        'required',
        'string',
        'max:255',
        // Ensure name is unique per grade_level
        Rule::unique('sections')->where(function ($query) {
          return $query->where('grade_level_id', $this->grade_level_id);
        }),
      ],
      'grade_level_id' => ['required', 'exists:grade_levels,id'],
      'teacher_id' => ['nullable', 'exists:teachers,id'],
    ];
  }

  public function messages(): array
  {
    return [
      'name.unique' => 'A section with this name already exists for the selected grade level.',
    ];
  }
}
