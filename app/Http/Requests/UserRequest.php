<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'name' => 'required|string|max:255',
      'email' => 'required|email|max:255|unique:users,email,' . $this->route('user'),
      'password' => $this->isMethod('post') ? 'required|string|min:6' : 'nullable|string|min:6',
      'phone' => 'nullable|string|max:20',
      'address' => 'nullable|string',
      'date_of_birth' => 'nullable|date',
      'gender' => 'nullable|in:male,female,other',
      'department_id' => 'nullable|exists:departments,id',
      'joining_date' => 'nullable|date',
      'qualification' => 'nullable|string|max:255',
      'experience' => 'nullable|string|max:255',
      'specialization' => 'nullable|string',
      'salary' => 'nullable|numeric|min:0',
      'cv' => 'nullable|file|mimes:pdf,doc,docx',
      'blood_group' => 'nullable|string|max:5',
      'nationality' => 'nullable|string|max:255',
      'religion' => 'nullable|string|max:255',
      'admission_date' => 'nullable|date',
      'occupation' => 'nullable|string|max:255',
      'company' => 'nullable|string|max:255',
      'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ];
  }
}
