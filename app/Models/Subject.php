<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'name',
    'code',
    'department_id',
    'description',
    'credit_hours',
  ];

  protected $casts = [
    'credit_hours' => 'integer',
  ];

  public function department()
  {
    return $this->belongsTo(Department::class);
  }

  public function courseOfferings()
  {
    return $this->hasMany(CourseOffering::class);
  }

  public function exams()
  {
    return $this->hasMany(Exam::class);
  }
}
