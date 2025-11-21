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
    'status',
    'remarks'
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
}
