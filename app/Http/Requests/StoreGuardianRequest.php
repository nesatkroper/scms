<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGuardianRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id|unique:guardians,user_id',
            'occupation' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'relation' => 'required|string|max:50',
        ];
    }
}
