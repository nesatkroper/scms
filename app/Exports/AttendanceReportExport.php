<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AttendanceReportExport implements FromView, ShouldAutoSize
{
  protected $data;
  protected $title;

  public function __construct($data, $title = 'Attendance Report')
  {
    $this->data = $data;
    $this->title = $title;
  }

  public function view(): View
  {
    return view('admin.reports.exports.attendance_report', [
      'data' => $this->data,
      'title' => $this->title
    ]);
  }
}
