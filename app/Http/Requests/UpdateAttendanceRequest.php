<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAttendanceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'student_id' => 'sometimes|exists:students,id',
            'class_subject_id' => 'sometimes|exists:class_subjects,id',
            'date' => 'sometimes|date',
            'status' => 'sometimes|in:present,absent,late,excused',
            'remarks' => 'nullable|string',
        ];
    }
}
