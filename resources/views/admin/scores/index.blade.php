@extends('layouts.admin')

@section('title', 'Score Register')

@section('content')

  <div
    class="box px-2 py-4 md:p-4 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
    <h3 class="text-lg mb-3 font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
      {{-- Icon for Scores/Exams --}}
      <svg class="size-8 p-1 rounded-full bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M16.5 6.75A.75.75 0 0 1 17.25 7.5v6A.75.75 0 0 1 16.5 15h-9a.75.75 0 0 1-.75-.75v-6A.75.75 0 0 1 7.5 6.75h9Z" />
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M13.5 10.5h-3m3 0a.75.75 0 1 1 0 1.5.75.75 0 0 1 0-1.5ZM17.25 15V7.5a.75.75 0 0 0-.75-.75h-9a.75.75 0 0 0-.75.75V15h10.5Z" />
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M3 6.75a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 6.75v10.5A2.25 2.25 0 0 1 18.75 19.5H5.25A2.25 2.25 0 0 1 3 17.25V6.75Z" />
      </svg>
      @if ($exam)
        Score Register for Exam: <span class="ml-1 text-indigo-600 dark:text-indigo-400">{{ $exam->name }}</span>
      @endif
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

    {{-- Search Form --}}
    <form action="{{ route('admin.scores.index') }}" method="GET">
      <div
        class="p-2 md:flex gap-2 justify-between items-center border rounded-md border-gray-200 dark:border-gray-700 bg-violet-50 dark:bg-slate-800">
        <a href="{{ route('admin.scores.create', ['exam_id' => $exam->id]) }}"
          class="text-nowrap px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 cursor-pointer transition-colors flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
              clip-rule="evenodd" />
          </svg>
          Record New Score
        </a>

        <div class="flex items-center mt-3 md:mt-0 gap-2">
          <input type="hidden" name="exam_id" value="{{ $exam->id }}">
          <div class="relative w-full">
            <input type="search" name="search" id="searchInput"
              placeholder="Search by student name, grade, or remarks..."
              class="w-full border border-gray-300 dark:border-gray-500 dark:bg-gray-700 text-sm rounded-lg pl-8 pr-2 py-1.5
                           focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-800 dark:text-gray-100"
              value="{{ request('search') }}">
            <i class="fas fa-search absolute left-2.5 top-2.5 text-gray-400 text-xs"></i>
          </div>

          <button type="submit"
            class="p-2 h-8 w-8 flex items-center justify-center cursor-pointer bg-indigo-600 dark:bg-indigo-700 hover:bg-indigo-700 dark:hover:bg-indigo-600 rounded-md transition-colors text-white"
            title="Search">
            <i class="fas fa-search text-white text-xs"></i>
          </button>
          <a href="{{ route('admin.scores.index', ['exam_id' => $exam->id]) }}" id="resetSearch"
            class="p-2 h-8 w-8 flex items-center justify-center cursor-pointer bg-indigo-100 dark:bg-indigo-700 hover:bg-gray-300 dark:hover:bg-indigo-600 rounded-md transition-colors"
            title="Reset Search">
            <svg class="h-5 w-5 text-indigo-600 dark:text-gray-300" fill="none" stroke="currentColor"
              viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 4v5h.582m15.356-2A8.98 8.98 0 0020 12a9 9 0 11-8-9.98l-7.9 7.9M2 12h2"></path>
            </svg>
          </a>
        </div>
      </div>
    </form>

    {{-- Score Cards --}}
    <div id="CardContainer" class="my-5 grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-4">
      @forelse($scores as $scoreEntry)
        <div
          class="bg-white dark:bg-slate-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-lg transition-shadow duration-300">

          {{-- Header: Student Name & Exam Name --}}
          <div class="px-4 py-3 bg-slate-50 dark:bg-slate-700 border-b border-gray-100 dark:border-slate-700">
            <div class="flex justify-between items-start gap-2">
              <h4 class="font-bold text-lg text-indigo-600 dark:text-indigo-400">
                {{ $scoreEntry->student->name ?? 'Student Deleted' }}</h4>
            </div>
            <p class="text-sm text-gray-700 dark:text-gray-300 mt-1 font-semibold">
              Exam: {{ $scoreEntry->exam->name ?? 'Exam Deleted' }}</p>
          </div>

          {{-- Score and Details --}}
          <div class="p-4 space-y-2 text-sm text-gray-700 dark:text-gray-300">

            {{-- Raw Score (Large) --}}
            <div class="flex justify-between items-center pb-2 border-b border-gray-100 dark:border-gray-700/50">
              <p class="text-2xl font-extrabold text-blue-600 dark:text-blue-400">
                <i class="fa-solid fa-calculator text-blue-500 mr-2"></i>
                Score: {{ $scoreEntry->score ?? 'N/A' }} / 100
              </p>
              <p class="flex items-center gap-1 font-medium">
                <span
                  class="font-semibold text-lg px-3 py-1 rounded-full
                        @if ($scoreEntry->grade === 'A+') bg-green-200 text-green-800 dark:bg-green-700 dark:text-green-200
                        @elseif (in_array($scoreEntry->grade, ['A', 'B+'])) bg-lime-200 text-lime-800 dark:bg-lime-700 dark:text-lime-200
                        @elseif (in_array($scoreEntry->grade, ['F', 'D'])) bg-red-200 text-red-800 dark:bg-red-700 dark:text-red-200
                        @else bg-gray-200 text-gray-800 dark:bg-gray-700 dark:text-gray-200 @endif">
                  Grade: {{ $scoreEntry->grade ?? 'N/A' }}
                </span>
              </p>
            </div>

            {{-- Remarks --}}
            @if ($scoreEntry->remarks)
              <div class="pt-2 border-t border-gray-100 dark:border-gray-700/50">
                <span class="font-medium text-gray-600 dark:text-gray-400 flex items-center gap-1 mb-1">
                  <i class="fa-solid fa-comment-dots text-yellow-500"></i>
                  Remarks:
                </span>
                <p class="text-xs italic text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-gray-700 p-2 rounded-md">
                  {{ Str::limit($scoreEntry->remarks, 100) }}
                </p>
              </div>
            @endif
          </div>

          <div
            class="px-4 py-2 bg-gray-50 dark:bg-slate-700/50 border-t border-gray-100 dark:border-slate-700 flex justify-end gap-2">

            {{-- Edit Button --}}
            <a href="{{ route('admin.scores.edit', ['student_id' => $scoreEntry->student_id, 'exam_id' => $scoreEntry->exam_id]) }}"
              class="btn p-2 rounded-full flex justify-center items-center size-9 cursor-pointer text-green-600 dark:text-green-400 hover:bg-green-50 dark:hover:bg-slate-600 transition-colors"
              title="Edit Score">
              <span class="btn-content flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
              </span>
            </a>

            {{-- Delete Form --}}
            <form
              action="{{ route('admin.scores.destroy', ['student_id' => $scoreEntry->student_id, 'exam_id' => $scoreEntry->exam_id]) }}"
              method="POST"
              onsubmit="return confirm('Are you sure you want to delete this score record? This action is generally discouraged.');">
              @csrf
              @method('DELETE')
              <button type="submit"
                class="delete-btn p-2 rounded-full flex justify-center items-center size-9 cursor-pointer text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-slate-600 transition-colors"
                title="Delete Score">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
              </button>
            </form>
          </div>
        </div>
      @empty
        {{-- Empty State --}}
        <div class="lg:col-span-4 p-8 text-center bg-gray-50 dark:bg-gray-700 rounded-lg shadow-inner">
          <p class="text-lg font-semibold text-gray-700 dark:text-gray-300">
            No scores found for this exam.
          </p>
          <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
            Click "Record New Score" to add the first entry.
          </p>
        </div>
      @endforelse
    </div>

    {{-- Pagination Links --}}
    <div class="mt-6">
      {{ $scores->links() }}
    </div>

  </div>

@endsection
