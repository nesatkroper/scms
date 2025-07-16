<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateGuardianRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'name' => ['sometimes', 'string', 'max:255'],
      'phone' => ['sometimes', 'string', 'max:20'],
      'email' => [
        'sometimes',
        'string',
        'email',
        'max:255',
        Rule::unique('guardians')->ignore($this->route('guardian')),
      ],
      'address' => ['sometimes', 'string'],
      'occupation' => ['sometimes', 'nullable', 'string', 'max:255'],
      'company' => ['sometimes', 'nullable', 'string', 'max:255'],
      'relation' => ['sometimes', 'string', 'max:255'],
      'photo' => ['sometimes', 'nullable', 'string'],
      // For pivot table student_guardian (if updating relationships)
      'students' => ['nullable', 'array'],
      'students.*.student_id' => ['required_with:students', 'exists:students,id'],
      'students.*.relation_to_guardian' => ['nullable', 'string', 'max:255'],
    ];
  }
}
