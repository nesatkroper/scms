<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
  use SoftDeletes;

  protected $fillable = [
    'student_id',
    'classroom_id',
    'subject_id',
    'date',
    'status',
    'remarks'
  ];

  public function student()
  {
    return $this->belongsTo(User::class, 'student_id');
  }

  public function classroom()
  {
    return $this->belongsTo(Classroom::class);
  }

  public function subject()
  {
    return $this->belongsTo(Subject::class);
  }
}
