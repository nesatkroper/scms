<?php

namespace App\Http\Requests;

use App\Enums\BookIssueStatusEnum;  // Assuming you create this Enum
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBookIssueRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'book_id' => ['required', 'exists:books,id'],
      'student_id' => [
        'nullable',
        'exists:students,id',
        // Require one of student_id or teacher_id
        Rule::requiredIf(empty($this->teacher_id)),
      ],
      'teacher_id' => [
        'nullable',
        'exists:teachers,id',
        // Require one of student_id or teacher_id
        Rule::requiredIf(empty($this->student_id)),
      ],
      'issue_date' => ['required', 'date'],
      'due_date' => ['required', 'date', 'after_or_equal:issue_date'],
      'return_date' => ['nullable', 'date', 'after_or_equal:issue_date', 'before_or_equal:today'],
      'fine' => ['nullable', 'numeric', 'min:0'],
      'status' => ['required', 'string', Rule::in(array_column(BookIssueStatusEnum::cases(), 'value'))],
    ];
  }

  public function messages(): array
  {
    return [
      'student_id.required_if' => 'Either a student or a teacher must be provided for the book issue.',
      'teacher_id.required_if' => 'Either a student or a teacher must be provided for the book issue.',
    ];
  }
}
