<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateClassroomRequest extends FormRequest
{
  public function authorize(): bool
  {
    // Example: Only allow if the user has permission to update this classroom
    // return $this->user()->can('update', $this->classroom);
    return true;
  }

  public function rules(): array
  {
    return [
      'name' => ['sometimes', 'string', 'max:255'],
      'room_number' => [
        'sometimes',
        'string',
        'max:255',
        Rule::unique('classrooms')->ignore($this->route('classroom')),
      ],
      'capacity' => ['sometimes', 'integer', 'min:1'],
      'facilities' => ['sometimes', 'nullable', 'string'],
    ];
  }
}
