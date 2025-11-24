@extends('layouts.admin')

@section('title', 'Course Details: ' . $courseOffering->subject->name . ' - ' . $courseOffering->time_slot)

@section('content')

  <div
    class="box px-2 py-4 md:p-6 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm mx-auto">

    <div class="flex items-center justify-between mb-6 border-b pb-4 border-gray-100 dark:border-gray-700/50">
      <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
        <svg class="size-8 p-1 rounded-full bg-blue-50 text-blue-600 dark:text-blue-50 dark:bg-blue-900"
          xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M4.26 10.147a60.854 60.854 0 0115.48 0M10.5 13.5h.008v.008h-.008v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 0h.008v.008h-.008v-.008zm1.5 0h.008v.008h-.008v-.008zM12 15.75c-3.1 0-5.787-1.125-7.5-3v4.5A2.25 2.25 0 006.75 18h10.5a2.25 2.25 0 002.25-2.25v-4.5c-1.713 1.875-4.4 3-7.5 3z" />
        </svg>
        Course Offering Details
      </h3>
      {{-- Back Button --}}
      <a href="{{ route('admin.course_offerings.index') }}"
        class="text-nowrap px-3 py-1 bg-gray-200 text-gray-700 dark:bg-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 transition-colors flex items-center gap-1 text-sm">
        <i class="fas fa-arrow-left text-xs"></i> Back to Offerings
      </a>
    </div>

    {{-- Main Detail Card --}}
    <div class="bg-blue-50 dark:bg-slate-700/30 rounded-lg p-6 space-y-6">

      {{-- Subject Title & Fee --}}
      <div
        class="flex flex-col sm:flex-row justify-between items-start sm:items-center pb-4 border-b border-gray-200 dark:border-gray-700">
        <div class="flex flex-col">
          <h2 class="text-2xl font-extrabold text-blue-700 dark:text-blue-300">
            {{ $courseOffering->subject->name ?? 'N/A' }}
          </h2>
          <p class="text-sm font-semibold text-blue-500 dark:text-blue-400">
            Subject Code: {{ $courseOffering->subject->code ?? 'N/A' }}
          </p>
        </div>
        <span class="text-3xl font-extrabold text-green-700 dark:text-green-400 mt-2 sm:mt-0">
          Fee: ${{ number_format($courseOffering->fee, 2) }}
        </span>
      </div>

      {{-- Core Details Grid (Teacher, Classroom, Schedule) --}}
      <div
        class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 text-sm border-b pb-4 border-gray-200 dark:border-gray-700/50">

        {{-- Teacher --}}
        <p class="detail-item">
          <span class="font-medium text-gray-600 dark:text-gray-400 flex items-center gap-1">
            <i class="fa-solid fa-chalkboard-user text-purple-500"></i> Teacher:
          </span>
          <span class="font-semibold text-gray-800 dark:text-gray-200 block mt-1 text-base">
            {{ $courseOffering->teacher->name ?? 'Unassigned' }}
          </span>
        </p>

        {{-- Classroom --}}
        <p class="detail-item">
          <span class="font-medium text-gray-600 dark:text-gray-400 flex items-center gap-1">
            <i class="fa-solid fa-school text-red-500"></i> Classroom:
          </span>
          <span class="font-semibold text-gray-800 dark:text-gray-200 block mt-1 text-base">
            {{ $courseOffering->classroom->name ?? 'Unassigned' }}
          </span>
        </p>

        {{-- Schedule Type --}}
        <p class="detail-item">
          <span class="font-medium text-gray-600 dark:text-gray-400 flex items-center gap-1">
            <i class="fa-solid fa-calendar-check text-indigo-500"></i> Schedule Type:
          </span>
          <span class="font-semibold text-gray-800 dark:text-gray-200 block mt-1 text-base capitalize">
            {{ $courseOffering->schedule ?? 'N/A' }}
          </span>
        </p>

        {{-- Time Slot --}}
        <p class="detail-item">
          <span class="font-medium text-gray-600 dark:text-gray-400 flex items-center gap-1">
            <i class="fa-solid fa-clock text-orange-500"></i> Time Slot:
          </span>
          <span class="font-semibold text-gray-800 dark:text-gray-200 block mt-1 text-base capitalize">
            {{ $courseOffering->time_slot ?? 'N/A' }}
          </span>
        </p>
      </div>

      {{-- Time and Enrollment Details --}}
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 text-sm">
        {{-- Class Time --}}
        <p class="detail-item">
          <span class="font-medium text-gray-600 dark:text-gray-400 flex items-center gap-1">
            <i class="fa-solid fa-hourglass-start text-teal-500"></i> Class Time:
          </span>
          <span class="font-bold text-gray-800 dark:text-gray-200 block mt-1 text-base">
            {{ $courseOffering->start_time }} - {{ $courseOffering->end_time }}
          </span>
        </p>

        {{-- Total Credit Hours --}}
        <p class="detail-item">
          <span class="font-medium text-gray-600 dark:text-gray-400 flex items-center gap-1">
            <i class="fa-solid fa-star text-yellow-500"></i> Credit Hours:
          </span>
          <span class="font-bold text-gray-800 dark:text-gray-200 block mt-1 text-base">
            {{ $courseOffering->subject->credit_hours ?? 'N/A' }}
          </span>
        </p>

        {{-- Join Start --}}
        <p class="detail-item">
          <span class="font-medium text-gray-600 dark:text-gray-400 flex items-center gap-1">
            <i class="fa-solid fa-calendar-alt text-cyan-500"></i> Enrollment Opens:
          </span>
          <span class="font-semibold text-gray-800 dark:text-gray-200 block mt-1">
            {{ $courseOffering->join_start?->format('M d, Y') ?? 'N/A' }}
          </span>
        </p>

        {{-- Join End --}}
        <p class="detail-item">
          <span class="font-medium text-gray-600 dark:text-gray-400 flex items-center gap-1">
            <i class="fa-solid fa-calendar-times text-pink-500"></i> Enrollment Closes:
          </span>
          <span class="font-semibold text-gray-800 dark:text-gray-200 block mt-1">
            {{ $courseOffering->join_end?->format('M d, Y') ?? 'N/A' }}
          </span>
        </p>
      </div>

      {{-- Student Enrollment Section --}}
      <div class="pt-4 border-t border-gray-200 dark:border-gray-700/50">
        <span class="font-bold text-lg text-gray-700 dark:text-gray-300 flex items-center gap-2 mb-3">
          <i class="fa-solid fa-users text-blue-500"></i> Enrolled Students
          <span
            class="ml-2 px-3 py-0.5 rounded-full text-xs font-extrabold bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-300">
            Total: {{ $courseOffering->students->count() }}
          </span>
        </span>
        <div
          class="max-h-60 overflow-y-auto bg-white dark:bg-gray-700 p-3 rounded-md border border-gray-100 dark:border-gray-600">
          @if ($courseOffering->students->isNotEmpty())
            <ul class="space-y-1 text-sm text-gray-700 dark:text-gray-300">
              @foreach ($courseOffering->students as $student)
                <li
                  class="flex justify-between items-center py-1 px-2 border-b border-gray-50 dark:border-gray-600/50 hover:bg-gray-50 dark:hover:bg-gray-600/50 rounded-sm">
                  <span>{{ $student->name }} ({{ $student->id }})</span>
                  {{-- You might link to the student's detail page here --}}
                  <span class="text-xs font-mono text-gray-500 dark:text-gray-400">
                    {{ $student->email }}
                  </span>
                </li>
              @endforeach
            </ul>
          @else
            <p class="text-center text-sm italic text-gray-500 dark:text-gray-400">
              No students are currently enrolled in this course offering.
            </p>
          @endif
        </div>
      </div>

    </div>

    {{-- Action Buttons --}}
    <div class="mt-6 flex justify-end gap-3">

      <a href="{{ route('admin.course_offerings.edit', $courseOffering->id) }}"
        class="btn p-2 px-4 rounded-lg flex justify-center items-center cursor-pointer bg-yellow-500 text-white hover:bg-yellow-600 transition-colors"
        title="Edit Course Offering">
        <i class="fa-solid fa-pen-to-square mr-2"></i>
        Edit Offering
      </a>

      <form action="{{ route('admin.course_offerings.destroy', $courseOffering->id) }}" method="POST"
        onsubmit="return confirm('Are you sure you want to permanently delete this course offering? This will remove all associated student enrollments.');">
        @csrf
        @method('DELETE')
        <button type="submit"
          class="delete-btn p-2 px-4 rounded-lg flex justify-center items-center cursor-pointer bg-red-600 text-white hover:bg-red-700 transition-colors"
          title="Delete Course Offering">
          <i class="fa-regular fa-trash-can mr-2"></i>
          Delete
        </button>
      </form>
    </div>

  </div>

@endsection
