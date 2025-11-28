<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StudentCourse extends Model
{

  protected $fillable = [
    'student_id',
    'course_offering_id',
    'grade_final',
    'status',
    'remarks',
  ];

  public function fee()
  {
    return $this->hasOne(Fee::class, 'student_course_id');
  }

  public function student()
  {
    return $this->belongsTo(User::class, 'student_id');
  }

  public function courseOffering()
  {
    return $this->belongsTo(CourseOffering::class, 'course_offering_id');
  }

  protected static function booted()
  {
    static::created(function (StudentCourse $enrollment) {

      DB::transaction(function () use ($enrollment) {
        $course = $enrollment->courseOffering()->first();

        if (! $course) {
          Log::warning("CourseOffering not found for StudentCourse ID {$enrollment->id}");
          return;
        }

        $feeType = FeeType::where('name', 'Course Fee')->first();

        if (! $feeType) {
          $feeType = FeeType::create([
            'name' => 'Course Fee',
            'description' => 'Automatically generated fee type for course enrollment'
          ]);
        }

        Fee::create([
          'student_id'        => $enrollment->student_id,
          'student_course_id' => $enrollment->id,
          'fee_type_id'       => $feeType->id,
          'created_by'        => Auth::id() ?? 1,
          'amount'            => $course->fee ?? 0,
          'description'       => "Enrollment fee for {$course->subject->name}",
        ]);
      });
    });
  }
}
