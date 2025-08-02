<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBookCategoryRequest extends FormRequest
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
        Rule::unique('book_categories')->ignore($this->bookcategory),
      ],
      'description' => ['sometimes', 'nullable', 'string'],
    ];
  }
}
