<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeacherRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id|unique:teachers,user_id',
            'teacher_id' => 'required|string|unique:teachers,teacher_id|max:50',
            'department_id' => 'nullable|exists:departments,id',
            'joining_date' => 'required|date',
            'qualification' => 'required|string|max:255',
            'specialization' => 'nullable|string',
            'salary' => 'nullable|numeric|min:0',
        ];
    }
}
