<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreStudentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id|unique:students,user_id',
            'student_id' => 'required|string|max:50|unique:students,student_id',
            'admission_date' => 'required|date',
            'section_id' => 'required|exists:sections,id',
        ];
    }
}