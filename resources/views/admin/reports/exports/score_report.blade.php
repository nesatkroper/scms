<table>
  <thead>
    <tr>
      <th colspan="11" style="text-align: center; font-weight: bold; font-size: 16pt; background-color: #ef4444; color: #ffffff;">{{ strtoupper($title ?? 'STUDENT GRADE REPORT') }}</th>
    </tr>
    <tr>
      <th colspan="11" style="text-align: center; color: #6b7280; font-size: 10pt;">Period: {{ request('start_date', 'All Time') }} to {{ request('end_date', 'Present') }}</th>
    </tr>
    <tr></tr>
    <tr>
      <th style="border: 1px solid #000000; background-color: #f3f4f6; font-weight: bold; width: 50px; text-align: center;">NO</th>
      <th style="border: 1px solid #000000; background-color: #f3f4f6; font-weight: bold; width: 200px;">STUDENT NAME</th>
      <th style="border: 1px solid #000000; background-color: #f3f4f6; font-weight: bold; width: 250px;">COURSE / SUBJECT</th>
      <th style="border: 1px solid #000000; background-color: #f3f4f6; font-weight: bold; width: 60px; text-align: center;">ATT</th>
      <th style="border: 1px solid #000000; background-color: #f3f4f6; font-weight: bold; width: 60px; text-align: center;">LIST</th>
      <th style="border: 1px solid #000000; background-color: #f3f4f6; font-weight: bold; width: 60px; text-align: center;">WRIT</th>
      <th style="border: 1px solid #000000; background-color: #f3f4f6; font-weight: bold; width: 60px; text-align: center;">READ</th>
      <th style="border: 1px solid #000000; background-color: #f3f4f6; font-weight: bold; width: 60px; text-align: center;">SPEAK</th>
      <th style="border: 1px solid #000000; background-color: #f3f4f6; font-weight: bold; width: 60px; text-align: center;">MID</th>
      <th style="border: 1px solid #000000; background-color: #f3f4f6; font-weight: bold; width: 60px; text-align: center;">FIN</th>
      <th style="border: 1px solid #000000; background-color: #f3f4f6; font-weight: bold; width: 80px; text-align: center;">TOTAL</th>
      <th style="border: 1px solid #000000; background-color: #f3f4f6; font-weight: bold; width: 80px; text-align: center;">GRADE</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($data as $row)
      <tr>
        <td style="border: 1px solid #000000; text-align: center;">{{ $loop->iteration }}</td>
        <td style="border: 1px solid #000000; font-weight: bold;">{{ $row->student->name ?? 'N/A' }}</td>
        <td style="border: 1px solid #000000;">{{ $row->courseOffering->subject->name ?? 'N/A' }} ({{ $row->courseOffering->time_slot ?? '' }})</td>
        <td style="border: 1px solid #000000; text-align: center;">{{ number_format($row->attendance_grade ?? 0, 0) }}</td>
        <td style="border: 1px solid #000000; text-align: center;">{{ number_format($row->listening_grade ?? 0, 0) }}</td>
        <td style="border: 1px solid #000000; text-align: center;">{{ number_format($row->writing_grade ?? 0, 0) }}</td>
        <td style="border: 1px solid #000000; text-align: center;">{{ number_format($row->reading_grade ?? 0, 0) }}</td>
        <td style="border: 1px solid #000000; text-align: center;">{{ number_format($row->speaking_grade ?? 0, 0) }}</td>
        <td style="border: 1px solid #000000; text-align: center;">{{ number_format($row->midterm_grade ?? 0, 0) }}</td>
        <td style="border: 1px solid #000000; text-align: center;">{{ number_format($row->final_grade ?? 0, 0) }}</td>
        <td style="border: 1px solid #000000; text-align: center; font-weight: bold;">{{ number_format($row->manual_sum, 1) }}</td>
        @php
            $letter = $row->letter_grade;
            $color = '#2563eb';
            if($letter == 'F') $color = '#dc2626';
            elseif($letter == 'A' || $letter == 'A+') $color = '#16a34a';
        @endphp
        <td style="border: 1px solid #000000; text-align: center; font-weight: bold; color: {{ $color }};">{{ $letter }}</td>
      </tr>
    @endforeach
  </tbody>
</table>
