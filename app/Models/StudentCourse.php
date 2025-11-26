<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class StudentCourse extends Pivot
{
  public $timestamps = true;
  protected $table = 'student_course';

  protected $fillable = [
    'student_id',
    'course_offering_id',
    'grade_final',
    'status',
    'payment_status',
    'remarks',
  ];



  public function student()
  {
    return $this->belongsTo(User::class, 'student_id');
  }

  public function courseOffering()
  {
    return $this->belongsTo(CourseOffering::class, 'course_offering_id');
  }
}
