<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class Score extends Pivot
{
  use SoftDeletes;

  protected $table = 'scores';

  protected $fillable = [
    'student_id',
    'exam_id',
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
}
