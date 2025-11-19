<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = ['name', 'code',  'description', 'credit_hours'];

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

  // public function teachers()
  // {
  //   return $this->belongsToMany(User::class, 'teacher_subject');
  // }

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

  public function teachers()
  {
    return $this->belongsToMany(User::class, 'teacher_subject', 'subject_id', 'teacher_id')
      ->using(TeacherSubject::class)
      ->withPivot('time_slot')
      ->withTimestamps();
  }

  public function teacherAssignments()
  {
    return $this->hasMany(TeacherSubject::class, 'subject_id');
  }
}
