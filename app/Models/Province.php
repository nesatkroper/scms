<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Province extends Model
{
  use HasFactory;


  protected $table = 'provinces';


  protected $primaryKey = 'id';


  protected $fillable = [
    'type',
    'code',
    'khmer_name',
    'name',
  ];


  public function districts(): HasMany
  {
    return $this->hasMany(District::class, 'province_id', 'id');
  }


  public function communes(): HasMany
  {
    return $this->hasMany(Commune::class, 'province_id', 'id');
  }


  public function villages(): HasMany
  {
    return $this->hasMany(Village::class, 'province_id', 'id');
  }
}
