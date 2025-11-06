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
    'avatar',
    'department_id',
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
<<<<<<< HEAD
  
=======

>>>>>>> a1dacf9ae07cb648cbaa8dc5e4f5684a79de9010
  public function department()
  {
    return $this->belongsTo(Department::class);
  }

<<<<<<< HEAD
=======
  public function gradeLevel()
  {
    return $this->belongsTo(GradeLevel::class);
  }

  public function courseOfferings()
  {
    return $this->hasMany(CourseOffering::class);
  }

  public function bookIssues()
  {
    return $this->hasMany(BookIssue::class);
  }

  public function students()
  {
    return $this
      ->belongsToMany(Student::class, 'student_guardian')
      ->withPivot('relation_to_student')
      ->withTimestamps();
  }

  public function guardians()
  {
    return $this
      ->belongsToMany(Guardian::class, 'student_guardian')
      ->withPivot('relation_to_student')
      ->withTimestamps();
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
>>>>>>> a1dacf9ae07cb648cbaa8dc5e4f5684a79de9010
}
