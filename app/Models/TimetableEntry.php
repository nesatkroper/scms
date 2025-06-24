<?php

// app/Models/TimetableEntry.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimetableEntry extends Model
{
    use HasFactory;
    protected $fillable = ['timetable_id', 'class_subject_id', 'start_time', 'end_time', 'day', 'room'];

    public function timetable()
    {
        return $this->belongsTo(Timetable::class);
    }

    public function classSubject()
    {
        return $this->belongsTo(ClassSubject::class);
    }
}
