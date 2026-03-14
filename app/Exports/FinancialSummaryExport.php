<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class FinancialSummaryExport implements FromView, ShouldAutoSize, WithStyles
{
  protected $data;
  protected $title;

  public function __construct($data, $title = 'Financial Summary Report')
  {
    $this->data = $data;
    $this->title = $title;
  }

  public function view(): View
  {
    return view('admin.reports.exports.financial_summary_excel', [
      'data' => $this->data,
      'title' => $this->title
    ]);
  }

  public function styles(Worksheet $sheet)
  {
    return [
      1 => ['font' => ['bold' => true, 'size' => 14]],
    ];
  }
}
