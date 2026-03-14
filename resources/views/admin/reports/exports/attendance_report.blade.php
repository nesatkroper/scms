<table>
  <thead>
    <tr>
      <th colspan="5" style="text-align: center; font-weight: bold; font-size: 16pt; background-color: #ef4444; color: #ffffff;">{{ strtoupper($title ?? 'ATTENDANCE REPORT') }}</th>
    </tr>
    <tr>
      <th colspan="5" style="text-align: center; color: #6b7280; font-size: 10pt;">Period: {{ request('start_date', 'All Time') }} to {{ request('end_date', 'Present') }}</th>
    </tr>
    <tr></tr>
    <tr>
      <th style="border: 1px solid #000000; background-color: #f3f4f6; font-weight: bold; width: 50px; text-align: center;">NO</th>
      <th style="border: 1px solid #000000; background-color: #f3f4f6; font-weight: bold; width: 250px;">STUDENT NAME</th>
      <th style="border: 1px solid #000000; background-color: #f3f4f6; font-weight: bold; width: 300px;">COURSE / SUBJECT</th>
      <th style="border: 1px solid #000000; background-color: #f3f4f6; font-weight: bold; width: 120px;">DATE</th>
      <th style="border: 1px solid #000000; background-color: #f3f4f6; font-weight: bold; width: 100px; text-align: center;">STATUS</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($data as $row)
      <tr>
        <td style="border: 1px solid #000000; text-align: center;">{{ $loop->iteration }}</td>
        <td style="border: 1px solid #000000; font-weight: bold;">{{ $row->student->name ?? 'N/A' }}</td>
        <td style="border: 1px solid #000000;">
          {{ $row->courseOffering->subject->name ?? 'N/A' }}
          ({{ $row->courseOffering->teacher->name ?? 'N/A' }} - {{ $row->courseOffering->time_slot ?? 'N/A' }})
        </td>
        <td style="border: 1px solid #000000;">{{ $row->date }}</td>
        @php
            $statusColor = '#000000';
            if($row->status === 'present') $statusColor = '#16a34a';
            elseif($row->status === 'absent') $statusColor = '#dc2626';
            elseif($row->status === 'late' || $row->status === 'permission') $statusColor = '#d97706';
        @endphp
        <td style="border: 1px solid #000000; text-align: center; color: {{ $statusColor }}; font-weight: bold;">
          {{ strtoupper($row->status) }}
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
