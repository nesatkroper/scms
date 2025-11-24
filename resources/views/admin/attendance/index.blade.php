@extends('layouts.admin')

@section('title', 'Attendance Register')

@section('content')
  <div
    class="box px-2 py-4 md:p-4 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">

    {{-- Success Message --}}
    @if (session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
        {{ session('success') }}
      </div>
    @endif

    {{-- Error Message --}}
    @if (session('error'))
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
        {{ session('error') }}
      </div>
    @endif

    {{-- Date Selector Form (GET request) --}}
    <form method="GET" action="{{ route('admin.attendances.index') }}"
      class="mb-4 flex justify-between items-center gap-4">
      <input type="hidden" name="course_offering_id" value="{{ $courseOffering->id }}">

      <input type="date" name="date" value="{{ $date }}" min="2025-01-01" max="2027-01-01"
        class="w-64 px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300"
        onchange="this.form.submit()">

      {{-- Status Key --}}
      <div class="mb-4">
        <span class="text-sm text-gray-700 dark:text-gray-300 font-medium">Status Key:</span>
        <span class="inline-block px-2 py-1 bg-green-100 text-green-800 rounded text-xs font-semibold">L =
          Attending (1 Score)</span>
        <span class="inline-block px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-xs font-semibold">P =
          Permission (0.5 Score)</span>
        <span class="inline-block px-2 py-1 bg-red-100 text-red-800 rounded text-xs font-semibold">A =
          Absent (0 Score)</span>
      </div>
    </form>

    {{-- Save All Attendance Form --}}
    <form action="{{ route('admin.attendances.saveAll') }}" method="POST">
      @csrf
      <input type="hidden" name="course_offering_id" value="{{ $courseOffering->id }}">
      <input type="hidden" name="date" value="{{ $date }}">

      {{-- Header --}}
      <div class="flex justify-between mb-4 items-center">
        <h3 class="text-lg mb-3 font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
          <svg class="size-8 p-1 rounded-full bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M16.5 6.75A.75.75 0 0 1 17.25 7.5v6A.75.75 0 0 1 16.5 15h-9a.75.75 0 0 1-.75-.75v-6A.75.75 0 0 1 7.5 6.75h9Z" />
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M13.5 10.5h-3m3 0a.75.75 0 1 1 0 1.5.75.75 0 0 1 0-1.5ZM17.25 15V7.5a.75.75 0 0 0-.75-.75h-9a.75.75 0 0 0-.75.75V15h10.5Z" />
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M3 6.75a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 6.75v10.5A2.25 2.25 0 0 1 18.75 19.5H5.25A2.25 2.25 0 0 1 3 17.25V6.75Z" />
          </svg>
          Attendance for:
          <span class="ml-1 text-indigo-600 dark:text-indigo-400 capitalize">
            {{ $courseOffering?->teacher?->name }} -
            {{ $courseOffering?->classroom?->name }} -
            {{ $courseOffering?->subject?->name }} -
            {{ $courseOffering->time_slot }}
          </span>
        </h3>

        <div class="flex gap-4">
          <a href="{{ route('admin.course_offerings.index') }}"
            class="px-5 py-2 bg-indigo-600 text-white rounded shadow hover:bg-indigo-700">
            <span class="btn-content flex items-center justify-center">
              <i class="fa-solid fa-arrow-left me-2"></i>
              Back to Course
            </span>
          </a>

          <button type="submit" class="px-5 py-2 bg-indigo-600 text-white rounded shadow hover:bg-indigo-700">
            <i class="fa-regular fa-floppy-disk me-2"></i>
            Save All Attendance
          </button>
        </div>
      </div>

      {{-- Students List --}}
      <div class="my-2 grid grid-cols-1 lg:grid-cols-2 2xl:grid-cols-4 gap-4">
        @forelse($students as $student)
          @php
            $attendanceEntry = $student->attendances->first();
            $currentStatus = $attendanceEntry?->status ?? 'absence';

          @endphp

          <div class="border-b border-gray-200 dark:border-gray-700 py-2 grid grid-cols-1 md:grid-cols-4 gap-4">
            {{-- Student Info --}}
            <div class="md:col-span-2">
              <span class="font-semibold text-gray-800 dark:text-gray-200">{{ $student->name }}</span>
              <div class="text-xs text-gray-500 dark:text-gray-400">Student ID: {{ $student->id }}</div>
            </div>

            {{-- Status Radio Buttons --}}
            <div class="flex flex-col">
              <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Status</label>
              <div class="flex gap-2">
                <label class="inline-flex items-center">
                  <input type="radio" name="status_{{ $student->id }}" value="attending"
                    {{ $currentStatus === 'attending' ? 'checked' : '' }} class="form-radio text-yellow-500">
                  <span class="ml-1 text-gray-700 dark:text-gray-200">L</span>
                </label>
                <label class="inline-flex items-center">
                  <input type="radio" name="status_{{ $student->id }}" value="permission"
                    {{ $currentStatus === 'permission' ? 'checked' : '' }} class="form-radio text-green-600">
                  <span class="ml-1 text-gray-700 dark:text-gray-200">P</span>
                </label>
                <label class="inline-flex items-center">
                  <input type="radio" name="status_{{ $student->id }}" value="absence"
                    {{ $currentStatus === 'absence' ? 'checked' : '' }} class="form-radio text-red-600">
                  <span class="ml-1 text-gray-700 dark:text-gray-200">A</span>
                </label>
              </div>
            </div>

            {{-- Remarks Input --}}
            <div class="flex flex-col">
              <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Remarks</label>
              <input type="text" name="remarks_{{ $student->id }}" value="{{ $attendanceEntry->remarks ?? '' }}"
                class="w-full border border-gray-300 dark:border-gray-600 rounded px-2 py-1 text-sm text-gray-800 dark:text-gray-100">
            </div>
          </div>
        @empty
          <div class="p-8 text-center bg-gray-50 dark:bg-gray-700 rounded-lg shadow-inner">
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-300">
              No students found in this course offering.
            </p>
          </div>
        @endforelse
      </div>
    </form>
  </div>
@endsection
