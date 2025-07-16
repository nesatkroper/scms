<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Grade extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'student_id',
    'exam_id',
    'marks_obtained',
    'comments',
  ];

  protected $casts = [
    'marks_obtained' => 'decimal:2',
  ];

  public function student()
  {
    return $this->belongsTo(Student::class);
  }

  public function exam()
  {
    return $this->belongsTo(Exam::class);
  }
}
