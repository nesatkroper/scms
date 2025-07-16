<?php

namespace App\Http\Requests;

use App\Enums\EventTypeEnum;  // Assuming you create this Enum
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEventRequest extends FormRequest
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
      'date' => ['sometimes', 'date', 'after_or_equal:today'],
      'start_time' => ['sometimes', 'date_format:H:i:s'],
      'end_time' => ['sometimes', 'nullable', 'date_format:H:i:s', 'after:start_time'],
      'location' => ['sometimes', 'nullable', 'string', 'max:255'],
      'type' => ['sometimes', 'string', Rule::in(array_column(EventTypeEnum::cases(), 'value'))],
      'is_holiday' => ['sometimes', 'boolean'],
    ];
  }
}
