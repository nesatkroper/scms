<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentGuardianRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'student_id' => 'required|exists:students,id',
            'guardian_id' => 'required|exists:guardians,id',
        ];
    }
}
