<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fee extends Model
{
  use SoftDeletes;

  protected $fillable = [
    'student_id',
    'created_by',
    'fee_type_id',
    'amount',
    'due_date',
    // 'paid_date',
    // 'status',
    'remarks'
  ];

  protected $casts = [
    'due_date' => 'date',
    'paid_date' => 'date',
  ];

  public function student()
  {
    return $this->belongsTo(User::class, 'student_id');
  }

  public function feeType()
  {
    return $this->belongsTo(FeeType::class);
  }

  public function payments()
  {
    return $this->hasMany(Payment::class);
  }

  public function creator()
  {
    return $this->belongsTo(User::class, 'created_by');
  }

  public function getStatusAttribute()
  {
    $paid = $this->payments->sum('amount');

    if ($paid == 0) return 'unpaid';
    if ($paid < $this->amount) return 'partially_paid';
    if ($paid == $this->amount) return 'paid';
    if ($paid > $this->amount) return 'overpaid';
  }

  public function getPaidDateAttribute()
  {
    return $this->payments()->latest('payment_date')->value('payment_date');
  }
}