<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateExpenseCategoryRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'name' => [
        'sometimes',
        'string',
        'max:255',
        Rule::unique('expense_categories')->ignore($this->route('expense_category')),
      ],
      'description' => ['sometimes', 'nullable', 'string'],
    ];
  }
}
