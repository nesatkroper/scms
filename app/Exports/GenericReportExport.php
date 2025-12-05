<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class GenericReportExport implements FromCollection, WithHeadings, WithMapping
{
  protected $data;
  protected $columns;

  public function __construct($data, array $columns)
  {
    $this->data = collect($data);
    $this->columns = $columns;
  }

  public function collection()
  {
    return $this->data;
  }

  public function headings(): array
  {
    return $this->columns;
  }

  public function map($row): array
  {
    $mapped = [];

    foreach ($this->columns as $column) {
      $key = strtolower(str_replace(' ', '_', $column));
      $mapped[] = data_get($row, $key);
    }

    return $mapped;
  }
}
