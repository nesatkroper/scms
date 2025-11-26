@extends('layouts.admin')
@section('title', 'Create New Course Offering')
@section('content')

  <div
    class="box px-4 py-6 md:p-8 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">

    <div class="flex justify-between items-center mb-6 border-b pb-4 border-gray-200 dark:border-gray-700">
      <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
        {{-- Icon for Course Offering (Calendar) --}}
        <svg class="size-8 rounded-full p-1 bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
          xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
          stroke-linecap="round" stroke-linejoin="round">
          <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
          <line x1="16" y1="2" x2="16" y2="6"></line>
          <line x1="8" y1="2" x2="8" y2="6"></line>
          <line x1="3" y1="10" x2="21" y2="10"></line>
        </svg>
        {{ __('message.create_new_course_offering') }}
      </h3>
      <a href="{{ route('admin.course_offerings.index') }}"
        class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 transition-colors">
        {{ __('message.back_to_list') }}
      </a>
    </div>

    <form action="{{ route('admin.course_offerings.store') }}" method="POST" id="createForm" class="p-0">
      @csrf

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">

        {{-- Subject Select --}}
        <div>
          <label for="subject_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('message.subject') }} <span class="text-red-500">*</span>
          </label>
          <select id="subject_id" name="subject_id" required
            class="w-full px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('subject_id') border-red-500 @enderror">
            <option value="">{{ __('message.select_subject') }}</option>
            @foreach ($subjects as $subject)
              <option value="{{ $subject->id }}" @selected(old('subject_id') == $subject->id)>{{ $subject->name }}
                ({{ $subject->code ?? '' }})
              </option>
            @endforeach
          </select>
          @error('subject_id')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- Teacher Select (Assuming User Model) --}}
        <div>
          <label for="teacher_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('message.teacher') }} <span class="text-red-500">*</span>
          </label>
          <select id="teacher_id" name="teacher_id" required
            class="w-full px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('teacher_id') border-red-500 @enderror">
            <option value="">{{ __('message.select_teacher') }}</option>
            @foreach ($teachers as $teacher)
              <option value="{{ $teacher->id }}" @selected(old('teacher_id') == $teacher->id)>{{ $teacher->name }}
                ({{ $teacher->specialization }})
              </option>
            @endforeach
          </select>
          @error('teacher_id')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- Classroom Select --}}
        <div>
          <label for="classroom_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('message.classroom') }} <span class="text-red-500">*</span>
          </label>
          <select id="classroom_id" name="classroom_id" required
            class="w-full px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('classroom_id') border-red-500 @enderror">
            <option value="">{{ __('message.select_classroom') }}</option>
            @foreach ($classrooms as $classroom)
              <option value="{{ $classroom->id }}" @selected(old('classroom_id') == $classroom->id)>{{ $classroom->name }}</option>
            @endforeach
          </select>
          @error('classroom_id')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>
      </div>
      <div
        class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6 border-t pt-6 border-gray-200 dark:border-gray-700">
        {{-- Fee (Price) --}}
        <div>
          <label for="fee" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('message.course_fee') }} (USD) <span class="text-red-500">*</span>
          </label>
          <div class="relative mt-1 rounded-md shadow-sm">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
              <span class="text-gray-500 dark:text-gray-400 sm:text-sm">$</span>
            </div>
            <input type="type" step="0.01" min="0.00" max="50" maxlength="2" id="fee"
              oninput="this.value = this.value.replace(/[^0-9]/g, '')" name="fee" value="{{ old('fee') }}"
              class="w-full pl-7 pr-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('fee') border-red-500 @enderror"
              placeholder="0.00" required>
          </div>
          @error('fee')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- Join Start Date --}}
        <div>
          <label for="join_start" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('message.enrollment_start_date') }}
          </label>
          <input type="date" id="join_start" name="join_start" value="{{ old('join_start') ?? '2025-01-01' }}"
            min="2025-01-01" max="2027-12-31"
            class="w-full px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('join_start') border-red-500 @enderror">
          @error('join_start')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- Join End Date --}}
        <div>
          <label for="join_end" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('message.enrollment_end_date') }}
          </label>
          <input type="date" id="join_end" name="join_end" value="{{ old('join_end') ?? '2025-01-01' }}"
            min="2025-01-01" max="2027-12-31"
            class="w-full px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('join_end') border-red-500 @enderror">
          @error('join_end')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>
      </div>

      <div
        class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-6 border-t pt-6 border-gray-200 dark:border-gray-700">
        <div>
          <label for="schedule" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('message.schedule') }} <span class="text-red-500">*</span>
          </label>
          <select id="schedule" name="schedule" required
            class="w-full px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            <option value="">{{ __('message.select_schedule') }}</option>
            @foreach (['mon-wed', 'mon-fri', 'wed-fri', 'sat-sun'] as $sch)
              <option value="{{ $sch }}" @selected(old('schedule') == $sch)>
                {{ strtoupper($sch) }}
              </option>
            @endforeach
          </select>
          @error('schedule')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- Time Slot (e.g., Mon/Wed 10:00) --}}
        <div>
          <label for="time_slot" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('message.time_slot_category') }} <span class="text-red-500">*</span>
          </label>
          <select id="time_slot" name="time_slot" required
            class="w-full px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('time_slot') border-red-500 @enderror">
            <option value="">{{ __('message.select_category') }}</option>
            @foreach (['morning', 'afternoon', 'evening'] as $slot)
              <option value="{{ $slot }}">
                {{ ucfirst($slot) }}
              </option>
            @endforeach
          </select>
          @error('time_slot')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- Start Time --}}
        <div>
          <label for="start_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('message.start_time') }} <span class="text-red-500">*</span>
          </label>
          <input type="time" id="start_time" name="start_time" value="{{ old('start_time') ?? '06:00' }}"
            min="06:00" max="21:00"
            class="w-full px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('start_time') border-red-500 @enderror"
            required>
          @error('start_time')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- End Time --}}
        <div>
          <label for="end_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('message.end_time') }} <span class="text-red-500">*</span>
          </label>
          <input type="time" id="end_time" name="end_time" value="{{ old('end_time') ?? '06:00' }}"
            min="06:00" max="21:00"
            class="w-full px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('end_time') border-red-500 @enderror"
            required>
          @error('end_time')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

      </div>

      <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200 dark:border-gray-700">
        <a href="{{ route('admin.course_offerings.index') }}"
          class="px-4 py-2 cursor-pointer border border-red-500 hover:border-red-600 text-red-600 rounded-md flex items-center gap-2 transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
              clip-rule="evenodd" />
          </svg>
          {{ __('message.cancel') }}
        </a>
        <button type="submit"
          class="px-4 py-2 cursor-pointer bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 flex items-center gap-2 transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
              clip-rule="evenodd" />
          </svg>
          {{ __('message.create_offering') }}
        </button>
      </div>
    </form>
  </div>
@endsection
