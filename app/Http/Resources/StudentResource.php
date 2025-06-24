<?php


namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'student_id' => $this->student_id,
            'admission_date' => $this->admission_date,
            'section' => new SectionResource($this->whenLoaded('section')),
            'user' => new UserResource($this->whenLoaded('user')),
            'guardians' => GuardianResource::collection($this->whenLoaded('guardians')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
