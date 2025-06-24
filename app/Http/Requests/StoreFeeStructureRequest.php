<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFeeStructureRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'grade_level_id' => 'required|exists:grade_levels,id',
            'amount' => 'required|numeric|min:0',
            'frequency' => 'required|in:monthly,quarterly,semester,annual',
            'effective_from' => 'required|date',
            'effective_to' => 'nullable|date|after:effective_from',
            'description' => 'nullable|string',
        ];
    }
}
