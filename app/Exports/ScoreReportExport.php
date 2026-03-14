<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ScoreReportExport implements FromView, ShouldAutoSize
{
  protected $data;
  protected $title;

  public function __construct($data, $title = 'Score Report')
  {
    $this->data = $data;
    $this->title = $title;
  }

  public function view(): View
  {
    return view('admin.reports.exports.score_report', [
      'data' => $this->data,
      'title' => $this->title
    ]);
  }
}
