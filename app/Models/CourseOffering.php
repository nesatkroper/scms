<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseOffering extends Model
{
  use SoftDeletes;

  protected $fillable = [
    'subject_id',
    'teacher_id',
    'classroom_id',
    'time_slot',
    'schedule',
    'start_time',
    'end_time',
    'join_start',
    'join_end',
    'fee',
  ];


  protected $casts = [
    'join_start' => 'date',
    'join_end' => 'date',
    'start_time' => 'datetime',
    'end_time' => 'datetime',
  ];


  public function subject()
  {
    return $this->belongsTo(Subject::class);
  }

  public function teacher()
  {
    return $this->belongsTo(User::class, 'teacher_id');
  }

  public function classroom()
  {
    return $this->belongsTo(Classroom::class);
  }

  public function exams()
  {
    return $this->hasMany(Exam::class, 'course_offering_id');
  }

  public function students()
  {
    return $this->belongsToMany(User::class, 'student_course', 'course_offering_id', 'student_id')
      ->using(StudentCourse::class)
      ->as('enrollment')
      ->withPivot([
        'grade_final',
        'status',
        'remarks'
      ])
      ->withTimestamps();
  }
}
