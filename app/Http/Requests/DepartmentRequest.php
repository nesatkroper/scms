<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'name' => 'required|string|max:255|unique:departments,name,' . $this->route('department'),
      'description' => 'nullable|string',
    ];
  }

  public function messages(): array
  {
    return [
      'name.required' => 'Department name is required.',
      'name.unique' => 'This department already exists.',
    ];
  }
}
