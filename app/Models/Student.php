<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
class Student extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'name',
    'phone',
    'email',
    'address',
    'photo',
    'dob',
    'gender',
    'grade_level_id',
    'department_id',
    'user_id',
    'blood_group',
    'nationality',
    'religion',
    'admission_date',
    
  ];

  protected $casts = [
    'dob' => 'date',
    'admission_date' => 'date',
  ];
  public function department()
    {
        return $this->belongsTo(Department::class);
    }

  public function gradeLevel()
  {
    return $this->belongsTo(GradeLevel::class);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function guardians()
  {
    return $this
      ->belongsToMany(Guardian::class, 'student_guardian')
      ->withPivot('relation_to_student')
      ->withTimestamps();
  }

  public function courseOfferings()
  {
    return $this
      ->belongsToMany(CourseOffering::class, 'student_course')
      ->withPivot('grade_final')
      ->withTimestamps();
  }

  public function bookIssues()
  {
    return $this->hasMany(BookIssue::class);
  }

  public function attendances()
  {
    return $this->hasMany(Attendance::class);
  }

  public function grades()
  {
    return $this->hasMany(Grade::class);
  }

  public function studentFees()
  {
    return $this->hasMany(StudentFee::class);
  }

  public function getAgeAttribute()
  {
    return $this->dob ? Carbon::parse($this->dob)->age : null;
  }
}
