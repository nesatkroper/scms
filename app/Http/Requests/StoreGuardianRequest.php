<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
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
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
      'address' => ['required', 'string'],
      'occupation' => ['nullable', 'string', 'max:255'],
      'company' => ['nullable', 'string', 'max:255'],
      'religion' => ['required', 'string', 'max:255'],
      'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ];

    
  }
}


