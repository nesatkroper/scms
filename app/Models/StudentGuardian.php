<?php

// app/Models/StudentGuardian.php
namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class StudentGuardian extends Pivot
{
    protected $table = 'student_guardian';
}
