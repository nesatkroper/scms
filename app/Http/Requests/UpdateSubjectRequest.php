<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSubjectRequest extends FormRequest
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
        Rule::unique('subjects')->ignore($this->route('subject')),
      ],
      'department_id' => ['sometimes', 'nullable', 'exists:departments,id'],
      'description' => ['sometimes', 'nullable', 'string'],
      'credit_hours' => ['sometimes', 'integer', 'min:1'],
    ];
  }
}
