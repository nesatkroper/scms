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
    'enrollment_id',
    'amount',
    'due_date',
    'remarks'
  ];

  protected $casts = [
    'due_date' => 'date',
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

  public function studentCourse()
  {
    return $this->belongsTo(Enrollment::class, 'enrollment_id');
  }


  public function getPaidDateAttribute()
  {
    return $this->payments()->latest('payment_date')->value('payment_date');
  }

  public function getStatusAttribute()
  {
    $paid = $this->payments->sum('amount');

    if ($paid <= 0) return 'unpaid';
    if ($paid < $this->amount) return 'partially_paid';
    if ($paid == $this->amount) return 'paid';
    if ($paid > $this->amount) return 'overpaid';

    return 'unknown';
  }


  public function scopeStatus($query, $status)
  {
    return $query->where(function ($q) use ($status) {

      if ($status === 'unpaid') {
        $q->whereDoesntHave('payments')
          ->orWhereHas('payments', function ($sub) {
            $sub->selectRaw('fee_id, SUM(amount) as total_paid')
              ->groupBy('fee_id')
              ->havingRaw('SUM(amount) <= 0');
          });
      }

      if ($status === 'partially_paid') {
        $q->whereHas('payments', function ($sub) {
          $sub->selectRaw('fee_id, SUM(amount) as total_paid')
            ->groupBy('fee_id')
            ->havingRaw('SUM(amount) > 0 AND SUM(amount) < fees.amount');
        });
      }

      if ($status === 'paid') {
        $q->whereHas('payments', function ($sub) {
          $sub->selectRaw('fee_id, SUM(amount) as total_paid')
            ->groupBy('fee_id')
            ->havingRaw('SUM(amount) = fees.amount');
        });
      }

      if ($status === 'overpaid') {
        $q->whereHas('payments', function ($sub) {
          $sub->selectRaw('fee_id, SUM(amount) as total_paid')
            ->groupBy('fee_id')
            ->havingRaw('SUM(amount) > fees.amount');
        });
      }
    });
  }
}
