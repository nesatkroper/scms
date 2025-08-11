<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'teacher_id',
    'name',
    'gender',
    'dob',
    'department_id',
    'user_id',
    'joining_date',
    'qualification',
    'experience',
    'phone',
    'email',
    'address',
    'specialization',
    'salary',
    'photo',
    'cv',
  ];

  protected $casts = [
    'dob',
    'joining_date' => 'date',
    'salary' => 'decimal:2',
  ];

  public function department()
  {
    return $this->belongsTo(Department::class);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function courseOfferings()
  {
    return $this->hasMany(CourseOffering::class);
  }

  public function bookIssues()
  {
    return $this->hasMany(BookIssue::class);
  }
}
