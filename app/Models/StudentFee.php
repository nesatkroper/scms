<?php

// app/Models/StudentFee.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentFee extends Model
{
    use HasFactory;
    protected $fillable = ['student_id', 'fee_structure_id', 'amount', 'discount', 'paid_amount', 'status', 'due_date', 'remarks'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function feeStructure()
    {
        return $this->belongsTo(FeeStructure::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
