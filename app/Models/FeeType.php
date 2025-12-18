<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeeType extends Model
{
  use SoftDeletes;
  use HasUuids;
  protected $keyType = 'string';
  public $incrementing = false;

  protected $fillable = [
    'name',
    'description'
  ];

  public function fees()
  {
    return $this->hasMany(Fee::class);
  }
}
