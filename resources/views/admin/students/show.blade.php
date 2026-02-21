@extends('layouts.admin')
@section('title', __('message.student_details') . ': ' . $student->name)
@section('content')

  <div class="mb-6 flex justify-between items-center">
    <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 flex items-center gap-2">
      <div
        class="size-10 p-2 flex justify-center items-center rounded-full bg-blue-50 text-blue-600 border border-indigo-300 dark:border-indigo-800 dark:text-blue-50 dark:bg-slate-800">
        <i class="ri-user-2-fill text-2xl"></i>
      </div>
      {{ $student->name }} {{ __('message.details') }}
    </h3>
    <div class="flex space-x-3">
      @if (Auth::user()->hasPermissionTo('update_student'))
        <a href="{{ route('admin.students.edit', $student) }}"
          class="p-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 transition-colors flex items-center gap-1">
          <i class="fa-solid fa-user-pen me-2"></i>
          {{ __('message.edit') }}
        </a>
      @endif

      <a href="{{ route('admin.students.index') }}"
        class="p-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 transition-colors flex items-center gap-1">
        <i class="fa-solid fa-house me-2"></i>
        {{ __('message.back_to_list') }}
      </a>
    </div>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-1">
      <div class="lg:sticky lg:top-10">
        <div
          class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 text-center">
          <div class="mb-4">
            <img src="{{ $student->avatar_url }}" alt="{{ $student->name }}"
              class="size-56 mx-auto rounded-full object-cover border-4 border-indigo-200 dark:border-indigo-700 shadow-md">
          </div>
          <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ $student->name }}</h2>
          <p class="text-sm text-indigo-600 dark:text-indigo-400 font-medium">{{ $student->email }}</p>

          <div class="mt-4 pt-2 border-t border-gray-200 dark:border-gray-700">
            <h3 class="text-md font-semibold text-gray-700 dark:text-gray-300 mb-2">{{ __('message.student_metrics') }}
            </h3>
            <div class="flex justify-around text-center">
              {{-- Ensure your controller loaded counts (e.g., withCount(['fees', 'attendances'])) --}}
              <div class="p-2">
                <div class="text-xl font-bold text-indigo-600 dark:text-indigo-400">
                  {{ $student->fees_count ?? 0 }}
                </div>
                <div class="text-xs text-gray-500 dark:text-gray-400">{{ __('message.fee_records') }}</div>
              </div>
              <div class="p-2">
                <div class="text-xl font-bold text-indigo-600 dark:text-indigo-400">
                  {{ $student->attendances_count ?? 0 }}
                </div>
                <div class="text-xs text-gray-500 dark:text-gray-400">{{ __('message.attendance') }}</div>
              </div>
              <div class="p-2">
                <div class="text-xl font-bold text-indigo-600 dark:text-indigo-400">
                  {{ $student->scores_count ?? 0 }}
                </div>
                <div class="text-xs text-gray-500 dark:text-gray-400">{{ __('message.score') }}</div>
              </div>
            </div>
          </div>
        </div>

        @if (Auth::user()->hasPermissionTo('delete_student'))
          <div
            class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border-2 border-dashed border-red-500 dark:border-red-700 mt-4">
            <h3 class="text-md font-semibold text-red-600 dark:text-red-400 mb-3">{{ __('message.danger_zone') }}</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
              {{ __('message.permanently_delete_this_student_desc') }}
            </p>
            <form action="{{ route('admin.students.destroy', $student) }}" method="POST"
              onsubmit="return confirm('Are you sure you want to delete this student: {{ $student->name }}?');">
              @csrf
              @method('DELETE')
              <button type="submit"
                class="w-full p-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition-colors">
                {{ __('message.delete_student') }}
              </button>
            </form>
          </div>
        @endif

      </div>
    </div>

    {{-- Right Column: Detailed Information (SCROLLABLE) --}}
    <div class="lg:col-span-2">
      <div
        class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 divide-y divide-gray-200 dark:divide-gray-700">
        <div class="flex justify-between items-center pb-2">
          <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">{{ __('message.personal_&_contact_info') }}
          </h3>
        </div>

        <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4 pt-2">

          @include('admin.components.detail-item', [
              'label' => __('message.gender'),
              'value' => $student->gender ?? __('message.n/a'),
          ])
          @include('admin.components.detail-item', [
              'label' => __('message.date_of_birth'),
              'value' => $student->date_of_birth
                  ? \Carbon\Carbon::parse($student->date_of_birth)->format('M d, Y')
                  : __('message.n/a'),
          ])
          @include('admin.components.detail-item', [
              'label' => __('message.phone_number'),
              'value' => $student->phone ?? __('message.n/a'),
          ])

          @include('admin.components.detail-item', [
              'label' => __('message.admission_date'),
              'value' => $student->admission_date
                  ? \Carbon\Carbon::parse($student->admission_date)->format('M d, Y')
                  : __('message.n/a'),
          ])
          @include('admin.components.detail-item', [
              'label' => __('message.account_created'),
              'value' => \Carbon\Carbon::parse($student->created_at)->format('M d, Y'),
          ])
          @include('admin.components.detail-item', [
              'label' => __('message.nationality'),
              'value' => $student->nationality ?? __('message.n/a'),
          ])
          @include('admin.components.detail-item', [
              'label' => __('message.religion'),
              'value' => $student->religion ?? __('message.n/a'),
          ])

          @if ($student->occupation || $student->company)
            <div class="sm:col-span-2">
              <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('message.occupation_/_company') }}
              </dt>
              <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                @if ($student->occupation)
                  {{ $student->occupation }}
                @endif
                @if ($student->company)
                  @if ($student->occupation)
                    {{ __('message.at') }}
                  @endif
                  {{ $student->company }}
                @endif
                @if (!$student->occupation && !$student->company)
                  N/A
                @endif
              </dd>
            </div>
          @endif
          <div class="sm:col-span-2">
            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('message.address') }}</dt>
            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $student->address ?? __('message.n/a') }}</dd>
          </div>
        </dl>
      </div>

      <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 mt-4">

        <div class="flex justify-between items-center pb-2">
          <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">{{ __('message.assigned_courses') }}</h3>

        </div>

        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
          {{ __('message.details_about_courses_this_student_is_currently_enrolled_in') }}
        </p>
        @if ($student->courseOfferings->isEmpty())
          <p class="text-gray-500 dark:text-gray-400">This student is not currently enrolled in any courses.</p>
        @else
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
              <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                  <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    {{ __('message.subject') }}
                  </th>
                  <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    {{ __('message.teacher') }}
                  </th>
                  <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    {{ __('message.status') }}
                  </th>
                  <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    {{ __('message.final_grade') }}
                  </th>
                  <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    {{ __('message.schedule') }}
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($student->courseOfferings as $offering)
                  <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                      {{ $offering->subject->name ?? __('message.n/a') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                      {{ $offering->teacher->name ?? __('message.unassigned') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                      {{ $offering?->enrollment?->status ? ucfirst(str_replace('_', ' ', $offering->enrollment->status)) : __('message.n/a') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                      <span
                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800 dark:bg-indigo-800 dark:text-indigo-100">
                        {{ $offering->enrollment->grade_final ?? __('message.n/a') }}
                      </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 capitalize">
                      {{ $offering->schedule ?? __('message.n/a') }}
                      ({{ $offering->start_time ? \Carbon\Carbon::parse($offering->start_time)->format('h:i A') : __('message.n/a') }}
                      -
                      {{ $offering->end_time ? \Carbon\Carbon::parse($offering->end_time)->format('h:i A') : __('message.n/a') }})
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @endif
      </div>

      {{-- Fee Records (Invoices/Bills) --}}
      <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 mt-4">
        <div class="flex justify-between items-center pb-2">
          <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">{{ __('message.fee_records') }}</h3>

        </div>

        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
          {{ __('message.list_of_fees_billed_to_this_student_including_payment_status') }}
        </p>

        @if ($student->fees->isEmpty())
          <p class="text-gray-500 dark:text-gray-400">{{ __('message.no_fee_records_found_for_this_student') }}</p>
        @else
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
              <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                  <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    {{ __('message.type') }}
                  </th>
                  <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    {{ __('message.amount') }}
                  </th>
                  <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    {{ __('message.paid_amount') }}
                  </th>
                  <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    {{ __('message.due_date') }}
                  </th>
                  <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    {{ __('message.status') }}
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($student?->fees as $fee)
                  @php
                    $paidAmount = $fee?->payments?->sum('amount');
                    $status = $fee?->status; // Uses the getStatusAttribute accessor from the Fee model
                  @endphp
                  <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                      {{ $fee->feeType->name ?? __('message.general_fee') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                      ${{ number_format($fee->amount, 2) }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                      ${{ number_format($paidAmount, 2) }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                      {{ $fee->due_date ? \Carbon\Carbon::parse($fee->due_date)->format('M d, Y') : __('message.n/a') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                      <span
                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full capitalize
                                        @if ($status === 'paid') bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100
                                        @elseif ($status === 'unpaid') bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100
                                        @elseif ($status === 'partially_paid') bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100
                                        @elseif ($status === 'overpaid') bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-100 @endif">
                        {{ ucfirst(str_replace('_', ' ', $status)) }}
                      </span>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @endif
      </div>

      {{-- Exam Scores --}}
      <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 mt-4">
        <div class="flex justify-between items-center pb-2">
          <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">{{ __('message.exam_scores') }}</h3>

        </div>

        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
          {{ __('message.individual_scores_recorded_for_exams_in_various_courses') }}
        </p>

        @if ($student->scores->isEmpty())
          <p class="text-gray-500 dark:text-gray-400">{{ __('message.no_exam_scores_found_for_this_student') }}</p>
        @else
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
              <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                  <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    {{ __('message.exam_type_/_course') }}
                  </th>
                  <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    {{ __('message.date') }}
                  </th>
                  <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    {{ __('message.score_/_total') }}
                  </th>
                  <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    {{ __('message.grade') }}
                  </th>
                  <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    {{ __('message.remarks') }}
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($student->scores as $score)
                  <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100 capitalize">
                      <span class="font-bold">{{ $score->exam->type ?? __('message.n/a') }}</span>
                      <p class="text-xs text-gray-500 dark:text-gray-400">
                        ({{ $score->exam->courseOffering->subject->name ?? __('message.unknown_course') }})
                      </p>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                      {{ $score->exam->date ? \Carbon\Carbon::parse($score->exam->date)->format('M d, Y') : __('message.n/a') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                      {{ $score->score }} / {{ $score->exam->total_marks ?? __('message.n/a') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                      <span
                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                            @if ($score->grade) @if (in_array(strtoupper($score->grade), ['A', 'B'])) bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100
                                @elseif (in_array(strtoupper($score->grade), ['C', 'D'])) bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100
                                @elseif (in_array(strtoupper($score->grade), ['F'])) bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100
                                @else bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-100 @endif
@else
bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-100
                            @endif">
                        {{ $score->grade ?? __('message.n/a') }}
                      </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                      {{ $score->remarks ?? '-' }}
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @endif
      </div>

      {{-- {{ __('message.attendance') }} Log --}}
      <div
        class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 mt-4 mb-10">
        <div class="flex justify-between items-center pb-2">
          <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">{{ __('message.attendance') }}
            {{ __('message.log') }}</h3>

        </div>

        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
          {{ __('message.daily_attendance_status_for_enrolled_courses') }}
        </p>

        @if ($student->attendances->isEmpty())
          <p class="text-gray-500 dark:text-gray-400">{{ __('message.no_attendance_records_found_for_this_student') }}
          </p>
        @else
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
              <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                  <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    {{ __('message.date') }}
                  </th>
                  <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    {{ __('message.course') }}
                  </th>
                  <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    {{ __('message.status') }}
                  </th>
                  <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    {{ __('message.remarks') }}
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($student->attendances->sortByDesc('date') as $attendance)
                  <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                      {{ \Carbon\Carbon::parse($attendance->date)->format('M d, Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                      {{ $attendance->courseOffering->subject->name ?? __('message.n/a') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                      <span
                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full capitalize
                                        @if ($attendance->status === 'attending') bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100
                                        @elseif ($attendance->status === 'absent') bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100
                                        @else bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100 @endif">
                        {{ $attendance->status }}
                      </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                      {{ $attendance->remarks ?? '-' }}
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @endif
      </div>
    </div>
  </div>
@endsection
