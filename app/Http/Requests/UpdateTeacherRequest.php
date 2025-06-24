<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTeacherRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'user_id' => 'sometimes|exists:users,id|unique:teachers,user_id,' . $this->teacher->id,
            'teacher_id' => 'sometimes|string|unique:teachers,teacher_id,' . $this->teacher->id . '|max:50',
            'department_id' => 'nullable|exists:departments,id',
            'joining_date' => 'sometimes|date',
            'qualification' => 'sometimes|string|max:255',
            'specialization' => 'nullable|string',
            'salary' => 'nullable|numeric|min:0',
        ];
    }
}
