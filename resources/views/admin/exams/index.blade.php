@extends('layouts.admin')

@section('title', 'Exams List')

@section('content')

  <div
    class="box px-2 py-4 md:p-4 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
    <h3 class="text-lg mb-3 font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
      {{-- Icon for Exams (using a checklist/assessment theme) --}}
      <svg class="size-8 p-1 rounded-full bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
        stroke-linecap="round" stroke-linejoin="round">
        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
        <polyline points="14 2 14 8 20 8"></polyline>
        <line x1="16" y1="13" x2="8" y2="13"></line>
        <line x1="16" y1="17" x2="8" y2="17"></line>
        <polyline points="10 9 9 9 8 9"></polyline>
      </svg>
      Exams List
    </h3>

    {{-- Success/Error Messages --}}
    @if (session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
      </div>
    @endif
    @if (session('error'))
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
      </div>
    @endif

    <form action="{{ route('admin.exams.index') }}" method="GET">
      <div
        class="p-2 md:flex gap-2 justify-between items-center border rounded-md border-gray-200 dark:border-gray-700 bg-violet-50 dark:bg-slate-800">

        {{-- Create Button (Redirects to Create Page) --}}
        <a href="{{ route('admin.exams.create') }}"
          class="text-nowrap px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 cursor-pointer transition-colors flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
              clip-rule="evenodd" />
          </svg>
          Create New Exam
        </a>

        <div class="flex items-center mt-3 md:mt-0 gap-2">
          <div class="relative w-full">
            <input type="search" name="search" id="searchInput"
              placeholder="Search exams by name, course, or description..."
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
          <a href="{{ route('admin.exams.index') }}" id="resetSearch"
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

    {{-- Exam Cards --}}
    <div id="CardContainer" class="my-5 grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-4">
      @forelse ($exams as $exam)
        <div
          class="bg-white dark:bg-slate-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-lg transition-shadow duration-300">

          <div class="px-4 py-2 bg-slate-50 dark:bg-slate-700 border-b border-gray-100 dark:border-slate-700">
            <div class="flex justify-between items-start gap-2">
              <div>
                {{-- Main Exam Name --}}
                <h4 class="font-bold text-lg text-gray-800 dark:text-gray-200 capitalize">{{ $exam->type }}</h4>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                  Course: <span
                    class="font-semibold text-indigo-600 dark:text-indigo-400">{{ $exam->courseOffering->subject->name ?? 'Course Deleted' }}
                    ({{ $exam->courseOffering?->teacher?->name }} - {{ $exam->courseOffering?->time_slot }})
                  </span>
                </p>
              </div>

              {{-- Detail Button (Redirects to Show Page) --}}
              <a href="{{ route('admin.exams.show', $exam->id) }}"
                class="btn p-2 flex items-center justify-center rounded-full size-8 cursor-pointer text-blue-500 hover:bg-blue-100 dark:hover:bg-gray-900 transition-colors"
                title="View Details">
                <span class="btn-content">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                  </svg>
                </span>
              </a>
            </div>
          </div>

          <div class="p-4 space-y-3">
            {{-- Exam Date --}}
            <div class="flex items-center gap-3 text-sm">
              <div class="p-2 rounded-lg bg-red-50 dark:bg-slate-700 text-red-600 dark:text-red-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
              </div>
              <div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Exam Date</p>
                <p class="font-medium text-gray-700 dark:text-gray-200">
                  {{ \Carbon\Carbon::parse($exam->date)->format('F jS, Y') }}
                </p>
              </div>
            </div>

            {{-- Total Marks / Passing Marks --}}
            <div class="flex items-center gap-3 text-sm">
              <div class="p-2 rounded-lg bg-green-50 dark:bg-slate-700 text-green-600 dark:text-green-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 002.944 12c.328 1.488.844 2.936 1.551 4.316l-3.35 3.35a1 1 0 001.414 1.414l3.35-3.35c1.38 0.707 2.828 1.223 4.316 1.551a11.955 11.955 0 01-8.618-3.04A12.02 12.02 0 0012 21.056c1.488-.328 2.936-.844 4.316-1.551l3.35 3.35a1 1 0 001.414-1.414l-3.35-3.35c0.707-1.38 1.223-2.828 1.551-4.316a12.02 12.02 0 00.001-8.168z" />
                </svg>
              </div>
              <div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Total Marks / Passing Marks</p>
                <p class="font-medium text-gray-700 dark:text-gray-200">
                  <span>
                    {{ $exam->total_marks }} / <span
                      class="text-green-600 dark:text-green-400 font-bold">{{ $exam->passing_marks }}</span>
                  </span>
                </p>
              </div>
            </div>

            {{-- Course Time Slot --}}
            <div class="flex items-center gap-3 text-sm">
              <div class="p-2 rounded-lg bg-blue-50 dark:bg-slate-700 text-blue-600 dark:text-blue-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </div>
              <div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Scheduled Time</p>
                <p class="font-medium text-gray-700 dark:text-gray-200">
                  <span>
                    {{ $exam->courseOffering->time_slot ?? 'N/A' }}
                  </span>
                </p>
              </div>
            </div>
          </div>

          {{-- Actions (Edit Link + Delete Form) --}}
          <div
            class="px-4 py-2 bg-gray-50 dark:bg-slate-700/50 border-t border-gray-100 dark:border-slate-700 flex justify-end gap-2">

            <a href="{{ route('admin.scores.create') }}"
              class="btn p-2 rounded-full flex justify-center items-center size-9 cursor-pointer text-green-600 dark:text-green-400 hover:bg-green-50 dark:hover:bg-slate-600 transition-colors"
              title="Edit">
              <span class="btn-content flex items-center justify-center">
                <i class="fa-solid fa-book-atlas"></i>
              </span>
            </a>

            {{-- Edit Button (Redirects to Edit Page) --}}
            <a href="{{ route('admin.exams.edit', $exam->id) }}"
              class="btn p-2 rounded-full flex justify-center items-center size-9 cursor-pointer text-yellow-600 dark:text-yellow-400 hover:bg-yellow-50 dark:hover:bg-slate-600 transition-colors"
              title="Edit">
              <span class="btn-content flex items-center justify-center">
                <i class="fa-solid fa-pen-to-square"></i>
              </span>
            </a>

            {{-- Delete Button (Full form submission) --}}
            <form action="{{ route('admin.exams.destroy', $exam->id) }}" method="POST"
              onsubmit="return confirm('Are you sure you want to delete this exam? This action cannot be undone.');">
              @csrf
              @method('DELETE')
              <button type="submit"
                class="delete-btn p-2 rounded-full flex justify-center items-center size-9 cursor-pointer text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-slate-600 transition-colors"
                title="Delete">
                <i class="fa-regular fa-trash-can"></i>
              </button>
            </form>
          </div>
        </div>
      @empty
        <div class="col-span-full py-12 text-center">
          <div
            class="max-w-md mx-auto p-6 bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700">
            <div class="mx-auto h-16 w-16 rounded-full bg-red-50 dark:bg-slate-700 flex items-center justify-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-400 dark:text-red-500" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                  d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <h3 class="mt-4 text-lg font-medium text-red-500 dark:text-red-500">No Exams Found</h3>
            <p class="mt-1 text-sm text-red-500 dark:text-red-500">Create your first exam to begin recording scores.</p>
          </div>
        </div>
      @endforelse
    </div>

    {{-- Pagination Links --}}
    <div class="mt-6">
      {{ $exams->links() }}
    </div>

  </div>
@endsection
