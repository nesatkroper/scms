<?php


// namespace App\Http\Requests;

// use Illuminate\Foundation\Http\FormRequest;

// class StoreStudentRequest extends FormRequest
// {
//     public function authorize()
//     {
//         return true;
//     }

//     public function rules()
//     {
//         return [
//             'user_id' => 'required|exists:users,id|unique:students,user_id',
//             'student_id' => 'required|string|unique:students,student_id',
//             'admission_date' => 'required|date',
//             'section_id' => 'required|exists:sections,id',
//         ];
//     }
// }


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'section_id' => 'required|exists:sections,id',
            'admission_date' => 'required|date',
            'name' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }
}
