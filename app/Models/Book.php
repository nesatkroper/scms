<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'isbn',
        'publication_year',
        'publisher',
        'quantity',
        'description',
        'category',
        'cover_image',
    ];

    public function issues()
    {
        return $this->hasMany(BookIssue::class);
    }
}
