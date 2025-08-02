<?php

namespace App\Http\Requests;

use App\Enums\BookIssueStatusEnum;  // Assuming you create this Enum
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBookIssueRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'book_id' => ['sometimes', 'exists:books,id'],
      'student_id' => [
        'sometimes',
        'nullable',
        'exists:students,id',
        // Only require if the other ID is not present
        Rule::requiredIf(empty($this->teacher_id) && empty($this->student_id)),  // Re-evaluates based on payload + existing
      ],
      'teacher_id' => [
        'sometimes',
        'nullable',
        'exists:teachers,id',
        // Only require if the other ID is not present
        Rule::requiredIf(empty($this->student_id) && empty($this->teacher_id)),  // Re-evaluates based on payload + existing
      ],
      'issue_date' => ['sometimes', 'date'],
      'due_date' => ['sometimes', 'date', 'after_or_equal:issue_date'],
      'return_date' => ['sometimes', 'nullable', 'date', 'after_or_equal:issue_date', 'before_or_equal:today'],
      'fine' => ['sometimes', 'nullable', 'numeric', 'min:0'],
      'status' => ['sometimes', 'string', Rule::in(array_column(BookIssueStatusEnum::cases(), 'value'))],
    ];
  }

  public function messages(): array
  {
    return [
      'student_id.required_if' => 'Either a student or a teacher must be associated with the book issue.',
      'teacher_id.required_if' => 'Either a student or a teacher must be associated with the book issue.',
    ];
  }
}
