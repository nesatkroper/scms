<?php

// app/Models/Expense.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'amount', 'date', 'category', 'approved_by'];

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
