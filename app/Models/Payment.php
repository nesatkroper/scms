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
    'course_offering_id',
    'received_by',
    'student_id',
    'fee_id'
  ];

  protected $casts = [
    'payment_date' => 'datetime',
    'created_at' => 'datetime',
    'updated_at' => 'datetime',
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

  public function courseOffering()
  {
    return $this->belongsTo(CourseOffering::class, 'course_offering_id');
  }
}
