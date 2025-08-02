<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;


class Village extends Model
{
  use HasFactory;


  protected $table = 'villages';


  protected $primaryKey = 'id';


  protected $fillable = [
    'type',
    'code',
    'khmer_name',
    'name',
    'province_id',
    'district_id',
    'commune_id',
  ];


  public function province(): BelongsTo
  {
    return $this->belongsTo(Province::class, 'province_id', 'id');
  }


  public function district(): BelongsTo
  {
    return $this->belongsTo(District::class, 'district_id', 'id');
  }


  public function commune(): BelongsTo
  {
    return $this->belongsTo(Commune::class, 'commune_id', 'id');
  }
}
