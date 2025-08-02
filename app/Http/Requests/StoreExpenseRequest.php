<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExpenseRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'title' => ['required', 'string', 'max:255'],
      'description' => ['required', 'string'],
      'amount' => ['required', 'numeric', 'min:0'],
      'date' => ['required', 'date', 'before_or_equal:today'],
      'expense_category_id' => ['nullable', 'exists:expense_categories,id'],
      'approved_by' => ['nullable', 'exists:users,id'],
    ];
  }
}
