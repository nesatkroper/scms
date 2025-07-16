<?php

namespace App\Http\Requests;

use App\Enums\FeeFrequencyEnum;  // Assuming you create this Enum
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreFeeStructureRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'name' => ['required', 'string', 'max:255'],
      'grade_level_id' => ['required', 'exists:grade_levels,id'],
      'amount' => ['required', 'numeric', 'min:0'],
      'frequency' => ['required', 'string', Rule::in(array_column(FeeFrequencyEnum::cases(), 'value'))],
      'effective_from' => ['required', 'date'],
      'effective_to' => ['nullable', 'date', 'after_or_equal:effective_from'],
      'description' => ['nullable', 'string'],
    ];
  }
}
