<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Score extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'student_id',
    'exam_id',
    'subject_id',
    'grade_id',
    'semester',
    'score',
    'grade',
    'remarks',
  ];

  public function student()
  {
    return $this->belongsTo(Student::class);
  }

  public function exam()
  {
    return $this->belongsTo(Exam::class);
  }

  public function subject()
  {
    return $this->belongsTo(Subject::class);
  }

  public function gradeLevel()
  {
    return $this->belongsTo(GradeLevel::class, 'grade_id');
  }
}
