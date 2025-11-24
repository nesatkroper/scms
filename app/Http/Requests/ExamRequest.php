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
        Rule::in([
          'midterm',
          'final',
          'speaking',
          'listening',
          'reading',
          'lab1',
          'lab2',
          'lab3',
          'quiz1',
          'quiz2',
          'quiz3',
          'homework1',
          'homework2',
          'homework3',
        ]),
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
      'type.in' => 'Invalid exam type. Allowed types: midterm, final, speaking, listening, reading, lab1, lab2, lab3, quiz1, quiz2, quiz3, homework1, homework2, homework3.',
    ];
  }
}
