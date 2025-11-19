<?php


  namespace App\Models;

  use Illuminate\Database\Eloquent\Relations\Pivot;

  class StudentCourse extends Pivot
  {
      protected $table = 'student_course';
      protected $fillable = ['student_id','subject_id','grade_final'];
  }
