<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTeacherRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'user_id' => ['nullable', 'exists:users,id'],  // If connecting to an existing user
      'name' => ['required', 'string', 'max:255'],
      'gender' => ['required', 'in:male,female,other'],
      'dob' => ['required', 'date'],
      'department_id' => ['required', 'exists:departments,id'],
      'joining_date' => ['required', 'date'],
      'qualification' => ['required', 'string', 'max:255'],
      'experience' => ['required', 'integer', 'min:0'],  // Consider 'integer' if just years
      'phone' => ['required', 'string', 'max:20'],
      'email' => [
        'required',
        'email',
        'max:255',
        Rule::unique('teachers', 'email'),
        Rule::unique('users', 'email'),
      ],
      'address' => ['required', 'string'],
      'specialization' => ['nullable', 'string'],
      'salary' => ['nullable', 'numeric', 'min:0'],
      'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
      'cv' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
    ];
  }
}
