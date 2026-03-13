<div class="overflow-x-auto rounded-lg">
  <table class="min-w-full border border-gray-300 dark:border-gray-700 rounded-lg text-sm">
    <thead class="bg-gray-100 dark:bg-gray-700">
      <tr>
        <th class="p-2 text-left text-gray-700 dark:text-gray-200 border-b dark:border-gray-600">#</th>
        <th class="p-2 text-left text-gray-700 dark:text-gray-200 border-b dark:border-gray-600">{{ __('message.student') }}</th>
        <th class="p-2 text-left text-gray-700 dark:text-gray-200 border-b dark:border-gray-600">{{ __('message.course') }}</th>
        <th class="p-2 text-center text-gray-700 dark:text-gray-200 border-b dark:border-gray-600">Att.</th>
        <th class="p-2 text-center text-gray-700 dark:text-gray-200 border-b dark:border-gray-600">List.</th>
        <th class="p-2 text-center text-gray-700 dark:text-gray-200 border-b dark:border-gray-600">Writ.</th>
        <th class="p-2 text-center text-gray-700 dark:text-gray-200 border-b dark:border-gray-600">Read.</th>
        <th class="p-2 text-center text-gray-700 dark:text-gray-200 border-b dark:border-gray-600">Speak.</th>
        <th class="p-2 text-center text-gray-700 dark:text-gray-200 border-b dark:border-gray-600">Mid.</th>
        <th class="p-2 text-center text-gray-700 dark:text-gray-200 border-b dark:border-gray-600">Fin.</th>
        <th class="p-2 text-center text-gray-700 dark:text-gray-200 border-b dark:border-gray-600 font-bold">Total</th>
        <th class="p-2 text-center text-gray-700 dark:text-gray-200 border-b dark:border-gray-600">{{ __('message.grade') }}</th>
      </tr>
    </thead>

    <tbody class="bg-white dark:bg-gray-800">
      @forelse ($data as $index => $row)
        <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-900">
          <td class="p-2 text-gray-700 dark:text-gray-300">{{ $index + 1 }}</td>
          <td class="p-2 text-gray-700 dark:text-gray-300 font-medium">
            {{ $row->student->name ?? __('message.n/a') }}
          </td>
          <td class="p-2 text-gray-600 dark:text-gray-400 text-xs">
            {{ $row->courseOffering->subject->name ?? __('message.n/a') }}
            <br>
            <span class="opacity-75">{{ $row->courseOffering->time_slot ?? '' }}</span>
          </td>
          <td class="p-2 text-center text-gray-700 dark:text-gray-300">{{ number_format($row->attendance_grade ?? 0, 0) }}</td>
          <td class="p-2 text-center text-gray-700 dark:text-gray-300">{{ number_format($row->listening_grade ?? 0, 0) }}</td>
          <td class="p-2 text-center text-gray-700 dark:text-gray-300">{{ number_format($row->writing_grade ?? 0, 0) }}</td>
          <td class="p-2 text-center text-gray-700 dark:text-gray-300">{{ number_format($row->reading_grade ?? 0, 0) }}</td>
          <td class="p-2 text-center text-gray-700 dark:text-gray-300">{{ number_format($row->speaking_grade ?? 0, 0) }}</td>
          <td class="p-2 text-center text-gray-700 dark:text-gray-300">{{ number_format($row->midterm_grade ?? 0, 0) }}</td>
          <td class="p-2 text-center text-gray-700 dark:text-gray-300">{{ number_format($row->final_grade ?? 0, 0) }}</td>
          <td class="p-2 text-center font-bold text-gray-900 dark:text-white">
            {{ number_format($row->manual_sum, 1) }}
          </td>
          <td class="p-2 text-center">
            @php
              $letter = $row->letter_grade;
              $class = $letter == 'F' ? 'bg-red-100 text-red-700' : ($letter == 'A' || $letter == 'A+' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700');
            @endphp
            <span class="px-2 py-0.5 rounded-full text-xs font-bold {{ $class }}">
              {{ $letter }}
            </span>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="12" class="px-4 py-3 text-center text-gray-500 dark:text-gray-400 italic">
            {{ __('message.no_score_records_found') }}
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>
