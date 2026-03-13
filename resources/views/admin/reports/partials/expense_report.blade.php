@if (isset($data['summary']))
  <div
    class="mb-6 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600 pdf-grid pdf-box">
    <h4 class="text-lg font-bold text-gray-800 dark:text-gray-200 mb-2 pdf-title">{{ __('message.financial_summary') }}
    </h4>
    <p class="text-sm text-gray-600 dark:text-gray-300">
      {{ __('message.total_expenses_in_report_period') }}:
      <span class="text-2xl font-extrabold text-red-700 dark:text-red-300 ml-2 pdf-value">
        ${{ number_format($data['summary']['total_expenses'] ?? 0, 2) }}
      </span>
    </p>
  </div>
@endif

<div class="overflow-x-auto shadow-md sm:rounded-lg">
  <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
      <tr>
        <th scope="col" class="px-6 py-3">#</th>
        <th scope="col" class="px-6 py-3">{{ __('message.date') }}</th>
        <th scope="col" class="px-6 py-3">{{ __('message.title') }}</th>
        <th scope="col" class="px-6 py-3">{{ __('message.amount') }}</th>
        <th scope="col" class="px-6 py-3">{{ __('message.category') }}</th>
        <th scope="col" class="px-6 py-3">{{ __('message.recorded_by') }}</th>
        <th scope="col" class="px-6 py-3">{{ __('message.approved_by') }}</th>
        <th scope="col" class="px-6 py-3">{{ __('message.description') }}</th>
      </tr>
    </thead>
    <tbody>
      @forelse($data['list'] ?? [] as $index => $expense)
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
          <td class="px-6 py-2 font-semibold text-gray-800 dark:text-gray-200">
            {{ $index + 1 }}
          </td>
          <td class="px-6 py-2 font-semibold text-gray-800 dark:text-gray-200">
            {{ $expense->date->format('Y-m-d') ?? '-' }}
          </td>
          <th scope="row" class="px-6 py-2 font-medium text-red-600 whitespace-nowrap dark:text-red-400">
            {{ $expense->title }}
          </th>
          <td class="px-6 py-2 text-lg font-bold text-red-700 dark:text-red-300">
            ${{ number_format($expense->amount, 2) }}
          </td>
          <td class="px-6 py-2 text-gray-600 dark:text-gray-300">
            {{ $expense->category->name ?? __('message.n/a') }}
          </td>
          <td class="px-6 py-2 text-gray-600 dark:text-gray-300">
            {{ $expense->creator->name ?? __('message.n/a') }}
          </td>
          <td class="px-6 py-2 text-gray-600 dark:text-gray-300">
            {{ $expense->approver->name ?? __('message.n/a') }}
          </td>
          <td class="px-6 py-2 italic text-gray-500 dark:text-gray-400">
            {{ Str::limit($expense->description, 50) }}
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
            {{ __('message.no_expenses_found_matching_the_criteria') }}
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
