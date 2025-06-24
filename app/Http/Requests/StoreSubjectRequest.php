<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubjectRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:subjects,code|max:50',
            'department_id' => 'nullable|exists:departments,id',
            'description' => 'nullable|string',
            'credit_hours' => 'required|integer|min:1',
        ];
    }
}
