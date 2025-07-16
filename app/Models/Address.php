<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Enums\AddressStatus;


class Address extends Model
{
  use HasFactory;

  protected $fillable = [
    'province_id',
    'district_id',
    'commune_id',
    'village_id',
    'description',
    'status',
  ];

  public function province(): BelongsTo
  {
    return $this->belongsTo(Province::class);
  }

  public function district(): BelongsTo
  {
    return $this->belongsTo(District::class);
  }

  public function commune(): BelongsTo
  {
    return $this->belongsTo(Commune::class);
  }

  public function village(): BelongsTo
  {
    return $this->belongsTo(Village::class);
  }

  public function getFullAddressAttribute(): string
  {
    $parts = [];
    if ($this->village) $parts[] = $this->village->name;
    if ($this->commune) $parts[] = $this->commune->name;
    if ($this->district) $parts[] = $this->district->name;
    if ($this->province) $parts[] = $this->province->name;

    return implode(', ', $parts);
  }
}
