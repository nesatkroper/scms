<table>
  <thead>
    <tr>
      <th colspan="8"
        style="text-align: center; font-weight: bold; font-size: 16pt; background-color: #ef4444; color: #ffffff;">
        {{ strtoupper($title ?? 'STUDENT ENROLLMENT REPORT') }}</th>
    </tr>
    <tr>
      <th colspan="8" style="text-align: center; color: #6b7280; font-size: 10pt;">Period:
        {{ request('start_date', 'All Time') }} to {{ request('end_date', 'Present') }}</th>
    </tr>
    <tr></tr>
    <tr>
      <th
        style="border: 1px solid #000000; background-color: #f3f4f6; font-weight: bold; width: 50px; text-align: center;">
        NO</th>
      <th style="border: 1px solid #000000; background-color: #f3f4f6; font-weight: bold; width: 250px;">STUDENT NAME
      </th>
      <th style="border: 1px solid #000000; background-color: #f3f4f6; font-weight: bold; width: 200px;">COURSE / SUBJECT
      </th>
      <th style="border: 1px solid #000000; background-color: #f3f4f6; font-weight: bold; width: 150px;">TIME SLOT</th>
      <th style="border: 1px solid #000000; background-color: #f3f4f6; font-weight: bold; width: 120px;">ENROLL DATE</th>
      <th
        style="border: 1px solid #000000; background-color: #f3f4f6; font-weight: bold; width: 100px; text-align: center;">
        STATUS</th>
      <th
        style="border: 1px solid #000000; background-color: #f3f4f6; font-weight: bold; width: 120px; text-align: center;">
        PAYMENT</th>
      <th
        style="border: 1px solid #000000; background-color: #f3f4f6; font-weight: bold; width: 80px; text-align: center;">
        GRADE</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($data as $enrollment)
      <tr>
        <td style="border: 1px solid #000000; text-align: center;">{{ $loop->iteration }}</td>
        <td style="border: 1px solid #000000; font-weight: bold;">{{ $enrollment->student->name }}</td>
        <td style="border: 1px solid #000000;">{{ $enrollment->courseOffering->subject->name ?? 'N/A' }}</td>
        <td style="border: 1px solid #000000;">{{ ucfirst($enrollment->courseOffering->time_slot ?? 'N/A') }}</td>
        <td style="border: 1px solid #000000;">{{ $enrollment->created_at->format('d-M-Y') }}</td>
        <td style="border: 1px solid #000000; text-align: center;">
          {{ strtoupper($enrollment->status) }}
        </td>
        <td style="border: 1px solid #000000; text-align: center;">
          {{ strtoupper(str_replace('_', ' ', $enrollment->payment_status)) }}
        </td>
        <td style="border: 1px solid #000000; text-align: center; font-weight: bold;">
          {{ $enrollment->grade_final }}
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
