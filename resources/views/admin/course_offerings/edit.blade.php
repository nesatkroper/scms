@extends('layouts.admin')
@section('title', 'Edit Course Offering: ' . ($courseOffering->subject->name ?? 'N/A'))
@section('content')

  <div
    class="box px-4 py-6 md:p-8 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">

    <div class="flex justify-between items-center mb-6 border-b pb-4 border-gray-200 dark:border-gray-700">
      <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
        {{-- Icon for Course Offering (Pencil) --}}
        <svg class="size-8 rounded-full p-1 bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
          xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
          <path
            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zm-3.18 3.18a.5.5 0 00-.13.37l-.235 1.764 1.764-.235a.5.5 0 00.37-.13l5.5-5.5-1.764-1.764-5.5 5.5z" />
          <path fill-rule="evenodd"
            d="M5 4a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V9a1 1 0 112 0v7a4 4 0 01-4 4H5a4 4 0 01-4-4V6a4 4 0 014-4h5a1 1 0 110 2H5z"
            clip-rule="evenodd" />
        </svg>
        {{ __('message.edit_course_offering') }}<span class="ml-1 text-indigo-600 dark:text-indigo-400">
          {{ $courseOffering->subject->name ?? 'N/A' }}
        </span>
      </h3>
      <a href="{{ route('admin.course_offerings.index') }}"
        class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 transition-colors">
        {{ __('message.back_to_list') }}
      </a>
    </div>

    <form action="{{ route('admin.course_offerings.update', $courseOffering->id) }}" method="POST" id="editForm"
      class="p-0">
      @csrf
      {{-- REQUIRED: Specifies the request method as PUT for updates --}}
      @method('PUT')

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">

        {{-- Subject Select (Use ternary to ensure old() falls back to $courseOffering data) --}}
        <div>
          <label for="subject_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('message.subject') }} <span class="text-red-500">*</span>
          </label>
          <select id="subject_id" name="subject_id" required
            class="w-full px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('subject_id') border-red-500 @enderror">
            <option value="">{{ __('message.select_subject') }}</option>
            @foreach ($subjects as $subject)
              <option value="{{ $subject->id }}" @selected(old('subject_id', $courseOffering->subject_id) == $subject->id)>{{ $subject->name }}
                ({{ $subject->code ?? '' }})
              </option>
            @endforeach
          </select>
          @error('subject_id')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- Teacher Select (Use specialization from the create page for consistency) --}}
        <div>
          <label for="teacher_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('message.teacher') }} <span class="text-red-500">*</span>
          </label>
          <select id="teacher_id" name="teacher_id" required
            class="w-full px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('teacher_id') border-red-500 @enderror">
            <option value="">{{ __('message.select_teacher') }}</option>
            @foreach ($teachers as $teacher)
              <option value="{{ $teacher->id }}" @selected(old('teacher_id', $courseOffering->teacher_id) == $teacher->id)>{{ $teacher->name }}
                ({{ $teacher->specialization }})
                {{-- Added specialization field to display like the create form --}}
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
              <option value="{{ $classroom->id }}" @selected(old('classroom_id', $courseOffering->classroom_id) == $classroom->id)>{{ $classroom->name }}</option>
            @endforeach
          </select>
          @error('classroom_id')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>
      </div>

      <div
        class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6 mb-6 border-t pt-6 border-gray-200 dark:border-gray-700">

        {{-- Payment Type Select --}}
        <div>
          <label for="payment_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('message.payment_type') }} <span class="text-red-500">*</span>
          </label>

          <select id="payment_type" name="payment_type" required
            class="w-full px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500
           dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300
           @error('payment_type') border-red-500 @enderror">

            <option value="">{{ __('message.select_payment_type') }}</option>

            <option value="course" @selected(old('payment_type', $courseOffering->payment_type ?? 'course') == 'course')>
              {{ __('message.pay_full_course') }}
            </option>

            <option value="monthly" @selected(old('payment_type', $courseOffering->payment_type ?? 'course') == 'monthly')>
              {{ __('message.pay_monthly') }}
            </option>

          </select>

          @error('payment_type')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- Fee (Price) (Added consistent attributes: step, min, maxlength) --}}
        <div>
          <label for="fee" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('message.course_fee') }} (USD) <span class="text-red-500">*</span>
          </label>
          <div class="relative mt-1 rounded-md shadow-sm">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
              <span class="text-gray-500 dark:text-gray-400 sm:text-sm">$</span>
            </div>
            <input type="number" step="0.01" min="0.00" max="50" id="fee" name="fee" required
              value="{{ old('fee', $courseOffering->fee) }}"
              class="w-full pl-7 pr-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('fee') border-red-500 @enderror"
              placeholder="0.00">
          </div>
          @error('fee')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- Join Start Date (Added min/max attributes for validation consistency) --}}
        <div>
          <label for="join_start" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('message.enrollment_start_date') }}
          </label>
          <input type="date" id="join_start" name="join_start" min="2025-01-01" max="2027-12-31" {{-- Uses Carbon for proper Y-m-d format, handles null with fallback --}}
            value="{{ old('join_start', $courseOffering->join_start ? \Carbon\Carbon::parse($courseOffering->join_start)->format('Y-m-d') : null) }}"
            class="w-full px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('join_start') border-red-500 @enderror">
          @error('join_start')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- Join End Date (Added min/max attributes for validation consistency) --}}
        <div>
          <label for="join_end" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('message.enrollment_end_date') }}
          </label>
          <input type="date" id="join_end" name="join_end" min="2025-01-01" max="2027-12-31" {{-- Uses Carbon for proper Y-m-d format, handles null with fallback --}}
            value="{{ old('join_end', $courseOffering->join_end ? \Carbon\Carbon::parse($courseOffering->join_end)->format('Y-m-d') : null) }}"
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

        {{-- Time Slot (ENUM: morning, afternoon, evening) --}}
        <div>
          <label for="time_slot" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('message.time_slot_category') }} <span class="text-red-500">*</span>
          </label>
          <select id="time_slot" name="time_slot" required
            class="w-full px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('time_slot') border-red-500 @enderror">
            <option value="">{{ __('message.select_category') }}</option>
            @foreach (['morning', 'afternoon', 'evening'] as $slot)
              <option value="{{ $slot }}" @selected(old('time_slot', $courseOffering->time_slot) == $slot)>
                {{ ucfirst($slot) }}
              </option>
            @endforeach
          </select>
          @error('time_slot')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- Start Time (Added min/max attributes for validation consistency) --}}
        <div>
          <label for="start_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('message.start_time') }} <span class="text-red-500">*</span>
          </label>
          <input type="time" id="start_time" name="start_time" required min="06:00" max="21:00"
            {{-- Corrected time format to 'H:i' to work with HTML input type="time" --}}
            value="{{ old('start_time', \Carbon\Carbon::parse($courseOffering->start_time)->format('H:i')) }}"
            class="w-full px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('start_time') border-red-500 @enderror">
          @error('start_time')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- End Time (Added min/max attributes for validation consistency) --}}
        <div>
          <label for="end_time" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            {{ __('message.end_time') }} <span class="text-red-500">*</span>
          </label>
          <input type="time" id="end_time" name="end_time" required min="06:00" max="21:00"
            {{-- Corrected time format to 'H:i' to work with HTML input type="time" --}}
            value="{{ old('end_time', \Carbon\Carbon::parse($courseOffering->end_time)->format('H:i')) }}"
            class="w-full px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('end_time') border-red-500 @enderror">
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
          {{ __('message.update_offering') }}
        </button>
      </div>
    </form>
  </div>
@endsection
