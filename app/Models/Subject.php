<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    
    // Remove 'student_id' from fillable fields
    protected $fillable = ['user_id', 'admission_date', 'section_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function guardians()
    {
        return $this->belongsToMany(Guardian::class, 'student_guardian');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    public function studentFees()
    {
        return $this->hasMany(StudentFee::class);
    }
}