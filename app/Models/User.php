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

  public function department()
  {
    return $this->belongsTo(Department::class);
  }

  public function gradeLevel()
  {
    return $this->belongsTo(GradeLevel::class);
  }

  public function students()
  {
    return $this
      ->belongsToMany(Student::class, 'student_guardian')
      ->withPivot('relation_to_student')
      ->withTimestamps();
  }
}
