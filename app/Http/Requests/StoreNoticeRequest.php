<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNoticeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'audience' => 'required|in:all,teachers,students,parents,staff',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'is_published' => 'boolean',
            'created_by' => 'required|exists:users,id',
        ];
    }
}
