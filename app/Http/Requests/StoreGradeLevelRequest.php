<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGradeLevelRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'name' => ['required', 'string', 'max:255'],
      'code' => ['required', 'string', 'max:255', 'unique:grade_levels,code'],
      'description' => ['nullable', 'string'],
    ];
  }
}
