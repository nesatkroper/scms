<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDepartmentRequest extends FormRequest
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
        Rule::unique('departments')->ignore($this->route('department')),
      ],
      'description' => ['sometimes', 'nullable', 'string'],
    ];
  }
}
