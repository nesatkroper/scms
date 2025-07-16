<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'name' => $this->name,
      'phone' => $this->phone,
      'email' => $this->email,
      'address' => $this->address,
      'photo' => $this->photo,
      'dob' => $this->whenNotNull($this->dob ? $this->dob->format('Y-m-d') : null),
      'gender' => $this->gender,
      'grade_level_id' => $this->grade_level_id,
      'grade_level' => new GradeLevelResource($this->whenLoaded('gradeLevel')),
      'user_id' => $this->user_id,
      'user' => new UserResource($this->whenLoaded('user')),
      'blood_group' => $this->blood_group,
      'nationality' => $this->nationality,
      'religion' => $this->religion,
      'admission_date' => $this->admission_date->format('Y-m-d'),
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
      'deleted_at' => $this->deleted_at,
      'guardians' => $this->whenLoaded('guardians', function () {
        return $this->guardians->map(function ($guardian) {
          return [
            'id' => $guardian->id,
            'name' => $guardian->name,
            'relation_to_student' => $guardian->pivot->relation_to_student,
          ];
        });
      }),
      'course_offerings' => $this->whenLoaded('courseOfferings', function () {
        return $this->courseOfferings->map(function ($course) {
          return [
            'id' => $course->id,
            'subject_name' => $course->subject->name,
            'grade_final' => $course->pivot->grade_final,
          ];
        });
      }),
      'book_issues' => BookIssueResource::collection($this->whenLoaded('bookIssues')),
      'attendances' => AttendanceResource::collection($this->whenLoaded('attendances')),
      'grades' => GradeResource::collection($this->whenLoaded('grades')),
      'student_fees' => StudentFeeResource::collection($this->whenLoaded('studentFees')),
    ];
  }
}
