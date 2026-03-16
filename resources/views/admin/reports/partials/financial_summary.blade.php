<div class="space-y-6">

  {{-- Summary Cards --}}
  <div class="pdf-grid grid grid-cols-1 md:grid-cols-3 gap-4 m-6">
    <div class="pdf-col-3">
      <div
        class="pdf-box p-4 rounded-lg border bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 shadow-sm">
        <h4 class="pdf-title text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">
          {{ __('message.total_income') }}</h4>
        <p class="pdf-value text-2xl font-bold text-green-600 dark:text-green-400">
          ${{ number_format($data['total_income'] ?? 0, 2) }}
        </p>
      </div>
    </div>

    <div class="pdf-col-3">
      <div
        class="pdf-box p-4 rounded-lg border bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 shadow-sm">
        <h4 class="pdf-title text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">
          {{ __('message.total_expenses') }}</h4>
        <p class="pdf-value text-2xl font-bold text-red-600 dark:text-red-400">
          ${{ number_format($data['total_expenses'] ?? 0, 2) }}
        </p>
      </div>
    </div>

    <div class="pdf-col-3">
      <div
        class="pdf-box p-4 rounded-lg border bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-700 shadow-sm">
        <h4 class="pdf-title text-sm font-semibold text-gray-600 dark:text-gray-300 mb-1">
          {{ __('message.net_balance') }}</h4>
        <p
          class="pdf-value text-2xl font-bold 
          @if (($data['total_income'] ?? 0) - ($data['total_expenses'] ?? 0) >= 0) text-blue-600 
          @else text-red-600 @endif">
          ${{ number_format(($data['total_income'] ?? 0) - ($data['total_expenses'] ?? 0), 2) }}
        </p>
      </div>
    </div>
  </div>

  {{-- Breakdowns: 2-column on web, stacks to 1-column on PDF --}}
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
    {{-- Income Breakdown --}}
    <div>
      <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">{{ __('message.income_breakdown') }}</h3>
      <div class="overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" class="px-6 py-3">#</th>
              <th scope="col" class="px-6 py-3">{{ __('message.date') }}</th>
              <th scope="col" class="px-6 py-3">{{ __('message.category') }}</th>
              <th scope="col" class="px-6 py-3">{{ __('message.amount') }}</th>
              <th scope="col" class="px-6 py-3">{{ __('message.description') }}</th>
            </tr>
          </thead>
          <tbody>
            @forelse($data['income'] ?? [] as $index => $income)
              <tr
                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="px-6 py-2 text-gray-700 dark:text-gray-300">{{ $index + 1 }}</td>
                <td class="px-6 py-2 text-gray-700 dark:text-gray-300">
                  {{ date('Y-m-d', strtotime($income->payment_date)) ?? '-' }}</td>
                <td class="px-6 py-2 text-gray-700 dark:text-gray-300">{{ $income->feeType->name ?? '-' }}</td>
                <td class="px-6 py-2 text-green-600 dark:text-green-400 font-bold">
                  ${{ number_format($income->amount ?? 0, 2) }}</td>
                <td class="px-6 py-2 text-gray-700 dark:text-gray-300">{{ $income->description ?? '-' }}</td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400 italic">
                  {{ __('message.no_income_records_found') }}
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    {{-- Expense Breakdown --}}
    <div class="mt-8 md:mt-0">
      <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-2">{{ __('message.expense_breakdown') }}
      </h3>
      <div class="overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" class="px-6 py-3">#</th>
              <th scope="col" class="px-6 py-3">{{ __('message.date') }}</th>
              <th scope="col" class="px-6 py-3">{{ __('message.category') }}</th>
              <th scope="col" class="px-6 py-3">{{ __('message.amount') }}</th>
              <th scope="col" class="px-6 py-3">{{ __('message.description') }}</th>
            </tr>
          </thead>
          <tbody>
            @forelse($data['expenses'] ?? [] as $index => $expense)
              <tr
                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="px-6 py-2 text-gray-700 dark:text-gray-300">{{ $index + 1 }}</td>
                <td class="px-6 py-2 text-gray-700 dark:text-gray-300">{{ $expense->date->format('Y-m-d') ?? '-' }}
                </td>
                <td class="px-6 py-2 text-gray-700 dark:text-gray-300">{{ $expense->category->name ?? '-' }}</td>
                <td class="px-6 py-2 text-red-600 dark:text-red-400 font-bold">
                  ${{ number_format($expense->amount ?? 0, 2) }}</td>
                <td class="px-6 py-2 text-gray-700 dark:text-gray-300">{{ $expense->description ?? '-' }}</td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400 italic">
                  {{ __('message.no_expense_records_found') }}
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
