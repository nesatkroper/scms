<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGradeScaleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'name' => 'sometimes|string|max:255',
            'min_percentage' => 'sometimes|numeric|min:0|max:100',
            'max_percentage' => 'sometimes|numeric|min:0|max:100|gt:min_percentage',
            'gpa' => 'sometimes|numeric|min:0|max:4',
            'description' => 'nullable|string',
        ];
    }


    public function messages()
    {
        return [
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'min_percentage.numeric' => 'The minimum percentage must be a number.',
            'min_percentage.min' => 'The minimum percentage must be at least 0.',
            'min_percentage.max' => 'The minimum percentage may not be greater than 100.',
            'max_percentage.numeric' => 'The maximum percentage must be a number.',
            'max_percentage.min' => 'The maximum percentage must be at least 0.',
            'max_percentage.max' => 'The maximum percentage may not be greater than 100.',
            'max_percentage.gt' => 'The maximum percentage must be greater than the minimum percentage.',
            'gpa.numeric' => 'The GPA must be a number.',
            'gpa.min' => 'The GPA must be at least 0.',
            'gpa.max' => 'The GPA may not be greater than 4.',
            'description.string' => 'The description must be a string.',
        ];
    }
}
