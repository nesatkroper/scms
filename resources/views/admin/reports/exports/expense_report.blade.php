<table>
  <thead>
    <tr>
      <th colspan="8" style="text-align: center; font-weight: bold; font-size: 16pt; background-color: #ef4444; color: #ffffff;">{{ strtoupper($title ?? 'FINANCIAL EXPENSE REPORT') }}</th>
    </tr>
    <tr>
      <th colspan="8" style="text-align: center; color: #6b7280; font-size: 10pt;">Period: {{ request('start_date', 'All Time') }} to {{ request('end_date', 'Present') }}</th>
    </tr>
    @if(isset($data['summary']))
    <tr>
      <th colspan="8" style="text-align: center; font-weight: bold; background-color: #f9fafb;">Total Expenses: ${{ number_format($data['summary']['total_expenses'] ?? 0, 2) }}</th>
    </tr>
    @endif
    <tr></tr>
    <tr>
      <th style="border: 1px solid #000000; background-color: #f3f4f6; font-weight: bold; width: 50px; text-align: center;">NO</th>
      <th style="border: 1px solid #000000; background-color: #f3f4f6; font-weight: bold; width: 120px;">DATE</th>
      <th style="border: 1px solid #000000; background-color: #f3f4f6; font-weight: bold; width: 200px;">TITLE</th>
      <th style="border: 1px solid #000000; background-color: #f3f4f6; font-weight: bold; width: 100px;">AMOUNT</th>
      <th style="border: 1px solid #000000; background-color: #f3f4f6; font-weight: bold; width: 150px;">CATEGORY</th>
      <th style="border: 1px solid #000000; background-color: #f3f4f6; font-weight: bold; width: 150px;">RECORDED BY</th>
      <th style="border: 1px solid #000000; background-color: #f3f4f6; font-weight: bold; width: 150px;">APPROVED BY</th>
      <th style="border: 1px solid #000000; background-color: #f3f4f6; font-weight: bold; width: 300px;">DESCRIPTION</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($data['list'] ?? [] as $expense)
      <tr>
        <td style="border: 1px solid #000000; text-align: center;">{{ $loop->iteration }}</td>
        <td style="border: 1px solid #000000;">{{ $expense->date->format('Y-m-d') }}</td>
        <td style="border: 1px solid #000000; font-weight: bold;">{{ $expense->title }}</td>
        <td style="border: 1px solid #000000; font-weight: bold; color: #dc2626;">${{ number_format($expense->amount, 2) }}</td>
        <td style="border: 1px solid #000000;">{{ $expense->category->name ?? 'N/A' }}</td>
        <td style="border: 1px solid #000000;">{{ $expense->creator->name ?? 'N/A' }}</td>
        <td style="border: 1px solid #000000;">{{ $expense->approver->name ?? 'N/A' }}</td>
        <td style="border: 1px solid #000000; font-style: italic; color: #6b7280;">{{ $expense->description }}</td>
      </tr>
    @endforeach
  </tbody>
</table>
