<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClassroomRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'name' => ['required', 'string', 'max:255'],
      'room_number' => ['required', 'string', 'max:255', 'unique:classrooms,room_number'],
      'capacity' => ['required', 'integer', 'min:1'],
      'facilities' => ['nullable', 'string'],
    ];
  }
}
