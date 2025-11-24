<?php

namespace App\Exports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AttendanceExport implements FromCollection, WithHeadings, WithMapping
{
  protected $courseOfferingId;

  public function __construct($courseOfferingId)
  {
    $this->courseOfferingId = $courseOfferingId;
  }

  public function collection()
  {
    return Attendance::with('student')
      ->where('course_offering_id', $this->courseOfferingId)
      ->orderBy('date', 'asc')
      ->get();
  }

  public function headings(): array
  {
    return [
      'Student Name',
      'Student ID',
      'Date',
      'Status',
      'Remarks',
    ];
  }

  public function map($attendance): array
  {
    return [
      $attendance->student->name,
      $attendance->student->id,
      $attendance->date,
      ucfirst($attendance->status),
      $attendance->remarks ?? '—',
    ];
  }
}
