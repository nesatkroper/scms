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
      'teacher_id' => ['nullable', 'exists:users,id'],
      'classroom_id' => ['nullable', 'exists:classrooms,id'],
      'time_slot' => ['required', 'string', 'in:morning,afternoon,evening'],
      'schedule' => ['required', 'string', 'in:mon-wed,mon-fri,wed-fri,sat-sun'],
      'start_time' => ['required', 'date_format:H:i'],
      'end_time' => ['required', 'date_format:H:i', 'after:start_time'],
      'join_start' => ['nullable', 'date'],
      'join_end' => ['nullable', 'date', 'after_or_equal:join_start'],
      'fee' => ['required', 'numeric', 'min:0'],

    ];
  }
}
