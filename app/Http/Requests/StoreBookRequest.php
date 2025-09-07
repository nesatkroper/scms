<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'title' => ['required', 'string', 'max:255'],
      'category_id' => ['required', 'exists:book_categories,id'],
      'author' => ['required', 'string', 'max:255'],
      'isbn' => ['required', 'string', 'max:255', 'unique:books,isbn'],
      'publication_year' => ['required', 'integer', 'min:1000', 'max:' . (date('Y') + 5)],
      'publisher' => ['required', 'string', 'max:255'],
      'quantity' => ['required', 'integer', 'min:0'],
      'description' => ['nullable', 'string'],
      'cover_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
    ];
  }
}
