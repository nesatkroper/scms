<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGuardianRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'name' => ['required', 'string', 'max:255'],
      'phone' => ['required', 'string', 'max:20'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:guardians,email'],
      'address' => ['required', 'string'],
      'occupation' => ['nullable', 'string', 'max:255'],
      'company' => ['nullable', 'string', 'max:255'],
      'relation' => ['required', 'string', 'max:255'],  // e.g., 'Father', 'Mother', 'Uncle'
      // 'photo' => ['nullable', 'string'],  // Assuming URL or path to image
      'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ];
  }
}
