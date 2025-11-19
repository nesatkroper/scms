<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
  use SoftDeletes;

  protected $fillable = ['name', 'description', 'subject_id', 'date', 'total_marks', 'passing_marks'];

  public function subject()
  {
    return $this->belongsTo(Subject::class);
  }

  public function scores()
  {
    return $this->hasMany(Score::class);
  }
}
