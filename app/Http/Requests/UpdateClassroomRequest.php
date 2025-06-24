<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClassroomRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'name' => 'sometimes|string|max:255',
            'room_number' => 'sometimes|string|unique:classrooms,room_number,' . $this->classroom->id . '|max:50',
            'capacity' => 'sometimes|integer|min:1',
            'facilities' => 'nullable|string',
        ];
    }
}
