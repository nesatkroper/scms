<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseOfferingRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    return [
      'subject_id' => ['required', 'exists:subjects,id'],
      'teacher_id' => ['required', 'exists:users,id'],
      'classroom_id' => ['required', 'exists:classrooms,id'],

      'time_slot' => ['required', 'string', 'max:255'],
      'start_time' => ['required', 'date_format:H:i'],
      'end_time' => ['required', 'date_format:H:i', 'after:start_time'],

      'join_start' => ['nullable', 'date'],
      'join_end' => ['nullable', 'date', 'after_or_equal:join_start'],

      'fee' => ['required', 'numeric', 'min:0'],
      'capacity' => ['required', 'integer', 'min:1'],
    ];
  }
}
