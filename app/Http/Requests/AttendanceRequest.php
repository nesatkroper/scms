<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttendanceRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'student_id' => 'required|exists:users,id',
      'classroom_id' => 'nullable|exists:classrooms,id',
      'subject_id' => 'nullable|exists:subjects,id',
      'date' => 'required|date',
      'status' => 'required|in:present,absent,late,excused',
      'remarks' => 'nullable|string',
    ];
  }

  public function messages(): array
  {
    return [
      'student_id.required' => 'Student is required.',
      'student_id.exists' => 'Selected student does not exist.',
      'date.required' => 'Date is required.',
      'status.required' => 'Attendance status is required.',
      'status.in' => 'Status must be present, absent, late, or excused.',
    ];
  }
}
