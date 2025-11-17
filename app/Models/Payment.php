<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
  use SoftDeletes;

  protected $fillable = [
    'amount',
    'payment_date',
    'payment_method',
    'transaction_id',
    'remarks',
    'received_by',
    'student_id',
    'fee_id'
  ];

  public function receiver()
  {
    return $this->belongsTo(User::class, 'received_by');
  }

  public function student()
  {
    return $this->belongsTo(User::class, 'student_id');
  }

  public function fee()
  {
    return $this->belongsTo(Fee::class);
  }
}
