<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBookRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'title' => ['sometimes', 'string', 'max:255'],
      'category_id' => ['sometimes', 'exists:book_categories,id'],
      'author' => ['sometimes', 'string', 'max:255'],
      'isbn' => [
        'sometimes',
        'string',
        'max:255',
        Rule::unique('books')->ignore($this->route('book')),
      ],
      'publication_year' => ['sometimes', 'integer', 'min:1000', 'max:' . (date('Y') + 5)],
      'publisher' => ['sometimes', 'string', 'max:255'],
      'quantity' => ['sometimes', 'integer', 'min:0'],
      'description' => ['sometimes', 'nullable', 'string'],
      'cover_image' => ['sometimes', 'nullable', 'string'],
    ];
  }
}
