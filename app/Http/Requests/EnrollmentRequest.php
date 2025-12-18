<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\CourseOffering;


class EnrollmentRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  // public function rules(): array
  // {
  //   return [
  //     'student_id'        => 'required|exists:users,id',
  //     'course_offering_id' => 'required|exists:course_offerings,id',
  //     'status'            => 'required|string|in:studying,suspended,dropped,completed',
  //     'remarks'           => 'nullable|string|max:500',
  //   ];
  // }

  public function rules(): array
  {
    $enrollmentId = $this->route('enrollment'); // null on create

    return [
      'student_id' => [
        'required',
        'exists:users,id',

        // must be student (not teacher)
        function ($attr, $value, $fail) {
          $user = User::find($value);

          if (!$user || !$user->hasRole('student')) {
            $fail('Only students can enroll in a course.');
          }
        },

        // prevent duplicate enrollment
        Rule::unique('enrollments')
          ->ignore($enrollmentId)
          ->where(
            fn($q) => $q
              ->where('course_offering_id', $this->course_offering_id)
          ),
      ],

      'course_offering_id' => [
        'required',
        'exists:course_offerings,id',

        // teacher cannot enroll in their own course
        function ($attr, $value, $fail) {
          if (!$this->student_id) return;

          $course = CourseOffering::find($value);

          if ($course && $course->teacher_id == $this->student_id) {
            $fail('Teacher cannot enroll in their own course.');
          }
        },
      ],

      'status' => [
        'required',
        'in:studying,suspended,dropped,completed'
      ],

      'remarks' => ['nullable', 'string', 'max:500'],
    ];
  }


  public function messages(): array
  {
    return [
      'student_id.required'          => 'Student is required.',
      'student_id.exists'            => 'Selected student does not exist.',
      'course_offering_id.required'  => 'Course offering is required.',
      'course_offering_id.exists'    => 'Selected course offering does not exist.',
      'status.required'              => 'Status is required.',
      'status.in'                    => 'Invalid student status.',
      'remarks.max'                  => 'Remarks must not exceed 500 characters.',
      'student_id.unique' => 'This student is already enrolled in this course.',

    ];
  }
}
