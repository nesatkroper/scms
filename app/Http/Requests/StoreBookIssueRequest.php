<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookIssueRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'book_id' => 'required|exists:books,id',
            'user_id' => 'required|exists:users,id',
            'issue_date' => 'required|date',
            'due_date' => 'required|date|after:issue_date',
            'return_date' => 'nullable|date|after_or_equal:issue_date',
            'fine' => 'required|numeric|min:0',
            'status' => 'required|in:issued,returned,overdue',
        ];
    }
}
