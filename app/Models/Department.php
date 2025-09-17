<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'name',
    'description',
  ];

  public function students()
  {
    return $this->hasMany(Student::class);
  }

  public function teachers()
  {
    return $this->hasMany(Teacher::class);
  }

  public function subjects()
  {
    return $this->hasMany(Subject::class);
  }
  public function head()
  {
    return $this->belongsTo(User::class, 'head_id'); // Assuming 'head_id' is the foreign key
  }
}
