<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGradeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'student_id' => 'sometimes|exists:students,id',
            'exam_id' => 'sometimes|exists:exams,id',
            'marks_obtained' => 'sometimes|numeric|min:0',
            'comments' => 'nullable|string',
        ];
    }
}
