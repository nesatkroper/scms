@extends('layouts.admin')

@section('title', 'Score Register')

@section('content')
  <div
    class="box px-2 py-4 md:p-4 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
    <h3 class="text-lg mb-3 font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
      <svg class="size-8 p-1 rounded-full bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M16.5 6.75A.75.75 0 0 1 17.25 7.5v6A.75.75 0 0 1 16.5 15h-9a.75.75 0 0 1-.75-.75v-6A.75.75 0 0 1 7.5 6.75h9Z" />
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M13.5 10.5h-3m3 0a.75.75 0 1 1 0 1.5.75.75 0 0 1 0-1.5ZM17.25 15V7.5a.75.75 0 0 0-.75-.75h-9a.75.75 0 0 0-.75.75V15h10.5Z" />
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M3 6.75a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 6.75v10.5A2.25 2.25 0 0 1 18.75 19.5H5.25A2.25 2.25 0 0 1 3 17.25V6.75Z" />
      </svg>
      Score Register for Exam: <span class="ml-1 text-indigo-600 dark:text-indigo-400">{{ $exam->type }}</span>
    </h3>

    {{-- Success/Error Messages --}}
    @if (session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        {{ session('success') }}
      </div>
    @endif
    @if (session('error'))
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        {{ session('error') }}
      </div>
    @endif

    {{-- Students Table --}}
    <div class="my-5 overflow-x-auto">
      @forelse($students as $student)
        @php
          $scoreEntry = $student->scores->first();
        @endphp

        {{-- Each row is a form to handle individual score submission --}}
        <form action="{{ route('admin.scores.store') }}" method="POST"
          class="flex flex-col md:flex-row items-center border-b border-gray-200 dark:border-gray-700 py-3 first:pt-0 last:border-b-0">
          @csrf
          <input type="hidden" name="student_id" value="{{ $student->id }}">
          <input type="hidden" name="exam_id" value="{{ $exam->id }}">

          {{-- Student Name (Full Width on Small Screens, Fixed Size on Larger) --}}
          <div class="flex-shrink-0 w-full md:w-56 mb-2 md:mb-0">
            <h4 class="font-semibold text-gray-700 dark:text-gray-300">
              {{ $student->name }}
            </h4>
          </div>

          {{-- Input Fields Container (Allows inputs to stack/flex) --}}
          <div class="flex-grow grid grid-cols-3 gap-4 w-full md:w-auto">

            {{-- Score Input --}}
            <div>
              <label for="score-{{ $student->id }}" class="block text-xs font-medium text-gray-500 dark:text-gray-400">
                Score (Max: {{ $exam->total_marks }})
              </label>
              <input type="number" name="score" id="score-{{ $student->id }}" min="0"
                max="{{ $exam->total_marks }}" value="{{ $scoreEntry->score ?? '' }}"
                class="w-full border border-gray-300 dark:border-gray-600 rounded px-2 py-1 text-sm text-gray-800 dark:text-gray-100 focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            {{-- Grade (Auto) --}}
            <div>
              <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">
                Grade (Auto)
              </label>
              <input type="text" name="grade" readonly value="{{ $scoreEntry->grade ?? '' }}"
                class="w-full border border-gray-300 dark:border-gray-600 rounded px-2 py-1 text-sm text-gray-800 dark:text-gray-100 bg-gray-100 dark:bg-gray-700">
            </div>

            {{-- Remarks --}}
            <div>
              <label for="remarks-{{ $student->id }}"
                class="block text-xs font-medium text-gray-500 dark:text-gray-400">
                Remarks
              </label>
              <input type="text" name="remarks" id="remarks-{{ $student->id }}"
                value="{{ $scoreEntry->remarks ?? '' }}"
                class="w-full border border-gray-300 dark:border-gray-600 rounded px-2 py-1 text-sm text-gray-800 dark:text-gray-100 focus:ring-indigo-500 focus:border-indigo-500">
            </div>
          </div>

          {{-- Save Button --}}
          <div class="flex-shrink-0 mt-3 md:mt-0 md:ml-4 w-full md:w-20">
            <button type="submit"
              class="w-full px-3 py-1.5 bg-indigo-600 text-white text-sm rounded hover:bg-indigo-700 transition-colors">
              Save
            </button>
          </div>
        </form>
      @empty
        <div class="p-8 text-center bg-gray-50 dark:bg-gray-700 rounded-lg shadow-inner">
          <p class="text-lg font-semibold text-gray-700 dark:text-gray-300">
            No students found in this course offering.
          </p>
        </div>
      @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
      {{ $students->links() }}
    </div>
  </div>
@endsection
