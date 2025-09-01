<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'name' => ['sometimes', 'string', 'max:255'],
      'phone' => ['sometimes', 'string', 'max:20'],
      'email' => [
        'sometimes',
        'string',
        'email',
        'max:255',
        Rule::unique('students')->ignore($this->route('student')),
      ],
      'address' => ['sometimes', 'string'],
      'photo' => ['sometimes', 'nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
      'dob' => ['sometimes', 'nullable', 'date', 'before_or_equal:today'],
     'gender'  => 'required|in:male,female,other',
      'grade_level_id' => ['sometimes', 'nullable', 'exists:grade_levels,id'],
      'user_id' => ['sometimes', 'nullable', 'exists:users,id'],
      'blood_group' => ['sometimes', 'nullable', 'string', 'max:5'],
      'nationality' => ['sometimes', 'nullable', 'string', 'max:255'],
      'religion' => ['sometimes', 'nullable', 'string', 'max:255'],
      'admission_date' => ['sometimes', 'date'],
      // For pivot table student_guardian (if updating relationships)
      'guardians' => ['nullable', 'array'],
      'guardians.*.guardian_id' => ['required_with:guardians', 'exists:guardians,id'],
      'guardians.*.relation_to_student' => ['nullable', 'string', 'max:255'],
      // For pivot table student_course (if updating enrollments/grades)
      'course_offerings' => ['nullable', 'array'],
      'course_offerings.*.course_offering_id' => ['required_with:course_offerings', 'exists:course_offerings,id'],
      'course_offerings.*.grade_final' => ['nullable', 'numeric', 'min:0', 'max:100'],
    ];
  }
}
