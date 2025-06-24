<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'sometimes|exists:users,id|unique:students,user_id,' . $this->student->id,
            'student_id' => 'sometimes|string|unique:students,student_id,' . $this->student->id,
            'admission_date' => 'sometimes|date',
            'section_id' => 'sometimes|exists:sections,id',
        ];
    }
}
