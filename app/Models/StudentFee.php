<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentFee extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'student_id',
    'fee_structure_id',
    'amount',
    'discount',
    'paid_amount',
    'status',
    'due_date',
    'remarks',
  ];

  protected $casts = [
    'amount' => 'decimal:2',
    'discount' => 'decimal:2',
    'paid_amount' => 'decimal:2',
    'due_date' => 'date',
    'status' => \App\Enums\PaymentStatusEnum::class,  // Assuming you might create an Enum for payment status
  ];

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
