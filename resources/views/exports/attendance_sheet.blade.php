<table>
  <tr>
    <td colspan="40"><strong>Name:</strong> {{ $course->teacher->name }}</td>
  </tr>
  <tr>
    <td colspan="40"><strong>Level:</strong> {{ $course->level }}</td>
  </tr>
  <tr>
    <td colspan="40"><strong>Time:</strong> {{ $course->time_slot }}</td>
  </tr>

  <tr>
    <td rowspan="2"><strong>No</strong></td>
    <td rowspan="2"><strong>Name</strong></td>
    <td rowspan="2"><strong>Sex</strong></td>

    <td colspan="{{ count($dates) }}" align="center">
      <strong>{{ $dates[0]->format('F') }}</strong>
    </td>

    <td rowspan="2"><strong>Total</strong></td>
  </tr>

  <tr>
    @foreach ($dates as $day)
      <td align="center">{{ $day->format('d') }}</td>
    @endforeach
  </tr>

  @php $i = 1; @endphp
  @foreach ($records as $studentId => $attendanceList)
    @php
      $student = $attendanceList->first()->student;
      $attendanceByDate = $attendanceList->keyBy('date');
      $total = 0;
    @endphp

    <tr>
      <td>{{ $i++ }}</td>
      <td>{{ $student->name }}</td>
      <td>{{ $student->gender }}</td>

      @foreach ($dates as $day)
        @php
          $att = $attendanceByDate[$day->toDateString()] ?? null;
          $val = $att ? ($att->status === 'present' ? 1 : ($att->status === 'permission' ? 0.5 : 0)) : '';
          $total += is_numeric($val) ? $val : 0;
        @endphp
        <td align="center">{{ $val }}</td>
      @endforeach

      <td>{{ $total }}</td>
    </tr>
  @endforeach
</table>
