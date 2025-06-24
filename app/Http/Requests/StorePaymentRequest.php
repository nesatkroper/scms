<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class StorePaymentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'student_fee_id' => 'required|exists:student_fees,id',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'payment_method' => 'required|string|max:100',
            'transaction_id' => 'nullable|string|max:100',
            'remarks' => 'nullable|string',
            'received_by' => 'required|exists:users,id',
        ];
    }
}
