<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classroom extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'name',
    'room_number',
    'capacity',
    'facilities',
  ];

  protected $casts = [
    'capacity' => 'integer',
  ];

  public function courseOfferings()
  {
    return $this->hasMany(CourseOffering::class);
  }
}
