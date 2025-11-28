@extends('layouts.admin')

@section('title', 'Admission Register')
@section('content')

  {{-- @php
    dd($studentCourses);
  @endphp --}}

  <div
    class="box px-2 py-4 md:p-4 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm mb-10">
    <h3 class="text-lg mb-3 font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
      <svg class="size-8 p-1 rounded-full bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-3-6h-3a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 007.5 21h4.5m-9-10.5h10.5m-10.5 0h10.5m-10.5 0v10.5A2.25 2.25 0 005.25 21h4.5m-9-10.5v10.5A2.25 2.25 0 005.25 21h4.5" />
      </svg>
      @if ($courseOffering)
        Admission Register for {{ $courseOffering->subject?->name }} -
        {{ $courseOffering->teacher->name }} -
        {{ $courseOffering->classroom->name }}
        ({{ $courseOffering->time_slot }}) -
        ($ {{ $courseOffering->fee }})
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
    <form action="{{ route('admin.student_courses.index') }}" method="GET">
      <div
        class="p-2 md:flex gap-2 justify-between items-center border rounded-md border-gray-200 dark:border-gray-700 bg-violet-50 dark:bg-slate-800">

        @if ($studentCourses->count() >= $courseOffering->classroom->capacity)
          <div></div>
        @else
          <div class="flex gap-4">
            <a href="{{ route('admin.student_courses.create', ['course_offering_id' => $courseOffering->id]) }}"
              class="text-nowrap px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 cursor-pointer transition-colors flex items-center gap-2 disabled">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                  d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                  clip-rule="evenodd" />
              </svg>
              Create Admission (Existed Student)
            </a>

            <a href="{{ route('admin.students.create') }}"
              class="text-nowrap px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 cursor-pointer transition-colors flex items-center gap-2 disabled">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                  d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                  clip-rule="evenodd" />
              </svg>
              Create Admission (New Student)
            </a>
          </div>
        @endif

        <div class="flex items-center mt-3 md:mt-0 gap-2">
          <div class="relative w-full">
            <input type="search" name="search" id="searchInput"
              placeholder="Search by student name, course, or status..."
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
          <a href="{{ route('admin.student_courses.index') }}" id="resetSearch"
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

    {{-- Admission Register Cards --}}
    <div id="CardContainer" class="my-5 grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-4">
      @forelse($studentCourses as $admission)
        <div
          class="bg-white dark:bg-slate-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-lg transition-shadow duration-300">

          {{-- Header: Student Name & Course --}}
          <div
            class="px-4 py-2 bg-slate-50 dark:bg-slate-700 border-b border-gray-100 dark:border-slate-700 flex justify-between">
            <div class="flex justify-between items-start gap-2">
              <h4 class="font-bold text-lg text-indigo-600 dark:text-indigo-400">
                {{ $admission->student->name ?? 'Student Deleted' }}</h4>
            </div>
            <div class="">
              <p class="text-sm text-gray-700 dark:text-gray-300 mt-1 font-semibold">
                {{ $admission->courseOffering->subject->name ?? 'Course Deleted' }}</p>
              <p class="text-xs text-gray-500 dark:text-gray-400">Time Slot:
                {{ $admission->courseOffering->time_slot ?? 'N/A' }}</p>
            </div>
          </div>

          {{-- NEW SECTION: Status and Details --}}
          <div class="p-4 space-y-2 text-sm text-gray-700 dark:text-gray-300">
            {{-- Status and Payment Status (Flex for alignment) --}}
            <div class="flex justify-between items-center pb-2 border-b border-gray-100 dark:border-gray-700/50">
              {{-- Admission Status --}}
              <p class="flex items-center gap-1 font-medium">
                <i class="fa-solid fa-circle-info text-indigo-500"></i>
                Status:
                <span
                  class="font-semibold px-2 py-0.5 rounded-full text-xs
                  @if ($admission->status === 'Completed') bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300
                  @elseif ($admission->status === 'In Progress')
                    bg-yellow-100 text-yellow-700 dark:bg-yellow-900 dark:text-yellow-300
                  @else
                    bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300 @endif">
                  {{ $admission->status ?? 'N/A' }}
                </span>
              </p>

              {{-- Payment Status --}}
              <p class="flex items-center gap-1 font-medium">
                <i class="fa-solid fa-wallet text-teal-500"></i>
                Payment:

              <p class="text-sm">
                @if ($admission->fee->status == 'paid')
                  <span
                    class="font-bold px-3 py-0.5 rounded-full text-xs bg-teal-100 text-teal-700 dark:bg-teal-900 dark:text-teal-300">
                    Paid on
                    {{ $admission->fee->paid_date ? \Carbon\Carbon::parse($admission->fee->paid_date)->format('M d, Y') : 'N/A' }}
                  </span>
                @elseif ($admission->fee->status == 'pending' && $admission->fee->due_date && $admission->fee->due_date->isPast())
                  <span
                    class="font-bold px-3 py-0.5 rounded-full text-xs bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-300">
                    Overdue
                  </span>
                @else
                  <span
                    class="font-bold px-3 py-0.5 rounded-full text-xs bg-yellow-100 text-yellow-700 dark:bg-yellow-900 dark:text-yellow-300">
                    {{ ucfirst($admission->fee->status) }}
                  </span>
                @endif
              </p>

              {{-- <span
                  class="font-semibold px-2 py-0.5 rounded-full text-xs
                  @if ($admission->payment_status === 'Paid') bg-teal-100 text-teal-700 dark:bg-teal-900 dark:text-teal-300
                  @elseif ($admission->payment_status === 'Pending')
                    bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-300
                  @else
                    bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300 @endif">
                  {{ $admission->payment_status ?? 'N/A' }}
                </span> --}}
              </p>
            </div>

            {{-- Final Grade --}}
            <p class="flex justify-between items-center">
              <span class="font-medium text-gray-600 dark:text-gray-400 flex items-center gap-1">
                <i class="fa-solid fa-graduation-cap text-purple-500"></i>
                Final Grade:
              </span>
              <span class="font-bold text-lg text-purple-600 dark:text-purple-400">
                {{ $admission->grade_final ?? 'N/A' }}
              </span>
            </p>

            {{-- Remarks --}}
            @if ($admission->remarks)
              <div class="pt-2 border-t border-gray-100 dark:border-gray-700/50">
                <span class="font-medium text-gray-600 dark:text-gray-400 flex items-center gap-1 mb-1">
                  <i class="fa-solid fa-comment-dots text-yellow-500"></i>
                  Remarks:
                </span>
                <p class="text-xs italic text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-gray-700 p-2 rounded-md">
                  {{ Str::limit($admission->remarks, 100) }}
                </p>
              </div>
            @endif
          </div>

          <div
            class="px-4 py-2 bg-gray-50 dark:bg-slate-700/50 border-t border-gray-100 dark:border-slate-700 flex justify-between gap-2">

            <div class="flex">
              <a href="{{ route('admin.attendances.show', [$courseOffering->id, $admission->student->id]) }}"
                class="btn p-2 rounded-full flex justify-center items-center cursor-pointer text-green-600 dark:text-green-400 hover:bg-green-50 dark:hover:bg-slate-600 transition-colors"
                title="Attendance">
                <span class="btn-content flex items-center justify-center">
                  <i class="fa-solid fa-book-atlas me-2"></i>
                  Attendance
                </span>
              </a>
            </div>

            <div class="flex">
              <a href="{{ route('admin.student_courses.edit', ['student_id' => $admission->student_id, 'course_offering_id' => $admission->course_offering_id]) }}"
                class="btn p-2 rounded-full flex justify-center items-center cursor-pointer text-yellow-600 dark:text-yellow-400 hover:bg-yellow-50 dark:hover:bg-slate-600 transition-colors"
                title="Edit Admission">
                <span class="btn-content flex items-center justify-center">
                  <i class="fa-solid fa-pen-to-square me-2"></i>
                  Edit
                </span>
              </a>

              <form
                action="{{ route('admin.student_courses.destroy', ['student_id' => $admission->student_id, 'course_offering_id' => $admission->course_offering_id]) }}"
                method="POST" onsubmit="return confirm('Are you sure you want to delete this admission record?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                  class="delete-btn p-2 rounded-full flex justify-center items-center cursor-pointer text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-slate-600 transition-colors"
                  title="Delete Admission">
                  <i class="fa-regular fa-trash-can me-2"></i>
                  Delete
                </button>
              </form>
            </div>
          </div>
        </div>
      @empty
      @endforelse
    </div>
  </div>

@endsection
