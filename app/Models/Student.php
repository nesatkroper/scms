<?php

// // app/Models/Student.php
// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class Student extends Model
// {
//   use HasFactory;
//   protected $fillable = ['user_id', 'admission_date', 'section_id'];

//   public function user()
//   {
//     return $this->belongsTo(User::class);
//   }

//   public function section()
//   {
//     return $this->belongsTo(Section::class);
//   }

//   public function guardians()
//   {
//     return $this->belongsToMany(Guardian::class, 'student_guardian');
//   }

//   public function attendances()
//   {
//     return $this->hasMany(Attendance::class);
//   }

//   public function grades()
//   {
//     return $this->hasMany(Grade::class);
//   }

//   public function studentFees()
//   {
//     return $this->hasMany(StudentFee::class);
//   }
// }

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    // ✅ Expanded fillable fields
    protected $fillable = [
        'user_id',
        'admission_date',
        'section_id',
        'student_code',     // NEW: Unique identifier for student
        'date_of_birth',    // NEW
        'gender',           // NEW
        'nationality',      // NEW
        'address',          // NEW
        'phone',            // NEW
        'email',            // NEW
        'status',           // NEW (active/inactive/etc.)
        'photo',            // NEW (profile image path)
    ];

    // ✅ Casts for automatic date handling
    protected $casts = [
        'admission_date' => 'date',
        'date_of_birth' => 'date',
    ];

    // ✅ Relationships (unchanged + reusable for advanced features)
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

    // ✅ Accessor for full name
    public function getFullNameAttribute()
    {
        return $this->user ? $this->user->name : '';
    }

    // ✅ Scope to filter active students
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
