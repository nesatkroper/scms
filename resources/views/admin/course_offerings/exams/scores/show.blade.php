@extends('layouts.admin')

@section('title', 'Student Score Report')

@section('content')
  @php
    $gradeItems = [
        [
            'label' => __('message.attendance'),
            'val' => $enrollment->attendance_grade,
            'max' => 10,
            'color' => 'bg-blue-500',
        ],
        [
            'label' => __('message.listening'),
            'val' => $enrollment->listening_grade,
            'max' => 10,
            'color' => 'bg-purple-500',
        ],
        [
            'label' => __('message.reading'),
            'val' => $enrollment->reading_grade,
            'max' => 10,
            'color' => 'bg-teal-500',
        ],
        [
            'label' => 'Writing',
            'val' => $enrollment->writing_grade,
            'max' => 10,
            'color' => 'bg-indigo-500',
        ],
        [
            'label' => 'Speaking',
            'val' => $enrollment->speaking_grade,
            'max' => 10,
            'color' => 'bg-orange-500',
        ],
        [
            'label' => 'Midterm Exam',
            'val' => $enrollment->midterm_grade,
            'max' => 20,
            'color' => 'bg-yellow-500',
        ],
        [
            'label' => 'Final Exam',
            'val' => $enrollment->final_grade,
            'max' => 30,
            'color' => 'bg-red-500',
        ],
    ];

    $cappedTotal = collect($gradeItems)->sum(fn($item) => min($item['val'] ?? 0, $item['max']));
  @endphp
  <div class="mx-auto space-y-6">

    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
      <div>
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('message.academic_performance') }}</h2>
        <p class="text-sm text-gray-500 dark:text-gray-400">
          {{ __('message.detailed_score_breakdown_for_academic_assessment') }}</p>
      </div>
      <a href="{{ route('admin.enrollments.index', ['course_offering_id' => $courseOffering->id]) }}"
        class="inline-flex items-center p-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
        <i class="fa-solid fa-arrow-left me-2"></i> {{ __('message.back_to_register') }}
      </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

      {{-- Left Column: Profile & Final Result --}}
      <div class="lg:col-span-1 space-y-6">
        {{-- Student Hero Card --}}
        <div class="bg-gradient-to-br from-indigo-600 to-violet-700 rounded-2xl shadow-xl overflow-hidden text-white">
          <div class="p-6 text-center">
            <div class="mb-4">
              <img src="{{ $student->avatar_url }}" alt="{{ $student->name }}"
                class="size-56 mx-auto rounded-full object-cover border-4 border-green-200 dark:border-green-700 shadow-md">
            </div>
            <h3 class="text-xl font-bold">{{ $student->name }}</h3>
            <p class="text-indigo-100 text-sm opacity-80">{{ $courseOffering?->subject?->name }}</p>
          </div>

          <div class="bg-black/10 p-6 flex justify-around border-t border-white/10">
            <div class="text-center">
              <p class="text-xs uppercase opacity-70 mb-1">{{ __('message.total_score') }}</p>
              <p class="text-2xl font-black">{{ number_format($cappedTotal, 1) }}</p>
            </div>
            <div class="w-px bg-white/10"></div>
            <div class="text-center">
              <p class="text-xs uppercase opacity-70 mb-1">{{ __('message.letter_grad') }}e</p>
              <p class="text-2xl font-black">{{ $enrollment->letter_grade }}</p>
            </div>
          </div>
        </div>

        {{-- Course Details Card --}}
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
          <h4 class="text-sm font-bold text-gray-900 dark:text-white uppercase tracking-wider mb-4">
            {{ __('message.course_information') }}</h4>
          <div class="space-y-4">
            <div class="flex items-center gap-3">
              <div class="p-2 bg-blue-50 dark:bg-blue-900/30 rounded-lg text-blue-600">
                <i class="fa-solid fa-chalkboard-user"></i>
              </div>
              <div>
                <p class="text-xs text-gray-500">{{ __('message.teacher') }}</p>
                <p class="text-sm font-semibold dark:text-gray-200">{{ $courseOffering?->teacher?->name }}</p>
              </div>
            </div>
            <div class="flex items-center gap-3">
              <div class="p-2 bg-green-50 dark:bg-green-900/30 rounded-lg text-green-600">
                <i class="fa-solid fa-circle-check"></i>
              </div>
              <div>
                <p class="text-xs text-gray-500">{{ __('message.status') }}</p>
                <span
                  class="px-2 py-0.5 text-xs font-bold rounded-full {{ $enrollment->manual_sum >= 50 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                  {{ $enrollment->manual_sum >= 50 ? __('message.passed') : __('message.failed') }}
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>

      {{-- Right Column: Detailed Grades --}}
      <div class="lg:col-span-2">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700">
          <div class="p-6 border-b border-gray-100 dark:border-gray-700">
            <h4 class="text-lg font-bold text-gray-900 dark:text-white">{{ __('message.grade_breakdown') }}</h4>
          </div>

          <div class="p-6 space-y-8">

            @foreach ($gradeItems as $item)
              @php
                $displayVal = min($item['val'] ?? 0, $item['max']);
                $percentage = min((($item['val'] ?? 0) / $item['max']) * 100, 100);
              @endphp
              <div>
                <div class="flex justify-between items-end">
                  <span class="text-sm font-bold text-gray-700 dark:text-gray-300">{{ $item['label'] }}</span>
                  <span class="text-sm font-medium text-gray-500 dark:text-gray-400">
                    <span
                      class="text-gray-900 dark:text-white font-bold">{{ number_format($displayVal, 1) }}</span> /
                    {{ $item['max'] }}
                  </span>
                </div>
                <div class="w-full bg-gray-100 dark:bg-gray-700 rounded-full h-4">
                  <div class="{{ $item['color'] }} h-4 rounded-full" style="width: {{ $percentage }}%"></div>
                </div>
              </div>
            @endforeach
          </div>

          @if ($enrollment->remarks)
            <div
              class="m-6 p-4 bg-amber-50 dark:bg-amber-900/20 border border-amber-100 dark:border-amber-800 rounded-xl">
              <div class="flex gap-3">
                <i class="fa-solid fa-comment-dots text-amber-500 mt-1"></i>
                <div>
                  <h5 class="text-sm font-bold text-amber-800 dark:text-amber-400">{{ __('message.teachers_remarks') }}
                  </h5>
                  <p class="text-sm text-amber-700 dark:text-amber-300 italic">"{{ $enrollment->remarks }}"</p>
                </div>
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection
