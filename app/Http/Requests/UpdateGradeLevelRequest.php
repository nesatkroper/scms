<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGradeLevelRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'name' => 'sometimes|string|max:255',
            'code' => 'sometimes|string|unique:grade_levels,code,' . $this->grade_level->id . '|max:50',
            'description' => 'nullable|string',
        ];
    }
}
