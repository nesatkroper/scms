<?php

// app/Models/ClassSubject.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSubject extends Model
{
    use HasFactory;
    protected $fillable = ['section_id', 'subject_id', 'teacher_id', 'room', 'start_time', 'end_time', 'day'];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function timetableEntries()
    {
        return $this->hasMany(TimetableEntry::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
