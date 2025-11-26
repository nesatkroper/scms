<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
  use HasFactory, Notifiable, HasApiTokens;
  use HasRoles, SoftDeletes;

  protected $fillable = [
    'name',
    'email',
    'password',
    'phone',
    'address',
    'date_of_birth',
    'gender',
    'joining_date',
    'qualification',
    'experience',
    'specialization',
    'salary',
    'cv',
    'blood_group',
    'nationality',
    'religion',
    'admission_date',
    'occupation',
    'company',
    'avatar'
  ];


  protected $hidden = [
    'password',
    'remember_token',
  ];

  protected function casts(): array
  {
    return [
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
      'date_of_birth' => 'date',
      'joining_date' => 'date',
      'admission_date' => 'date',
    ];
  }



  public function fees()
  {
    return $this->hasMany(Fee::class, 'student_id');
  }

  public function payments()
  {
    return $this->hasMany(Payment::class, 'student_id');
  }

  public function attendances()
  {
    return $this->hasMany(Attendance::class, 'student_id');
  }

  public function scores()
  {
    return $this->hasMany(Score::class, 'student_id');
  }

  public function approvedExpenses()
  {
    return $this->hasMany(Expense::class, 'approved_by');
  }

  public function receivedPayments()
  {
    return $this->hasMany(Payment::class, 'received_by');
  }


  public function teachingCourses()
  {
    return $this->hasMany(CourseOffering::class, 'teacher_id');
  }

  public function taughtStudents() {}


  public function courseOfferings()
  {
    return $this->belongsToMany(CourseOffering::class, 'student_course', 'student_id', 'course_offering_id')
      ->using(StudentCourse::class)
      ->as('enrollment')
      ->withPivot('grade_final')
      ->withTimestamps();
  }

  public function getAvatarUrlAttribute()
  {
    return $this->avatar
      ? asset($this->avatar)
      : asset('assets/images/cambodia.png');
  }
}
