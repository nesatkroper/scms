<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubjectRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'name' => ['required', 'string', 'max:255'],
      'code' => ['required', 'string', 'max:255', 'unique:subjects,code'],
      'department_id' => ['nullable', 'exists:departments,id'],
      'description' => ['nullable', 'string'],
      'credit_hours' => ['required', 'integer', 'min:1'],
    ];
  }
}
