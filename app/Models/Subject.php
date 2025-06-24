<?php

// app/Models/Subject.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'code', 'department_id', 'description', 'credit_hours'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function classSubjects()
    {
        return $this->hasMany(ClassSubject::class);
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }
}
