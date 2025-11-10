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
    $guardianId = $this->route('guardian');
    return [
      'name' => ['required', 'string', 'max:255'],
      'gender' => ['nullable', Rule::in(['male', 'female', 'other'])],
      'phone' => ['required', 'string', 'max:20'],
      'email' => [
        'required',
        'string',
        'email',
        'max:255',
        Rule::unique('users')->ignore($guardianId), // Changed 'guardians' to 'users'
      ],
      'address' => ['required', 'string'],
      'occupation' => ['sometimes', 'nullable', 'string', 'max:255'],
      'company' => ['sometimes', 'nullable', 'string', 'max:255'],
      'religion' => ['sometimes', 'string', 'max:255'],
      'avatar' => ['sometimes', 'nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
    ];
  }
  public function messages(): array
  {
    return [
      'email.unique' => 'This email is already taken by another user.',
      'avatar.image' => 'The avatar must be a valid image file.',
      'avatar.mimes' => 'The avatar must be a file of type: jpeg, png, jpg, gif, svg.',
      'avatar.max' => 'The avatar may not be greater than 2MB.',
    ];
  }
}
