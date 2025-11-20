<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ExamRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    return [
      'type' => [
        'required',
        'string',
        Rule::in(['lab', 'quiz', 'homework1', 'homework2', 'homework3', 'midterm', 'final']),
      ],
      'description' => ['nullable', 'string'],
      'course_offering_id' => [
        'required',
        'integer',
        Rule::exists('course_offerings', 'id'),
      ],
      'date' => ['required', 'date'],
      'total_marks' => ['required', 'integer', 'min:1'],
      'passing_marks' => ['required', 'integer', 'min:0', 'lte:total_marks'],
    ];
  }

  public function messages()
  {
    return [
      'type.in' => 'The selected exam type is invalid. Allowed types: lab, quiz, homework1, homework2, homework3, midterm, final.',
    ];
  }
}
