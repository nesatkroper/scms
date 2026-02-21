@if (isset($data['summary']))
  <div class="mb-6 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600">
    <h4 class="text-lg font-bold text-gray-800 dark:text-gray-200 mb-2">{{ __('message.financial_summary') }}</h4>
    <p class="text-sm text-gray-600 dark:text-gray-300">
      {{ __('message.total_income_in_report_period') }}:
      <span class="text-2xl font-extrabold text-green-700 dark:text-green-300 ml-2">
        ${{ number_format($data['summary']['total_income'] ?? 0, 2) }}
      </span>
    </p>
  </div>
@endif

<div class="overflow-x-auto shadow-md sm:rounded-lg">
  <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
      <tr>
        <th scope="col" class="px-6 py-3">{{ __('message.payment_date') }}</th>
        <th scope="col" class="px-6 py-3">{{ __('message.student') }}</th>
        <th scope="col" class="px-6 py-3">{{ __('message.amount') }}</th>
        <th scope="col" class="px-6 py-3">{{ __('message.fee_type') }}</th>
        <th scope="col" class="px-6 py-3">{{ __('message.payment_method') }}</th>
        <th scope="col" class="px-6 py-3">{{ __('message.received_by') }}</th>
        <th scope="col" class="px-6 py-3">{{ __('message.remarks') }}</th>
      </tr>
    </thead>
    <tbody>
      @forelse($data['list'] ?? [] as $fee)
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
          <td class="px-6 py-4 font-semibold text-gray-800 dark:text-gray-200">
            {{ $fee->payment_date ? $fee->payment_date->format('Y-m-d') : '-' }}
          </td>
          <th scope="row" class="px-6 py-4 font-medium text-green-600 whitespace-nowrap dark:text-green-400">
            {{ $fee->student->name ?? __('message.n/a') }}
          </th>
          <td class="px-6 py-4 text-lg font-bold text-green-700 dark:text-green-300">
            ${{ number_format($fee->amount, 2) }}
          </td>
          <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
            {{ $fee->feeType->name ?? __('message.n/a') }}
          </td>
          <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
            {{ strtoupper($fee->payment_method) }}
          </td>
          <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
            {{ $fee->receiver->name ?? __('message.n/a') }}
          </td>
          <td class="px-6 py-4 italic text-gray-500 dark:text-gray-400">
            {{ Str::limit($fee->remarks, 50) }}
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="7" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
            {{ __('message.no_income_found_matching_the_criteria') }}
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>