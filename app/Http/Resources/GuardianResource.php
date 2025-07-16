<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GuardianResource extends JsonResource
{
  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'name' => $this->name,
      'phone' => $this->phone,
      'email' => $this->email,
      'address' => $this->address,
      'occupation' => $this->occupation,
      'company' => $this->company,
      'relation' => $this->relation,
      'photo' => $this->photo,
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
      'deleted_at' => $this->deleted_at,
      'students' => $this->whenLoaded('students', function () {
        return $this->students->map(function ($student) {
          return [
            'id' => $student->id,
            'name' => $student->name,
            'relation_to_student' => $student->pivot->relation_to_student,
          ];
        });
      }),
    ];
  }
}
