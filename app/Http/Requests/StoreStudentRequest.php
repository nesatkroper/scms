<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'name' => ['required', 'string', 'max:255'],
      'phone' => ['required', 'string', 'max:20'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:students,email'],
      'address' => ['required', 'string'],
      'photo' => ['sometimes', 'nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
      'dob' => ['required', 'date', 'before_or_equal:today'],
      'gender' => ['required', 'in:male,female,other'],
      'grade_level_id' => ['nullable', 'exists:grade_levels,id'],
      'user_id' => ['nullable', 'exists:users,id'],
      'blood_group' => ['nullable', 'string', 'max:5'],
      'nationality' => ['nullable', 'string', 'max:255'],
      'religion' => ['nullable', 'string', 'max:255'],
      'admission_date' => ['required', 'date'],
      // For pivot table student_guardian (assuming array of guardian IDs and relations)
      // 'guardians' => ['nullable', 'array'],
      // 'guardians.*.guardian_id' => ['required_with:guardians', 'exists:guardians,id'],
      // 'guardians.*.relation_to_student' => ['nullable', 'string', 'max:255'],
      // // For pivot table student_course (if enrolling upon creation)
      // 'course_offerings' => ['nullable', 'array'],
      // 'course_offerings.*.course_offering_id' => ['required_with:course_offerings', 'exists:course_offerings,id'],
      // 'course_offerings.*.grade_final' => ['nullable', 'numeric', 'min:0', 'max:100'],
    ];
  }
}
