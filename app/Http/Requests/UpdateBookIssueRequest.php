<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookIssueRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'book_id' => 'sometimes|exists:books,id',
            'user_id' => 'sometimes|exists:users,id',
            'issue_date' => 'sometimes|date',
            'due_date' => 'sometimes|date|after:issue_date',
            'return_date' => 'nullable|date|after_or_equal:issue_date',
            'fine' => 'sometimes|numeric|min:0',
            'status' => 'sometimes|in:issued,returned,overdue',
        ];
    }
}
