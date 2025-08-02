<?php

namespace App\Http\Requests;

use App\Enums\EventTypeEnum;  // Assuming you create this Enum
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEventRequest extends FormRequest
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
      'date' => ['required', 'date', 'after_or_equal:today'],
      'start_time' => ['required', 'date_format:H:i:s'],
      'end_time' => ['nullable', 'date_format:H:i:s', 'after:start_time'],
      'location' => ['nullable', 'string', 'max:255'],
      'type' => ['required', 'string', Rule::in(array_column(EventTypeEnum::cases(), 'value'))],
      'is_holiday' => ['boolean'],
    ];
  }
}
