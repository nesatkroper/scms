<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTeacherRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'user_id' => ['sometimes', 'nullable', 'exists:users,id'],
      'teacher_id' => [
        'sometimes',
        'string',
        'max:255',
        Rule::unique('teachers')->ignore($this->route('teacher')),
      ],
      'department_id' => ['sometimes', 'nullable', 'exists:departments,id'],
      'joining_date' => ['sometimes', 'date'],
      'qualification' => ['sometimes', 'string', 'max:255'],
      'experience' => ['sometimes', 'string', 'max:255'],
      'phone' => ['sometimes', 'string', 'max:20'],
      'email' => [
        'sometimes',
        'string',
        'email',
        'max:255',
        Rule::unique('teachers')->ignore($this->route('teacher')),
      ],
      'address' => ['sometimes', 'string'],
      'specialization' => ['sometimes', 'nullable', 'string'],
      'salary' => ['sometimes', 'nullable', 'numeric', 'min:0'],
      'photo' => ['sometimes', 'nullable', 'string'],
      'cv' => ['sometimes', 'nullable', 'string'],
    ];
  }
}
