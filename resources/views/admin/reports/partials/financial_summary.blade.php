<div class="space-y-6">

  <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

    <div class="p-4 rounded-lg border bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 shadow-sm">
      <h4 class="text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">{{ __('message.total_income') }}</h4>
      <p class="text-2xl font-bold text-green-600 dark:text-green-400">
        ${{ number_format($data['total_income'] ?? 0, 2) }}
      </p>
    </div>

    <div class="p-4 rounded-lg border bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 shadow-sm">
      <h4 class="text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">{{ __('message.total_expenses') }}</h4>
      <p class="text-2xl font-bold text-red-600 dark:text-red-400">
        ${{ number_format($data['total_expenses'] ?? 0, 2) }}
      </p>
    </div>

    <div class="p-4 rounded-lg border bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 shadow-sm">
      <h4 class="text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">{{ __('message.net_balance') }}</h4>
      <p class="text-2xl font-bold
        @if (($data['total_income'] ?? 0) - ($data['total_expenses'] ?? 0) >= 0) text-blue-600 dark:text-blue-400
        @else
        text-red-600 dark:text-red-400 @endif">
        ${{ number_format(($data['total_income'] ?? 0) - ($data['total_expenses'] ?? 0), 2) }}
      </p>
    </div>

  </div>

  <div class="overflow-x-auto">
    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">{{ __('message.income_breakdown') }}</h3>

    <table class="min-w-full border border-gray-300 dark:border-gray-700 rounded-lg">
      <thead class="bg-gray-100 dark:bg-gray-700">
        <tr>
          <th class="p-2 text-left border-b dark:border-gray-600 text-gray-700 dark:text-gray-200">
            {{ __('message.date') }}
          </th>
          <th class="p-2 text-left border-b dark:border-gray-600 text-gray-700 dark:text-gray-200">
            {{ __('message.description') }}
          </th>
          <th class="p-2 text-left border-b dark:border-gray-600 text-gray-700 dark:text-gray-200">
            {{ __('message.amount') }}
          </th>
        </tr>
      </thead>

      <tbody class="bg-white dark:bg-gray-800">
        @forelse($data['income'] ?? [] as $income)
          <tr class="border-b dark:border-gray-700">
            <td class="p-2 text-gray-700 dark:text-gray-300">
              {{ $income->payment_date ?? '-' }}
            </td>
            <td class="p-2 text-gray-700 dark:text-gray-300">
              {{ $income->description ?? '-' }}
            </td>
            <td class="p-2 text-green-600 dark:text-green-400">
              ${{ number_format($income->amount ?? 0, 2) }}
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="3" class="px-4 py-3 text-center text-gray-500 dark:text-gray-400 italic">
              {{ __('message.no_income_records_found') }}
            </td>
          </tr>
        @endforelse
      </tbody>

    </table>
  </div>

  <div class="overflow-x-auto mt-6">
    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">{{ __('message.expense_breakdown') }}</h3>

    <table class="min-w-full border border-gray-300 dark:border-gray-700 rounded-lg">
      <thead class="bg-gray-100 dark:bg-gray-700">
        <tr>
          <th class="p-2 text-left border-b dark:border-gray-600 text-gray-700 dark:text-gray-200">
            {{ __('message.date') }}
          </th>
          <th class="p-2 text-left border-b dark:border-gray-600 text-gray-700 dark:text-gray-200">
            {{ __('message.category') }}
          </th>
          <th class="p-2 text-left border-b dark:border-gray-600 text-gray-700 dark:text-gray-200">
            {{ __('message.amount') }}
          </th>
        </tr>
      </thead>

      <tbody class="bg-white dark:bg-gray-800">
        @forelse($data['expenses'] ?? [] as $expense)
          <tr class="border-b dark:border-gray-700">
            <td class="p-2 text-gray-700 dark:text-gray-300">{{ $expense->date ?? '-' }}</td>
            <td class="p-2 text-gray-700 dark:text-gray-300">{{ $expense->category->name ?? '-' }}</td>
            <td class="p-2 text-red-600 dark:text-red-400">
              ${{ number_format($expense->amount ?? 0, 2) }}
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="3" class="px-4 py-3 text-center text-gray-500 dark:text-gray-400 italic">
              {{ __('message.no_expense_records_found') }}
            </td>
          </tr>
        @endforelse
      </tbody>

    </table>
  </div>

</div>