<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'name',
    'grade_level_id',
    'teacher_id',
  ];

  public function gradeLevel()
  {
    return $this->belongsTo(GradeLevel::class);
  }

  public function teacher()
  {
    return $this->belongsTo(Teacher::class);
  }

  public function courseOfferings()
  {
    return $this->hasMany(CourseOffering::class);
  }

  public function timetables()
  {
    return $this->hasMany(Timetable::class);
  }
}
