<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class TeacherSubject extends Pivot
{
  protected $table = 'teacher_subject';

  protected $fillable = [
    'teacher_id',
    'subject_id',
    'time_slot',
  ];

  public function teacher()
  {
    return $this->belongsTo(User::class, 'teacher_id');
  }

  public function subject()
  {
    return $this->belongsTo(Subject::class, 'subject_id');
  }
}
