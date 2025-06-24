<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFeeStructureRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'name' => 'sometimes|string|max:255',
            'grade_level_id' => 'sometimes|exists:grade_levels,id',
            'amount' => 'sometimes|numeric|min:0',
            'frequency' => 'sometimes|in:monthly,quarterly,semester,annual',
            'effective_from' => 'sometimes|date',
            'effective_to' => 'nullable|date|after:effective_from',
            'description' => 'nullable|string',
        ];
    }
}
