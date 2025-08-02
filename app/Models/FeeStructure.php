<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeeStructure extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'name',
    'grade_level_id',
    'amount',
    'frequency',
    'effective_from',
    'effective_to',
    'description',
  ];

  protected $casts = [
    'amount' => 'decimal:2',
    'effective_from' => 'date',
    'effective_to' => 'date',
    'frequency' => \App\Enums\FeeFrequencyEnum::class,
  ];

  public function gradeLevel()
  {
    return $this->belongsTo(GradeLevel::class);
  }

  public function studentFees()
  {
    return $this->hasMany(StudentFee::class);
  }
}
