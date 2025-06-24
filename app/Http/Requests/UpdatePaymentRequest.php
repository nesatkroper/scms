<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePaymentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'student_fee_id' => 'sometimes|exists:student_fees,id',
            'amount' => 'sometimes|numeric|min:0',
            'payment_date' => 'sometimes|date',
            'payment_method' => 'sometimes|string|max:100',
            'transaction_id' => 'nullable|string|max:100',
            'remarks' => 'nullable|string',
            'received_by' => 'sometimes|exists:users,id',
        ];
    }
}
