<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'name',
    'description',
  ];
  public function users()
  {
    return $this->hasMany(User::class);
  }
  public function teachers()
  {
    return $this->hasMany(User::class)
      ->whereHas('roles', function ($query) {
        $query->where('name', 'teacher');
      });
  }
  public function students()
  {
    return $this->hasMany(User::class)
      ->whereHas('roles', function ($query) {
        $query->where('name', 'student');
      });
  }
  public function subjects(): HasMany
  {
    return $this->hasMany(Subject::class);
  }
  public function head()
  {
    return $this->belongsTo(User::class, 'head_id');
  }
}
