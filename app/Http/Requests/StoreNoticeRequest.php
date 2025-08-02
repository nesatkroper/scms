<?php

namespace App\Http\Requests;

use App\Enums\NoticeAudienceEnum;  // Assuming you create this Enum
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreNoticeRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;  // Or use Auth::user()->can('create', Notice::class);
  }

  public function rules(): array
  {
    return [
      'title' => ['required', 'string', 'max:255'],
      'content' => ['required', 'string'],
      'audience' => ['required', 'string', Rule::in(array_column(NoticeAudienceEnum::cases(), 'value'))],
      'start_date' => ['required', 'date'],
      'end_date' => ['required', 'date', 'after_or_equal:start_date'],
      'is_published' => ['boolean'],
      'created_by' => ['required', 'exists:users,id'],  // Ensure the user creating the notice exists
    ];
  }
}
