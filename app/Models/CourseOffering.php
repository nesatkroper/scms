<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseOffering extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'subject_id',
    'teacher_id',
    'classroom_id',
    'section_id',
    'semester',
    'academic_year',
  ];

  protected $casts = [
    'academic_year' => 'integer',
  ];

  public function subject()
  {
    return $this->belongsTo(Subject::class);
  }

  public function teacher()
  {
    return $this->belongsTo(Teacher::class);
  }

  public function classroom()
  {
    return $this->belongsTo(Classroom::class);
  }

  public function timetableSlots()
  {
    return $this->hasMany(TimetableSlot::class);
  }

  public function students()
  {
    return $this
      ->belongsToMany(Student::class, 'student_course')
      ->withPivot('grade_final')
      ->withTimestamps();
  }

  public function attendances()
  {
    return $this->hasMany(Attendance::class);
  }
}
