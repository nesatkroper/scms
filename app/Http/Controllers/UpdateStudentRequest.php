<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $studentId = $this->route('student')->id;
        
        return [
            'user_id' => 'required|exists:users,id|unique:students,user_id,'.$studentId,
            'student_id' => [
                'required',
                'string',
                'max:50',
                Rule::unique('students', 'student_id')->ignore($studentId),
            ],
            'admission_date' => 'required|date',
            'section_id' => 'required|exists:sections,id',
        ];
    }
}