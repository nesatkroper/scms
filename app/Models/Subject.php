<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = ['name', 'code', 'department_id', 'description', 'credit_hours'];

  protected $casts = [
    'credit_hours' => 'integer',
  ];

  public function department()
  {
    return $this->belongsTo(Department::class);
  }

  public function students()
  {
    return $this->belongsToMany(User::class, 'student_course')
      ->withPivot('grade_final')
      ->withTimestamps();
  }

  public function teachers()
  {
    return $this->belongsToMany(User::class, 'teacher_subject');
  }

  public function exams()
  {
    return $this->hasMany(Exam::class);
  }

  public function schedules()
  {
    return $this->hasMany(Schedule::class);
  }

  public function scores()
  {
    return $this->hasMany(Score::class);
  }
}
