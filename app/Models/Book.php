<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'title',
    'category_id',
    'author',
    'isbn',
    'publication_year',
    'publisher',
    'quantity',
    'description',
    'cover_image',
    'content',
  ];

  protected $casts = [
    'publication_year' => 'integer',
    'quantity' => 'integer',
  ];

  public function category()
  {
    return $this->belongsTo(BookCategory::class, 'category_id');
  }

  public function issues()
  {
    return $this->hasMany(BookIssue::class);
  }
}