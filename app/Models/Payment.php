<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
  use SoftDeletes;

  protected $fillable = [
    'fee_id',
    'amount',
    'payment_date',
    'payment_method',
    'transaction_id',
    'remarks',
    'received_by',
    // 'course_offering_id',
    // 'student_id',
  ];

  protected $casts = [
    'payment_date' => 'datetime',
  ];

  public function receiver()
  {
    return $this->belongsTo(User::class, 'received_by');
  }

  public function fee()
  {
    return $this->belongsTo(Fee::class);
  }
}
