@extends('layouts.admin')

@section('title', 'Course Offerings List')

@section('content')

  <div
    class="box px-2 py-4 md:p-4 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm mb-10">
    <h3 class="text-lg mb-3 font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
      <svg class="size-8 p-1 rounded-full bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
        stroke-linecap="round" stroke-linejoin="round">
        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
        <line x1="16" y1="2" x2="16" y2="6"></line>
        <line x1="8" y1="2" x2="8" y2="6"></line>
        <line x1="3" y1="10" x2="21" y2="10"></line>
        <path d="M12 14h.01"></path>
        <path d="M16 14h.01"></path>
        <path d="M8 18h.01"></path>
        <path d="M12 18h.01"></path>
      </svg>
      Course Offerings List
    </h3>

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

    <form action="{{ route('admin.course_offerings.index') }}" method="GET">
      <div
        class="p-2 md:flex gap-2 justify-between items-center border rounded-md border-gray-200 dark:border-gray-700 bg-violet-50 dark:bg-slate-800">

        <a href="{{ route('admin.course_offerings.create') }}"
          class="text-nowrap px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 cursor-pointer transition-colors flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
              clip-rule="evenodd" />
          </svg>
          Create New Offering
        </a>

        <div class="flex items-center mt-3 md:mt-0 gap-2">
          <div class="relative w-full">
            <input type="search" name="search" id="searchInput"
              placeholder="Search offerings by subject, teacher, or time..."
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
          <a href="{{ route('admin.course_offerings.index') }}" id="resetSearch"
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

    <div id="CardContainer" class="my-5 grid grid-cols-1 xl:grid-cols-2 gap-4">
      @forelse ($courseOfferings as $offering)
        <div
          class="bg-white dark:bg-slate-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-lg transition-shadow duration-300">

          <div
            class="px-4 py-2 bg-slate-50 dark:bg-slate-700 border-b border-gray-100 dark:border-slate-700 flex justify-between">
            <div class="flex flex-col">
              <div class="flex justify-between items-start gap-2">
                <div>
                  <h4
                    class="font-bold text-lg text-gray-800 dark:text-gray-200 @if ($offering->students->count() >= $offering->classroom->capacity) dark:text-red-600 @endif">
                    {{ $offering->subject->name ?? 'Subject Deleted' }} - {{ $offering->teacher->name ?? 'Unassigned' }} -
                    @if ($offering->students->count() >= $offering->classroom->capacity)
                      (Full)
                    @endif
                  </h4>
                </div>
              </div>
              <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 capitalize font-bold">
                {{ $offering->time_slot }}
                ({{ $offering->schedule }})
                ({{ \Carbon\Carbon::parse($offering->start_time)->format('H:i') }} -
                {{ \Carbon\Carbon::parse($offering->end_time)->format('H:i') }})
              </p>
            </div>

            <div class="flex">
              <a href="{{ route('admin.attendances.export', $offering->id) }}"
                class="btn p-2 rounded-full flex justify-center items-center cursor-pointer text-green-600 dark:text-green-400 hover:bg-green-50 dark:hover:bg-slate-600 transition-colors"
                title="Attendance">
                <span class="btn-content flex items-center justify-center">
                  <i class="fa-solid fa-file-export me-2"></i>
                  Eport Attendance
                </span>
              </a>
            </div>
          </div>

          <div class="p-4 space-y-3">
            <div class="flex items-center gap-3 text-sm">
              <div class="p-2 rounded-lg bg-blue-50 dark:bg-slate-700 text-blue-600 dark:text-blue-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
              </div>
              <div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Teacher</p>
                <p class="font-medium text-gray-700 dark:text-gray-200">
                  <span
                    class="text-sm text-indigo-600 dark:text-indigo-400">{{ $offering->teacher->name ?? 'Unassigned' }}</span>
                </p>
              </div>
            </div>

            <div class="flex items-center gap-3 text-sm">
              <div class="p-2 rounded-lg bg-purple-50 dark:bg-slate-700 text-purple-600 dark:text-purple-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
              </div>
              <div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Classroom</p>
                <p class="font-medium text-gray-700 dark:text-gray-200">
                  <span>{{ $offering->classroom->name ?? 'Location TBD' }}</span>
                </p>
              </div>
            </div>

            <div class="flex items-center gap-3 text-sm">
              <div class="p-2 rounded-lg bg-pink-50 dark:bg-slate-700 text-pink-600 dark:text-pink-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8V9m0 2v2m0 2v1.999M20 10V8a2 2 0 00-2-2h-2M4 10v2a2 2 0 002 2h2m10-4v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V10z" />
                </svg>
              </div>
              <div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Fee </p>
                <p class="font-medium text-gray-700 dark:text-gray-200">
                  <span>
                    ${{ number_format($offering->fee, 2) }}
                  </span>
                </p>
              </div>
            </div>
          </div>

          <div
            class="px-4 py-2 bg-gray-50 dark:bg-slate-700/50 border-t border-gray-100 dark:border-slate-700 flex justify-between gap-2">

            <div class="flex">
              <a href="{{ route('admin.attendances.index', ['course_offering_id' => $offering->id]) }}"
                class="btn p-2 rounded-full flex justify-center items-center cursor-pointer text-yellow-600 dark:text-yellow-400 hover:bg-yellow-50 dark:hover:bg-slate-600 transition-colors"
                title="Attendance">
                <span class="btn-content flex items-center justify-center">
                  <i class="fa-regular fa-calendar-days me-2"></i>
                  Attendance
                </span>
              </a>

              <a href="{{ route('admin.exams.index', ['course_offering_id' => $offering->id]) }}"
                class="btn p-2 rounded-full flex justify-center items-center cursor-pointer text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-slate-600 transition-colors"
                title="Exam">
                <span class="btn-content flex items-center justify-center">
                  <i class="fa-solid fa-toolbox me-2"></i>
                  Exam
                </span>
              </a>

              @if ($offering->students->count() >= $offering->classroom->capacity)
                <a href="{{ route('admin.student_courses.index', ['course_offering_id' => $offering->id]) }}"
                  class="btn p-2 rounded-full flex justify-center items-center cursor-pointer text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-slate-600 transition-colors"
                  title="Admission Register">
                  <span class="btn-content flex items-center justify-center">
                    <i class="fa-solid fa-check me-2"></i>
                    Class Full
                  </span>
                </a>
              @else
                <a href="{{ route('admin.student_courses.index', ['course_offering_id' => $offering->id]) }}"
                  class="btn p-2 rounded-full flex justify-center items-center cursor-pointer text-green-600 dark:text-green-400 hover:bg-green-50 dark:hover:bg-slate-600 transition-colors"
                  title="Admission Register">
                  <span class="btn-content flex items-center justify-center">
                    <i class="fa-solid fa-book-atlas me-2"></i>
                    Register
                  </span>
                </a>
              @endif

            </div>

            <div class="flex">
              <a href="{{ route('admin.course_offerings.show', $offering->id) }}"
                class="btn p-2 rounded-full flex justify-center items-center cursor-pointer text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-slate-600 transition-colors"
                title="Edit">
                <span class="btn-content flex items-center justify-center">
                  <i class="fa-regular fa-eye me-2"></i>
                  Show
                </span>
              </a>

              <a href="{{ route('admin.course_offerings.edit', $offering->id) }}"
                class="btn p-2 rounded-full flex justify-center items-center cursor-pointer text-yellow-600 dark:text-yellow-400 hover:bg-yellow-50 dark:hover:bg-slate-600 transition-colors"
                title="Edit">
                <span class="btn-content flex items-center justify-center">
                  <i class="fa-solid fa-pen-to-square me-2"></i>
                  Edit
                </span>
              </a>

              <form action="{{ route('admin.course_offerings.destroy', $offering->id) }}" method="POST"
                onsubmit="return confirm('Are you sure you want to delete this course offering? This action cannot be undone.');">
                @csrf
                @method('DELETE')
                <button type="submit"
                  class="delete-btn p-2 rounded-full flex justify-center items-center cursor-pointer text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-slate-600 transition-colors"
                  title="Delete">
                  <i class="fa-regular fa-trash-can me-2"></i>
                  Delete
                </button>
              </form>
            </div>
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
            <h3 class="mt-4 text-lg font-medium text-red-500 dark:text-red-500">No Course Offerings Found</h3>
            <p class="mt-1 text-sm text-red-500 dark:text-red-500">Create your first course offering to schedule a class.
            </p>
          </div>
        </div>
      @endforelse
    </div>

    <div class="mt-6">
      {{ $courseOfferings->links() }}
    </div>

  </div>
@endsection
