<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExpenseRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'title' => ['sometimes', 'string', 'max:255'],
      'description' => ['sometimes', 'string'],
      'amount' => ['sometimes', 'numeric', 'min:0'],
      'date' => ['sometimes', 'date', 'before_or_equal:today'],
      'expense_category_id' => ['sometimes', 'nullable', 'exists:expense_categories,id'],
      'approved_by' => ['sometimes', 'nullable', 'exists:users,id'],
    ];
  }
}
