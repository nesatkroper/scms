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
      'name' => ['required', 'string', 'max:255'],
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
}
