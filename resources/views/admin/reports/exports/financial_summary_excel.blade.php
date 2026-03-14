<table>
  <thead>
    <tr>
      <th colspan="5" style="text-align: center; font-weight: bold; font-size: 16pt; background-color: #ef4444; color: #ffffff;">{{ strtoupper($title ?? 'FINANCIAL SUMMARY REPORT') }}</th>
    </tr>
    <tr>
      <th colspan="5" style="text-align: center; color: #6b7280; font-size: 10pt;">Period: {{ request('start_date', 'All Time') }} to {{ request('end_date', 'Present') }}</th>
    </tr>
    <tr></tr>
    <tr>
      <th colspan="2" style="font-weight: bold; background-color: #f3f4f6;">Total Income:</th>
      <th style="color: #16a34a; font-weight: bold; background-color: #f3f4f6;">${{ number_format($data['total_income'] ?? 0, 2) }}</th>
      <th colspan="2" style="background-color: #f3f4f6;"></th>
    </tr>
    <tr>
      <th colspan="2" style="font-weight: bold; background-color: #f3f4f6;">Total Expenses:</th>
      <th style="color: #dc2626; font-weight: bold; background-color: #f3f4f6;">${{ number_format($data['total_expenses'] ?? 0, 2) }}</th>
      <th colspan="2" style="background-color: #f3f4f6;"></th>
    </tr>
    <tr>
      <th colspan="2" style="font-weight: bold; background-color: #f3f4f6;">Net Balance:</th>
      <th style="color: {{ ($data['total_income'] ?? 0) - ($data['total_expenses'] ?? 0) >= 0 ? '#2563eb' : '#dc2626' }}; font-weight: bold; background-color: #f3f4f6;">
        ${{ number_format(($data['total_income'] ?? 0) - ($data['total_expenses'] ?? 0), 2) }}
      </th>
      <th colspan="2" style="background-color: #f3f4f6;"></th>
    </tr>
    <tr></tr>

    <tr style="background-color: #dcfce7;">
      <th colspan="5" style="font-weight: bold; border: 1px solid #000000; text-align: center;">INCOME BREAKDOWN</th>
    </tr>
    <tr>
      <th style="border: 1px solid #000000; background-color: #f3f4f6; font-weight: bold; width: 50px; text-align: center;">NO</th>
      <th style="border: 1px solid #000000; background-color: #f3f4f6; font-weight: bold; width: 120px;">DATE</th>
      <th style="border: 1px solid #000000; background-color: #f3f4f6; font-weight: bold; width: 150px;">CATEGORY</th>
      <th style="border: 1px solid #000000; background-color: #f3f4f6; font-weight: bold; width: 100px;">AMOUNT</th>
      <th style="border: 1px solid #000000; background-color: #f3f4f6; font-weight: bold; width: 300px;">DESCRIPTION</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($data['income'] ?? [] as $index => $income)
      <tr>
        <td style="border: 1px solid #000000; text-align: center;">{{ $index + 1 }}</td>
        <td style="border: 1px solid #000000;">{{ date('Y-m-d', strtotime($income->payment_date)) }}</td>
        <td style="border: 1px solid #000000;">{{ $income->feeType->name ?? 'N/A' }}</td>
        <td style="border: 1px solid #000000; font-weight: bold; color: #16a34a;">${{ number_format($income->amount, 2) }}</td>
        <td style="border: 1px solid #000000; font-style: italic;">{{ $income->description ?? $income->remarks }}</td>
      </tr>
    @endforeach
    <tr></tr>

    <tr style="background-color: #fee2e2;">
      <th colspan="5" style="font-weight: bold; border: 1px solid #000000; text-align: center;">EXPENSE BREAKDOWN</th>
    </tr>
    <tr>
      <th style="border: 1px solid #000000; background-color: #f3f4f6; font-weight: bold; width: 50px; text-align: center;">NO</th>
      <th style="border: 1px solid #000000; background-color: #f3f4f6; font-weight: bold; width: 120px;">DATE</th>
      <th style="border: 1px solid #000000; background-color: #f3f4f6; font-weight: bold; width: 150px;">CATEGORY</th>
      <th style="border: 1px solid #000000; background-color: #f3f4f6; font-weight: bold; width: 100px;">AMOUNT</th>
      <th style="border: 1px solid #000000; background-color: #f3f4f6; font-weight: bold; width: 300px;">DESCRIPTION</th>
    </tr>
    @foreach ($data['expenses'] ?? [] as $index => $expense)
      <tr>
        <td style="border: 1px solid #000000; text-align: center;">{{ $index + 1 }}</td>
        <td style="border: 1px solid #000000;">{{ $expense->date->format('Y-m-d') }}</td>
        <td style="border: 1px solid #000000;">{{ $expense->category->name ?? 'N/A' }}</td>
        <td style="border: 1px solid #000000; font-weight: bold; color: #dc2626;">${{ number_format($expense->amount, 2) }}</td>
        <td style="border: 1px solid #000000; font-style: italic;">{{ $expense->description }}</td>
      </tr>
    @endforeach
  </tbody>
</table>
