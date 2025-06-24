<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSectionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'name' => 'sometimes|string|max:255',
            'grade_level_id' => 'sometimes|exists:grade_levels,id',
            'teacher_id' => 'nullable|exists:teachers,id',
            'capacity' => 'sometimes|integer|min:1',
        ];
    }
}
