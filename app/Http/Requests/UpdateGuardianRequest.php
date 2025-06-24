<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGuardianRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'user_id' => 'sometimes|exists:users,id|unique:guardians,user_id,' . $this->guardian->id,
            'occupation' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'relation' => 'sometimes|string|max:50',
        ];
    }
}
