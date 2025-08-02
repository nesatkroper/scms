<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSectionRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'name' => [
        'sometimes',
        'string',
        'max:255',
        // Ensure name is unique per grade_level, ignoring current section
        Rule::unique('sections')
          ->ignore($this->route('section'))
          ->where(function ($query) {
            // Use the incoming grade_level_id if provided, otherwise the existing one
            $gradeLevelId = $this->input('grade_level_id', $this->section->grade_level_id);
            return $query->where('grade_level_id', $gradeLevelId);
          }),
      ],
      'grade_level_id' => ['sometimes', 'exists:grade_levels,id'],
      'teacher_id' => ['sometimes', 'nullable', 'exists:teachers,id'],
    ];
  }

  public function messages(): array
  {
    return [
      'name.unique' => 'A section with this name already exists for the selected grade level.',
    ];
  }
}
