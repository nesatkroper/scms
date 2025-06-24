<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSettingRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'key' => 'required|string|unique:settings,key|max:255',
            'value' => 'nullable|string',
        ];
    }


    public function messages()
    {
        return [
            'key.required' => 'The setting key is required.',
            'key.string' => 'The setting key must be a string.',
            'key.unique' => 'The setting key must be unique.',
            'key.max' => 'The setting key may not be greater than 255 characters.',
            'value.string' => 'The setting value must be a string.',
        ];
    }
}
