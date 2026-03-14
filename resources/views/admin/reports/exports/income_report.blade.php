<table>
  <thead>
    <tr>
      <th colspan="8" style="text-align: center; font-weight: bold; font-size: 16pt; background-color: #ef4444; color: #ffffff;">{{ strtoupper($title ?? 'FINANCIAL INCOME REPORT') }}</th>
    </tr>
    <tr>
      <th colspan="8" style="text-align: center; color: #6b7280; font-size: 10pt;">Period: {{ request('start_date', 'All Time') }} to {{ request('end_date', 'Present') }}</th>
    </tr>
    @if(isset($data['summary']))
    <tr>
      <th colspan="8" style="text-align: center; font-weight: bold; background-color: #f9fafb;">Total Income: ${{ number_format($data['summary']['total_income'] ?? 0, 2) }}</th>
    </tr>
    @endif
    <tr></tr>
    <tr>
      <th style="border: 1px solid #000000; background-color: #f3f4f6; font-weight: bold; width: 50px; text-align: center;">NO</th>
      <th style="border: 1px solid #000000; background-color: #f3f4f6; font-weight: bold; width: 120px;">DATE</th>
      <th style="border: 1px solid #000000; background-color: #f3f4f6; font-weight: bold; width: 250px;">STUDENT NAME</th>
      <th style="border: 1px solid #000000; background-color: #f3f4f6; font-weight: bold; width: 100px;">AMOUNT</th>
      <th style="border: 1px solid #000000; background-color: #f3f4f6; font-weight: bold; width: 150px;">FEE TYPE</th>
      <th style="border: 1px solid #000000; background-color: #f3f4f6; font-weight: bold; width: 120px;">METHOD</th>
      <th style="border: 1px solid #000000; background-color: #f3f4f6; font-weight: bold; width: 150px;">RECEIVED BY</th>
      <th style="border: 1px solid #000000; background-color: #f3f4f6; font-weight: bold; width: 300px;">REMARKS</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($data['list'] ?? [] as $fee)
      <tr>
        <td style="border: 1px solid #000000; text-align: center;">{{ $loop->iteration }}</td>
        <td style="border: 1px solid #000000;">{{ $fee->payment_date ? $fee->payment_date->format('Y-m-d') : '-' }}</td>
        <td style="border: 1px solid #000000; font-weight: bold;">{{ $fee->student->name ?? 'N/A' }}</td>
        <td style="border: 1px solid #000000; font-weight: bold; color: #16a34a;">${{ number_format($fee->amount, 2) }}</td>
        <td style="border: 1px solid #000000;">{{ $fee->feeType->name ?? 'N/A' }}</td>
        <td style="border: 1px solid #000000;">{{ strtoupper($fee->payment_method) }}</td>
        <td style="border: 1px solid #000000;">{{ $fee->receiver->name ?? 'N/A' }}</td>
        <td style="border: 1px solid #000000; font-style: italic; color: #6b7280;">{{ $fee->remarks }}</td>
      </tr>
    @endforeach
  </tbody>
</table>
