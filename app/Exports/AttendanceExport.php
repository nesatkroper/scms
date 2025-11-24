<?php

namespace App\Exports;

use App\Models\Attendance;
use App\Models\CourseOffering;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AttendanceExport implements FromView
{
  protected $courseOfferingId;

  public function __construct($courseOfferingId)
  {
    $this->courseOfferingId = $courseOfferingId;
  }

  public function view(): View
  {
    $course = CourseOffering::with('subject')->findOrFail($this->courseOfferingId);

    $records = Attendance::with('student')
      ->where('course_offering_id', $this->courseOfferingId)
      ->orderBy('student_id')
      ->orderBy('date')
      ->get()
      ->groupBy('student_id');

    $dates = Attendance::where('course_offering_id', $this->courseOfferingId)
      ->orderBy('date')
      ->pluck('date')
      ->map(fn($d) => \Carbon\Carbon::parse($d))
      ->unique('day')
      ->values();

    return view('exports.attendance_sheet', [
      'course' => $course,
      'records' => $records,
      'dates' => $dates,
    ]);
  }
}
