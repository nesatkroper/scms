<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTimetableEntryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'timetable_id' => 'required|exists:timetables,id',
            'class_subject_id' => 'required|exists:class_subjects,id',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'day' => 'required|in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',
            'room' => 'nullable|string|max:50',
        ];
    }
}
