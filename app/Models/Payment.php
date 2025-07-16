<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'student_fee_id',
    'amount',
    'payment_date',
    'payment_method',
    'transaction_id',
    'remarks',
    'received_by',
  ];

  protected $casts = [
    'amount' => 'decimal:2',
    'payment_date' => 'date',
  ];

  public function studentFee()
  {
    return $this->belongsTo(StudentFee::class);
  }

  public function receivedBy()
  {
    return $this->belongsTo(User::class, 'received_by');
  }
}
