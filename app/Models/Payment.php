<?php

// app/Models/Payment.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = ['student_fee_id', 'amount', 'payment_date', 'payment_method', 'transaction_id', 'remarks', 'received_by'];

    public function studentFee()
    {
        return $this->belongsTo(StudentFee::class);
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'received_by');
    }
}
