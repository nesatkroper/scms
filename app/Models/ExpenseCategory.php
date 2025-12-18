<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpenseCategory extends Model
{
  use SoftDeletes;
  use HasUuids;
  protected $keyType = 'string';
  public $incrementing = false;

  protected $fillable = ['name', 'description'];

  public function expenses()
  {
    return $this->hasMany(Expense::class);
  }
}
