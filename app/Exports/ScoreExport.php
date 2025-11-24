<?php

namespace App\Exports;

use App\Models\Score;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ScoreExport implements FromCollection, WithHeadings, WithMapping
{
  protected $examId;

  public function __construct($examId)
  {
    $this->examId = $examId;
  }

  public function collection()
  {
    return Score::with('student')
      ->where('exam_id', $this->examId)
      ->orderBy('student_id')
      ->get();
  }

  public function headings(): array
  {
    return [
      'Student Name',
      'Student ID',
      'Score',
      'Grade',
      'Remarks',
    ];
  }

  public function map($score): array
  {
    return [
      $score->student->name,
      $score->student->id,
      $score->score,
      $score->grade,
      $score->remarks ?? '—',
    ];
  }
}
