<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'title',
    'description',
    'amount',
    'date',
    'expense_category_id',
    'approved_by',
  ];

  protected $casts = [
    'amount' => 'decimal:2',
    'date' => 'date',
  ];

  public function category()
  {
    return $this->belongsTo(ExpenseCategory::class, 'expense_category_id');
  }

  public function approvedBy()
  {
    return $this->belongsTo(User::class, 'approved_by');
  }
  public function approver()
  {
    return $this->belongsTo(User::class, 'approver_id'); // 'approver_id' គឺ column នៅក្នុងតារាង `expenses` ដែលទាក់ទងទៅ user
  }
}
