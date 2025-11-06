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
    $teacherId = $this->route('teacher')->id;

    return [
      'name' => ['required', 'string', 'max:255'],
      'email' => [
        'required',
        'email',
        'max:255',
        Rule::unique('users', 'email')->ignore($teacherId), // Only users table
      ],
      'password' => ['nullable', 'string', 'min:8'], // Optional for updates
      'gender' => ['required', 'in:male,female'],
      'date_of_birth' => ['required', 'date'],
      'department_id' => ['required', 'exists:departments,id'],
      'joining_date' => ['required', 'date'],
      'qualification' => ['required', 'string', 'max:255'],
      'experience' => ['nullable', 'string'],
      'phone' => ['required', 'string', 'max:20'],
      'address' => ['required', 'string'],
      'specialization' => ['nullable', 'string'],
      'salary' => ['nullable', 'numeric', 'min:0'],
      'blood_group' => ['nullable', 'string', 'max:10'],
      'nationality' => ['nullable', 'string', 'max:255'],
      'religion' => ['nullable', 'string', 'max:255'],
      'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
      'cv' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
    ];
  }

  public function messages(): array
  {
    return [
      'email.unique' => 'This email is already registered in the system.',
      'date_of_birth.required' => 'The date of birth field is required.',
      'password.min' => 'The password must be at least 8 characters.',
    ];
  }

  public function attributes(): array
  {
    return [
      'date_of_birth' => 'date of birth',
      'department_id' => 'department',
      'joining_date' => 'joining date',
      'blood_group' => 'blood group',
    ];
  }
}
