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

  public function department()
  {
    return $this->belongsTo(Department::class);
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

  public function courses()
  {
    return $this->belongsToMany(Subject::class, 'student_course')
      ->withPivot('grade_final')
      ->withTimestamps();
  }

  public function teachingSubjects()
  {
    return $this->belongsToMany(Subject::class, 'teacher_subject');
  }

  public function subjects()
  {
    return $this->belongsToMany(Subject::class, 'teacher_subject', 'teacher_id', 'subject_id')
      ->using(TeacherSubject::class)
      ->withPivot('time_slot')
      ->withTimestamps();
  }

  public function subjectAssignments()
  {
    return $this->hasMany(TeacherSubject::class, 'teacher_id');
  }

  public function schedules()
  {
    return $this->hasMany(Schedule::class, 'teacher_id');
  }

  public function approvedExpenses()
  {
    return $this->hasMany(Expense::class, 'approved_by');
  }

  public function receivedPayments()
  {
    return $this->hasMany(Payment::class, 'received_by');
  }


  public function teacher()
  {
    return $this->belongsTo(User::class, 'teacher_id')->where('role', 'teacher');
  }
  public function guardians()
  {
    return $this->hasMany(User::class, 'student_id')->where('role', 'guardian');
  }

  public function students()
  {
    return $this->hasMany(User::class, 'guardian_id')->where('role', 'student');
  }

  public function courseOfferings()
  {
    return $this->hasMany(CourseOffering::class);
  }
}
