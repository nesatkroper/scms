<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guardian extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'name',
    'phone',
    'email',
    'address',
    'occupation',
    'company',
    'relation',
    'photo',
  ];

  public function students()
  {
    return $this
      ->belongsToMany(Student::class, 'student_guardian')
      ->withPivot('relation_to_student')
      ->withTimestamps();
  }
}
