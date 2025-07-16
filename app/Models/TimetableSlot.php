<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TimetableSlot extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'course_offering_id',
    'start_time',
    'end_time',
    'day',
    'room_override',
  ];

  protected $casts = [
    'start_time' => 'datetime',
    'end_time' => 'datetime',
    'day' => \App\Enums\DayOfWeekEnum::class,  // Assuming you might create an Enum for days
  ];

  public function courseOffering()
  {
    return $this->belongsTo(CourseOffering::class);
  }
}
