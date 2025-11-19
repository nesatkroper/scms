<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Score extends Model
{
  use SoftDeletes;

  protected $fillable = [
    'student_id',
    'exam_id',
    'course_offering_id',
    'semester',
    'score',
    'grade',
    'remarks'
  ];

  public function student()
  {
    return $this->belongsTo(User::class, 'student_id');
  }

  public function exam()
  {
    return $this->belongsTo(Exam::class);
  }

  public function courseOffering()
  {
    return $this->belongsTo(CourseOffering::class, 'course_offering_id');
  }
}
