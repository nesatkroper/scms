<?php

namespace App\Http\Requests;

use App\Enums\AttendanceStatusEnum;  // Assuming you create this Enum
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAttendanceRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'student_id' => ['sometimes', 'exists:students,id'],
      'course_offering_id' => ['sometimes', 'exists:course_offerings,id'],
      'date' => [
        'sometimes',
        'date',
        // Unique attendance per student per course per date, ignoring current record
        Rule::unique('attendances')
          ->ignore($this->route('attendance'))
          ->where(function ($query) {
            $studentId = $this->input('student_id', $this->attendance->student_id);
            $courseOfferingId = $this->input('course_offering_id', $this->attendance->course_offering_id);
            $date = $this->input('date', $this->attendance->date->format('Y-m-d'));  // Convert to string for query
            return $query
              ->where('student_id', $studentId)
              ->where('course_offering_id', $courseOfferingId)
              ->whereDate('date', $date);
          }),
      ],
      'status' => ['sometimes', 'string', Rule::in(array_column(AttendanceStatusEnum::cases(), 'value'))],
      'remarks' => ['sometimes', 'nullable', 'string'],
    ];
  }

  public function messages(): array
  {
    return [
      'date.unique' => 'Attendance for this student and course on this date already exists.',
    ];
  }
}
