<?php

namespace App\Http\Requests;

use App\Enums\FeeFrequencyEnum;  // Assuming you create this Enum
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFeeStructureRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'name' => ['sometimes', 'string', 'max:255'],
      'grade_level_id' => ['sometimes', 'exists:grade_levels,id'],
      'amount' => ['sometimes', 'numeric', 'min:0'],
      'frequency' => ['sometimes', 'string', Rule::in(array_column(FeeFrequencyEnum::cases(), 'value'))],
      'effective_from' => ['sometimes', 'date'],
      'effective_to' => ['sometimes', 'nullable', 'date', 'after_or_equal:effective_from'],
      'description' => ['sometimes', 'nullable', 'string'],
    ];
  }
}
