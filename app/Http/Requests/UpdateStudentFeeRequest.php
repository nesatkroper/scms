<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentFeeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'student_id' => 'sometimes|exists:students,id',
            'fee_structure_id' => 'sometimes|exists:fee_structures,id',
            'amount' => 'sometimes|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'paid_amount' => 'nullable|numeric|min:0|lte:amount',
            'status' => 'sometimes|in:pending,partial,paid',
            'due_date' => 'sometimes|date',
            'remarks' => 'nullable|string',
        ];
    }
}
