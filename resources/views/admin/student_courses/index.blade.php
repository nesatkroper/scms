@extends('layouts.admin')

@section('title', 'Student Enrollments List')

@section('content')

  {{-- Admission Register --}}

  <div
    class="box px-2 py-4 md:p-4 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
    <h3 class="text-lg mb-3 font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
      {{-- Icon for Student Enrollments (using a link/connection theme) --}}
      <svg class="size-8 p-1 rounded-full bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-3-6h-3a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 007.5 21h4.5m-9-10.5h10.5m-10.5 0h10.5m-10.5 0v10.5A2.25 2.25 0 005.25 21h4.5m-9-10.5v10.5A2.25 2.25 0 005.25 21h4.5m-9-10.5v10.5A2.25 2.25 0 005.25 21h4.5" />
      </svg>
      Student Enrollments List
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

    <form action="{{ route('admin.student_courses.index') }}" method="GET">
      <div
        class="p-2 md:flex gap-2 justify-between items-center border rounded-md border-gray-200 dark:border-gray-700 bg-violet-50 dark:bg-slate-800">

        {{-- Create Button (Redirects to Create Page) --}}
        <a href="{{ route('admin.student_courses.create') }}"
          class="text-nowrap px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 cursor-pointer transition-colors flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
              clip-rule="evenodd" />
          </svg>
          Create New Enrollment
        </a>

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

    {{-- Enrollment Cards --}}
    <div id="CardContainer" class="my-5 grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-4">
      @forelse ($studentCourses as $enrollment)
        <div
          class="bg-white dark:bg-slate-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-lg transition-shadow duration-300">

          {{-- Header: Student Name & Course --}}
          <div class="px-4 py-3 bg-slate-50 dark:bg-slate-700 border-b border-gray-100 dark:border-slate-700">
            <div class="flex justify-between items-start gap-2">
              <div>
                {{-- Student Name --}}
                <h4 class="font-bold text-lg text-indigo-600 dark:text-indigo-400">
                  {{ $enrollment->student->name ?? 'Student Deleted' }}
                </h4>
              </div>

              {{-- Detail Button --}}
              {{-- <a href="{{ route('admin.student_courses.show', $enrollment) }}"
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
              </a> --}}
            </div>

            {{-- Course Name --}}
            <p class="text-sm text-gray-700 dark:text-gray-300 mt-1 font-semibold">
              {{ $enrollment->courseOffering->subject->name ?? 'Course Deleted' }}
            </p>
            <p class="text-xs text-gray-500 dark:text-gray-400">
              Time Slot: {{ $enrollment->courseOffering->time_slot ?? 'N/A' }}
            </p>
          </div>

          <div class="p-4 space-y-3">
            {{-- Status --}}
            <div class="flex items-center gap-3 text-sm">
              <div class="p-2 rounded-lg bg-blue-50 dark:bg-slate-700 text-blue-600 dark:text-blue-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 4.04A11.955 11.955 0 002 12c0 2.518.807 4.819 2.19 6.726A11.955 11.955 0 0012 21c2.518 0 4.819-.807 6.726-2.19A11.955 11.955 0 0022 12c0-2.518-.807-4.819-2.19-6.726z" />
                </svg>
              </div>
              <div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Enrollment Status</p>
                @php
                  $statusClasses = [
                      'studying' => 'bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100',
                      'completed' => 'bg-indigo-100 text-indigo-800 dark:bg-indigo-800 dark:text-indigo-100',
                      'suspended' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100',
                      'dropped' => 'bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100',
                  ];
                  $currentStatusClass =
                      $statusClasses[$enrollment->status] ??
                      'bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-gray-100';
                @endphp
                <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $currentStatusClass }}">
                  {{ ucfirst($enrollment->status) }}
                </span>
              </div>
            </div>

            {{-- Payment Status --}}
            <div class="flex items-center gap-3 text-sm">
              <div class="p-2 rounded-lg bg-yellow-50 dark:bg-slate-700 text-yellow-600 dark:text-yellow-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8V9m0 2v2m0 2v1.999M20 10V8a2 2 0 00-2-2h-2M4 10v2a2 2 0 002 2h2m10-4v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V10z" />
                </svg>
              </div>
              <div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Payment Status</p>
                @php
                  $paymentClasses = [
                      'paid' => 'bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100',
                      'pending' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100',
                      'overdue' => 'bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100',
                      'free' => 'bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-100',
                  ];
                  $currentPaymentClass =
                      $paymentClasses[$enrollment->payment_status] ??
                      'bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-gray-100';
                @endphp
                <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $currentPaymentClass }}">
                  {{ ucfirst($enrollment->payment_status) }}
                </span>
              </div>
            </div>

            {{-- Final Grade --}}
            <div class="flex items-center gap-3 text-sm">
              <div class="p-2 rounded-lg bg-pink-50 dark:bg-slate-700 text-pink-600 dark:text-pink-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 19V6a2 2 0 00-2-2H5a2 2 0 00-2 2v13a2 2 0 002 2h4zm9 0V4a2 2 0 00-2-2h-2a2 2 0 00-2 2v15a2 2 0 002 2h2a2 2 0 002-2zM9 19v-4" />
                </svg>
              </div>
              <div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Final Grade</p>
                <p class="font-medium text-gray-700 dark:text-gray-200">
                  <span
                    class="{{ $enrollment->grade_final && $enrollment->grade_final >= 50 ? 'text-green-600' : ($enrollment->grade_final !== null ? 'text-red-600' : 'text-gray-500') }} dark:text-gray-200">
                    {{ $enrollment->grade_final ?? 'N/A' }}
                  </span>
                  / 100
                </p>
              </div>
            </div>
          </div>

          {{-- Actions (Edit Link + Delete Form) --}}
          <div
            class="px-4 py-2 bg-gray-50 dark:bg-slate-700/50 border-t border-gray-100 dark:border-slate-700 flex justify-end gap-2">

            {{-- Edit Button (Redirects to Edit Page) --}}
            <a href="{{ route('admin.student_courses.edit', $enrollment) }}"
              class="btn p-2 rounded-full flex justify-center items-center size-9 cursor-pointer text-green-600 dark:text-green-400 hover:bg-green-50 dark:hover:bg-slate-600 transition-colors"
              title="Edit">
              <span class="btn-content flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
              </span>
            </a>

            {{-- Delete Button (Full form submission) --}}
            <form action="{{ route('admin.student_courses.destroy', $enrollment) }}" method="POST"
              onsubmit="return confirm('Are you sure you want to delete this enrollment? This action cannot be undone.');">
              @csrf
              @method('DELETE')
              <button type="submit"
                class="delete-btn p-2 rounded-full flex justify-center items-center size-9 cursor-pointer text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-slate-600 transition-colors"
                title="Delete">
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
            <h3 class="mt-4 text-lg font-medium text-red-500 dark:text-red-500">No Student Enrollments Found</h3>
            <p class="mt-1 text-sm text-red-500 dark:text-red-500">Create a new enrollment to link a student to a course.
            </p>
          </div>
        </div>
      @endforelse
    </div>

    {{-- Pagination Links --}}
    <div class="mt-6">
      {{ $studentCourses->links() }}
    </div>

  </div>
@endsection
