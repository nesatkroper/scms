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
      'department_id' => ['nullable', 'exists:departments,id'],
      'joining_date' => ['required', 'date'],
      'qualification' => ['required', 'string', 'max:255'],
      'experience' => ['required', 'string', 'max:255'],  // Consider 'integer' if just years
      'phone' => ['required', 'string', 'max:20'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:teachers,email'],
      'address' => ['required', 'string'],
      'specialization' => ['nullable', 'string'],
      'salary' => ['nullable', 'numeric', 'min:0'],
      'photo' => ['nullable', 'string'],  // Assuming URL or path to image
      'cv' => ['nullable', 'string'],  // Assuming URL or path to CV document
    ];
  }
}
