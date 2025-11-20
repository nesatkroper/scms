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

    {{-- SAVE ALL FORM --}}
    <form action="{{ route('admin.attendances.saveAll') }}" method="POST">
      @csrf
      <input type="hidden" name="course_offering_id" value="{{ $courseOffering->id }}">
      <input type="date" name="date" value="{{ $date }}" class="mb-4 border rounded px-2 py-1">

      {{-- Save All Button --}}
      <div class="flex justify-between mb-4 items-center">
        <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200">
          Attendance for:
          {{ $courseOffering?->teacher?->name }} -
          {{ $courseOffering?->classroom?->name }} -
          {{ $courseOffering?->subject?->name }}
        </h3>

        <button type="submit" class="px-5 py-2 bg-indigo-600 text-white rounded shadow hover:bg-indigo-700">
          Save All Attendance
        </button>
      </div>

      {{-- Students List --}}
      <div class="my-5 grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-4">

        @forelse($students as $student)
          @php
            $attendanceEntry = $student->attendances->first();
          @endphp

          <div class="border-b border-gray-200 dark:border-gray-700 py-2 grid grid-cols-1 md:grid-cols-4 gap-4">

            {{-- Student Info --}}
            <div class="md:col-span-2">
              <span class="font-semibold text-gray-800 dark:text-gray-200">{{ $student->name }}</span>
              <div class="text-xs text-gray-500 dark:text-gray-400">
                Student ID: {{ $student->id }}
              </div>
            </div>

            {{-- Status Select --}}
            <div class="flex flex-col">
              <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">Status</label>
              <select name="status_{{ $student->id }}"
                class="w-full border border-gray-300 dark:border-gray-600 rounded px-2 py-1 text-sm text-gray-800 dark:text-gray-100">
                <option value="present" {{ ($attendanceEntry?->status ?? '') === 'present' ? 'selected' : '' }}>Present
                </option>
                <option value="absent" {{ ($attendanceEntry?->status ?? '') === 'absent' ? 'selected' : '' }}>Absent
                </option>
                <option value="late" {{ ($attendanceEntry?->status ?? '') === 'late' ? 'selected' : '' }}>Late</option>
              </select>
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
