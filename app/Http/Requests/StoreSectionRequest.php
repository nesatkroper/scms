<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSectionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'grade_level_id' => 'required|exists:grade_levels,id',
            'teacher_id' => 'nullable|exists:teachers,id',
            'capacity' => 'required|integer|min:1',
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'The section name is required.',
            'grade_level_id.required' => 'The grade level is required.',
            'teacher_id.exists' => 'The selected teacher does not exist.',
            'capacity.required' => 'The capacity is required.',
            'capacity.integer' => 'The capacity must be an integer.',
            'capacity.min' => 'The capacity must be at least 1.',
        ];
    }
}
