<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookIssue extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'book_id',
    'student_id',
    'teacher_id',
    'issue_date',
    'due_date',
    'return_date',
    'fine',
    'status',
  ];

  protected $casts = [
    'issue_date' => 'date',
    'due_date' => 'date',
    'return_date' => 'date',
    'fine' => 'decimal:2',
    'status' => \App\Enums\BookIssueStatusEnum::class,  // Assuming you might create an Enum for status
  ];

  public function book()
  {
    return $this->belongsTo(Book::class);
  }

  public function student()
  {
    return $this->belongsTo(Student::class);
  }

  public function teacher()
  {
    return $this->belongsTo(Teacher::class);
  }
}
