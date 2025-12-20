@extends('layouts.admin')

@section('title', 'Attendance Register')

@section('content')
  <div
    class="box px-2 py-4 md:p-4 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm mb-10">

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

      <div class="flex items-center gap-3">
        <input type="date" name="date" value="{{ $date }}"
          min="{{ $courseOffering->join_start->format('Y-m-d') }}" max="{{ $courseOffering->join_end->format('Y-m-d') }}"
          class="w-64 px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500
         dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300">

        <button type="submit"
          class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700
                   dark:bg-indigo-500 dark:hover:bg-indigo-600">
          {{ __('message.go') }}
        </button>
      </div>

      {{-- Status Key --}}
      <div class="mb-4">
        <span class="text-sm text-gray-700 dark:text-gray-300 font-medium">{{ __('message.status_key') }}</span>
        <span class="inline-block px-2 py-1 bg-green-100 text-green-800 rounded text-xs font-semibold">L =
          {{ __('message.attending_(1_score)') }} </span>
        <span class="inline-block px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-xs font-semibold">P =
          {{ __('message.permission_(05_score)') }}</span>
        <span class="inline-block px-2 py-1 bg-red-100 text-red-800 rounded text-xs font-semibold">A =
          {{ __('message.absent_(0_score)') }}</span>
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
          <i class="fa-solid fa-clipboard-user"></i>
          {{ __('message.attendance_for') }}
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
              {{ __('message.back_to_course') }}
            </span>
          </a>

          @if (Auth::user()->hasPermissionTo('create_attendance'))
            <button type="submit" class="px-5 py-2 bg-indigo-600 text-white rounded shadow hover:bg-indigo-700">
              <i class="fa-regular fa-floppy-disk me-2"></i>
              {{ __('message.save_all_attendance') }}
            </button>
          @endif

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
              <div class="text-xs text-gray-500 dark:text-gray-400">{{ __('message.student_id') }} {{ $student->id }}
              </div>
            </div>

            {{-- Status Radio Buttons --}}

            <div class="flex flex-col">
              <label
                class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">{{ __('message.status') }}</label>
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
              <label
                class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">{{ __('message.remarks') }}</label>
              <input type="text" name="remarks_{{ $student->id }}" value="{{ $attendanceEntry->remarks ?? '' }}"
                class="w-full border border-gray-300 dark:border-gray-600 rounded px-2 py-1 text-sm text-gray-800 dark:text-gray-100">
            </div>
          </div>
        @empty
          <div class="p-8 text-center bg-gray-50 dark:bg-gray-700 rounded-lg shadow-inner">
            <p class="text-lg font-semibold text-gray-700 dark:text-gray-300">
              {{ __('message.no_students_found_in_this_course_offering') }}
            </p>
          </div>
        @endforelse
      </div>
    </form>

    <h3 class="mb-5 text-lg font-medium text-gray-900 dark:text-white">How much do you expect to use each month?</h3>
    <ul class="grid w-full gap-6 md:grid-cols-2">
      <li>
        <input type="radio" id="hosting-small" name="hosting" value="hosting-small" class="hidden peer" required />
        <label for="hosting-small"
          class="inline-flex items-center justify-between w-full p-5 text-body bg-neutral-primary-soft border-1 border-default rounded-base cursor-pointer peer-checked:hover:bg-brand-softer peer-checked:border-brand-subtle peer-checked:bg-brand-softer hover:bg-neutral-secondary-medium peer-checked:text-fg-brand-strong">
          <div class="block">
            <div class="w-full font-semibold">0-50 MB</div>
            <div class="w-full">Good for small websites</div>
          </div>
          <svg class="w-5 h-5 ms-3 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
            height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M19 12H5m14 0-4 4m4-4-4-4" />
          </svg>
        </label>
      </li>
      <li>
        <input type="radio" id="hosting-big" name="hosting" value="hosting-big" class="hidden peer">
        <label for="hosting-big"
          class="inline-flex items-center justify-between w-full w-full p-5 text-body bg-neutral-primary-soft border-1 border-default rounded-base cursor-pointer peer-checked:hover:bg-brand-softer peer-checked:border-brand-subtle peer-checked:bg-brand-softer hover:bg-neutral-secondary-medium peer-checked:text-fg-brand-strong">
          <div class="block">
            <div class="w-full font-semibold">500-1000 MB</div>
            <div class="w-full">Good for large websites</div>
          </div>
          <svg class="w-5 h-5 ms-3 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M19 12H5m14 0-4 4m4-4-4-4" />
          </svg>
        </label>
      </li>
    </ul>

  </div>
@endsection
