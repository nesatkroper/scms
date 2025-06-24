<?php
// app/Models/Timetable.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    use HasFactory;
    protected $fillable = ['section_id', 'title', 'description', 'is_active', 'start_date', 'end_date'];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function entries()
    {
        return $this->hasMany(TimetableEntry::class);
    }
}
