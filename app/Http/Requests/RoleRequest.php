<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    // get ID from the route model binding
    $roleId = $this->route('role')?->id;

    return [
      'name' => 'required|string|max:255|unique:roles,name,' . $roleId,
      'guard_name' => 'nullable|string',
      'permissions' => 'nullable|array',
      'permissions.*' => 'exists:permissions,id',
    ];
  }
}
