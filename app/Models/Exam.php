<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'name',
    'description',
    'subject_id',
    'date',
    'total_marks',
    'passing_marks',
  ];

  protected $casts = [
    'date' => 'date',
    'total_marks' => 'integer',
    'passing_marks' => 'integer',
  ];

  public function subject()
  {
    return $this->belongsTo(Subject::class);
  }

  public function grades()
  {
    return $this->hasMany(Grade::class);
  }
}
