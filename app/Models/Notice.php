<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notice extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'title',
    'content',
    'audience',
    'start_date',
    'end_date',
    'is_published',
    'created_by',
  ];

  protected $casts = [
    'start_date' => 'date',
    'end_date' => 'date',
    'is_published' => 'boolean',
    'audience' => \App\Enums\NoticeAudienceEnum::class,  // Assuming you might create an Enum for audience
  ];

  public function createdBy()
  {
    return $this->belongsTo(User::class, 'created_by');
  }
}
