<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UpdateGradeLevelRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
       return [
            'name' => 'required|string|max:255',
            'code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('grade_levels', 'code')->ignore($this->gradelevel),
            ],
            'description' => 'nullable|string',
        ];

        
    }
}
