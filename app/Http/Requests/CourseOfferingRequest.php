<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\CourseOffering;


class CourseOfferingRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  // public function rules()
  // {
  //   return [
  //     'subject_id' => ['required', 'exists:subjects,id'],
  //     'teacher_id' => [
  //       'nullable',
  //       'exists:users,id',
  //       function ($attribute, $value, $fail) {
  //         if (!\App\Models\User::find($value)?->hasRole('teacher')) {
  //           $fail('Selected user is not a teacher.');
  //         }
  //       }
  //     ],
  //     'classroom_id' => ['nullable', 'exists:classrooms,id'],
  //     'time_slot' => ['required', 'string', 'in:morning,afternoon,evening'],
  //     'schedule' => ['required', 'string', 'in:mon-wed,mon-fri,wed-fri,sat-sun'],
  //     'start_time' => ['nullable', 'date_format:H:i'],
  //     'end_time' => ['nullable', 'date_format:H:i', 'after:start_time'],
  //     'join_start' => ['nullable', 'date'],
  //     'join_end' => ['nullable', 'date', 'after_or_equal:join_start'],
  //     'fee' => ['required', 'numeric', 'min:0'],
  //     'payment_type'   => ['required', 'in:course,monthly'],
  //     'is_final_only'  => ['boolean'],
  //   ];
  // }


  public function rules()
  {
    $courseId = $this->route('course_offering'); // null on create

    return [
      'subject_id' => ['required', 'exists:subjects,id'],

      'teacher_id' => [
        'nullable',
        'exists:users,id',

        // must be teacher
        function ($attribute, $value, $fail) {
          if ($value && !\App\Models\User::find($value)?->hasRole('teacher')) {
            $fail('Selected user is not a teacher.');
          }
        },

        // teacher schedule conflict
        Rule::unique('course_offerings')
          ->ignore($courseId)
          ->where(
            fn($q) => $q
              ->where('schedule', $this->schedule)
              ->where('time_slot', $this->time_slot)
              ->whereNull('deleted_at')
          ),
      ],

      'classroom_id' => [
        'nullable',
        'exists:classrooms,id',

        // classroom conflict
        Rule::unique('course_offerings')
          ->ignore($courseId)
          ->where(
            fn($q) => $q
              ->where('schedule', $this->schedule)
              ->where('time_slot', $this->time_slot)
              ->whereNull('deleted_at')
          ),
      ],

      'time_slot' => ['required', 'in:morning,afternoon,evening'],
      'schedule' => ['required', 'in:mon-wed,mon-fri,wed-fri,sat-sun'],

      'start_time' => ['nullable', 'date_format:H:i'],
      'end_time'   => ['nullable', 'date_format:H:i', 'after:start_time'],

      'join_start' => ['nullable', 'date'],
      'join_end'   => ['nullable', 'date', 'after_or_equal:join_start'],

      'fee' => ['required', 'numeric', 'min:0'],
      'payment_type' => ['required', 'in:course,monthly'],
      'is_final_only' => ['boolean'],
    ];
  }

  public function messages()
  {
    return [
      'teacher_id.unique'   => 'This teacher already has a course at that time.',
      'classroom_id.unique' => 'This classroom is already used at that time.',
      'end_time.after'      => 'End time must be after start time.',
    ];
  }


  protected function prepareForValidation()
  {
    $this->merge([
      'is_final_only' => $this->boolean('is_final_only'),
    ]);
  }
}
