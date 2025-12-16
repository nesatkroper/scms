<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Enrollment extends Model
{
  protected $fillable = [
    'student_id',
    'course_offering_id',
    'grade_final',
    'status',
    'remarks',
  ];

  public function fee()
  {
    return $this->hasOne(Fee::class, 'enrollment_id');
  }

  public function student()
  {
    return $this->belongsTo(User::class, 'student_id');
  }

  public function courseOffering()
  {
    return $this->belongsTo(CourseOffering::class, 'course_offering_id');
  }

  protected static function booted()
  {
    static::created(function (Enrollment $enrollment) {

      DB::transaction(function () use ($enrollment) {
        $course = $enrollment->courseOffering()->first();

        if (! $course) {
          Log::warning("CourseOffering not found for Enrollment ID {$enrollment->id}");
          return;
        }

        $feeType = FeeType::firstOrCreate(
          ['name' => 'Course Fee'],
          ['description' => 'Automatically generated fee type for course enrollment']
        );

        if ($course->payment_type === 'course') {
          Fee::create([
            'student_id'    => $enrollment->student_id,
            'enrollment_id' => $enrollment->id,
            'fee_type_id'   => $feeType->id,
            'created_by'    => Auth::id() ?? 1,
            'amount'        => $course->fee ?? 0,
            'description'   => "Enrollment fee for {$course->subject->name}",
            'due_date'      => now()->addDays(15),
          ]);

          return;
        }

        if ($course->payment_type === 'monthly') {

          $current = \Carbon\Carbon::parse($course->join_start)->startOfMonth();
          $end     = \Carbon\Carbon::parse($course->join_end)->endOfMonth();

          while ($current <= $end) {
            Fee::create([
              'student_id'    => $enrollment->student_id,
              'enrollment_id' => $enrollment->id,
              'fee_type_id'   => $feeType->id,
              'created_by'    => Auth::id() ?? 1,
              'amount'        => $course->fee,
              'description'   => "Monthly fee for {$course->subject->name} - " . $current->format('F Y'),
              'due_date'      => (clone $current)->addDays(15),
            ]);

            $current->addMonth();
          }
        }
      });
    });
  }
}
