<?php

namespace App\Http\Requests;

use App\Enums\AttendanceStatusEnum;  // Assuming you create this Enum
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAttendanceRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'student_id' => ['required', 'exists:students,id'],
      'course_offering_id' => ['required', 'exists:course_offerings,id'],
      'date' => ['required', 'date'],
      'status' => ['required', 'string', Rule::in(array_column(AttendanceStatusEnum::cases(), 'value'))],
      'remarks' => ['nullable', 'string'],
    ];
  }

  public function messages(): array
  {
    return [
      'date.unique' => 'Attendance for this student and course on this date already exists.',
    ];
  }
}
