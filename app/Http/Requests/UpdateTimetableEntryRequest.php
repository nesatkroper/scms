<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTimetableEntryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'timetable_id' => 'sometimes|exists:timetables,id',
            'class_subject_id' => 'sometimes|exists:class_subjects,id',
            'start_time' => 'sometimes|date_format:H:i',
            'end_time' => 'sometimes|date_format:H:i|after:start_time',
            'day' => 'sometimes|in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',
            'room' => 'nullable|string|max:50',
        ];
    }
}
