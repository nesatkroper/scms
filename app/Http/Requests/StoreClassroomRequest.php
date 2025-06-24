<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClassroomRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'room_number' => 'required|string|unique:classrooms,room_number|max:50',
            'capacity' => 'required|integer|min:1',
            'facilities' => 'nullable|string',
        ];
    }
}
