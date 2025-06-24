<?php
// app/Models/BookIssue.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookIssue extends Model
{
    use HasFactory;
    protected $fillable = ['book_id', 'user_id', 'issue_date', 'due_date', 'return_date', 'fine', 'status'];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
