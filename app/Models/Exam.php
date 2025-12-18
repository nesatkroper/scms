<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
  use SoftDeletes;
  use HasUuids;
  protected $keyType = 'string';
  public $incrementing = false;

  protected $fillable = [
    'type',
    'description',
    'course_offering_id',
    'date',
    'total_marks',
    'passing_marks'
  ];

  public function courseOffering()
  {
    return $this->belongsTo(CourseOffering::class, 'course_offering_id');
  }

  public function scores()
  {
    return $this->hasMany(Score::class);
  }
}
