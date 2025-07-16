<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Timetable extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'section_id',
    'title',
    'description',
    'is_active',
    'start_date',
    'end_date',
  ];

  protected $casts = [
    'is_active' => 'boolean',
    'start_date' => 'date',
    'end_date' => 'date',
  ];

  public function section()
  {
    return $this->belongsTo(Section::class);
  }
}
