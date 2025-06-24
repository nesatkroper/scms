<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubjectRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'name' => 'sometimes|string|max:255',
            'code' => 'sometimes|string|unique:subjects,code,' . $this->subject->id . '|max:50',
            'department_id' => 'nullable|exists:departments,id',
            'description' => 'nullable|string',
            'credit_hours' => 'sometimes|integer|min:1',
        ];
    }


    public function messages()
    {
        return [
            'name.string' => 'The subject name must be a string.',
            'code.unique' => 'The subject code must be unique.',
            'department_id.exists' => 'The selected department does not exist.',
            'credit_hours.integer' => 'Credit hours must be an integer.',
            'credit_hours.min' => 'Credit hours must be at least 1.',
        ];
    }
}
