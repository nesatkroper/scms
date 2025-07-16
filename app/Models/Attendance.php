<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'student_id',
    'course_offering_id',
    'date',
    'status',
    'remarks',
  ];

  protected $casts = [
    'date' => 'date',
    'status' => \App\Enums\AttendanceStatusEnum::class,
  ];

  public function student()
  {
    return $this->belongsTo(Student::class);
  }

  public function courseOffering()
  {
    return $this->belongsTo(CourseOffering::class);
  }
}
