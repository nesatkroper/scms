<?php

namespace App\Http\Requests;

use App\Enums\NoticeAudienceEnum;  // Assuming you create this Enum
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateNoticeRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'title' => ['sometimes', 'string', 'max:255'],
      'content' => ['sometimes', 'string'],
      'audience' => ['sometimes', 'string', Rule::in(array_column(NoticeAudienceEnum::cases(), 'value'))],
      'start_date' => ['sometimes', 'date'],
      'end_date' => ['sometimes', 'date', 'after_or_equal:start_date'],
      'is_published' => ['sometimes', 'boolean'],
      'created_by' => ['sometimes', 'exists:users,id'],
    ];
  }
}
