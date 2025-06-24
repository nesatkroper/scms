<?php
// app/Models/FeeStructure.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeStructure extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'grade_level_id', 'amount', 'frequency', 'effective_from', 'effective_to', 'description'];

    public function gradeLevel()
    {
        return $this->belongsTo(GradeLevel::class);
    }

    public function studentFees()
    {
        return $this->hasMany(StudentFee::class);
    }
}
