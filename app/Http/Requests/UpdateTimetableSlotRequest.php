<?php

namespace App\Http\Requests;

use App\Enums\DayOfWeekEnum;  // Assuming you create this Enum
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTimetableSlotRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'course_offering_id' => ['sometimes', 'exists:course_offerings,id'],
      'start_time' => ['sometimes', 'date_format:H:i:s'],
      'end_time' => ['sometimes', 'date_format:H:i:s', 'after:start_time'],
      'day' => ['sometimes', 'string', Rule::in(array_column(DayOfWeekEnum::cases(), 'value'))],
      'room_override' => ['sometimes', 'nullable', 'string', 'max:255'],
    ];
  }
}
