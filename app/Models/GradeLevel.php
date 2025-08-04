<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GradeLevel extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'name',
    'code',
    'description',
  ];

  public function students()
  {
    return $this->hasMany(Student::class);
  }

  public function feeStructures()
  {
    return $this->hasMany(FeeStructure::class);
  }
}
