<?php


namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentGuardianResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'student_id' => $this->student_id,
            'guardian_id' => $this->guardian_id,
        ];
    }
}