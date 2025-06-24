<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'sometimes|string|max:255',
            'author' => 'sometimes|string|max:255',
            'isbn' => 'sometimes|string|unique:books,isbn,' . $this->book->id . '|max:13',
            'publication_year' => 'sometimes|integer|min:1800|max:' . date('Y'),
            'publisher' => 'sometimes|string|max:255',
            'quantity' => 'sometimes|integer|min:0',
            'description' => 'nullable|string',
            'category' => 'sometimes|string|max:100',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
}