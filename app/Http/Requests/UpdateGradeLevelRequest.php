<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateGradeLevelRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'name' => ['sometimes', 'string', 'max:255'],
      'code' => [
        'sometimes',
        'string',
        'max:255',
        Rule::unique('grade_levels')->ignore($this->route('grade_level')),
      ],
      'description' => ['sometimes', 'nullable', 'string'],
    ];
  }
}
