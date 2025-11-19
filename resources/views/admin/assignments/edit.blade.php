@extends('layouts.admin')
@section('title', 'Edit Assignment')
@section('content')

  <div
    class="box px-4 py-6 md:p-8 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">

    <div class="flex justify-between items-center mb-6 border-b pb-4 border-gray-200 dark:border-gray-700">
      <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
        Edit Assignment
      </h3>
      <a href="{{ route('admin.assignments.index') }}"
        class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 transition-colors">
        Back to List
      </a>
    </div>

    <form action="{{ route('admin.assignments.update', $assignment->id) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">

        {{-- Teacher Field (Prefilled and selectable) --}}
        <div>
          <label for="teacher_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            Teacher <span class="text-red-500">*</span>
          </label>
          <select id="teacher_id" name="teacher_id" required
            class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                        @error('teacher_id') border-red-500 @else border-gray-400 @enderror">
            <option value="">Select Teacher</option>
            @foreach ($teachers as $teacher)
              <option value="{{ $teacher->id }}"
                {{ old('teacher_id', $assignment->teacher_id) == $teacher->id ? 'selected' : '' }}>
                {{ $teacher->name }}
              </option>
            @endforeach
          </select>
          @error('teacher_id')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- Subject Field (Prefilled and selectable) --}}
        <div>
          <label for="subject_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            Subject <span class="text-red-500">*</span>
          </label>
          <select id="subject_id" name="subject_id" required
            class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                        @error('subject_id') border-red-500 @else border-gray-400 @enderror">
            <option value="">Select Subject</option>
            @foreach ($subjects as $subject)
              <option value="{{ $subject->id }}"
                {{ old('subject_id', $assignment->subject_id) == $subject->id ? 'selected' : '' }}>
                {{ $subject->name }} ({{ $subject->code }})
              </option>
            @endforeach
          </select>
          @error('subject_id')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- Time Slot Field (Full Width, Prefilled) --}}
        <div class="md:col-span-2">
          <label for="time_slot" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            Time Slot <span class="text-red-500">*</span>
          </label>
          <select id="time_slot" name="time_slot" required
            class="w-full px-3 py-2 border rounded-md focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white
                        @error('time_slot') border-red-500 @else border-gray-400 @enderror">
            <option value="">Select Time Slot</option>
            @foreach ($timeSlots as $slot)
              <option value="{{ $slot }}"
                {{ old('time_slot', $assignment->time_slot) == $slot ? 'selected' : '' }}>
                {{ ucfirst($slot) }}
              </option>
            @endforeach
          </select>
          @error('time_slot')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

      </div>

      <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200 dark:border-gray-700">
        <a href="{{ route('admin.assignments.index') }}"
          class="px-4 py-2 cursor-pointer border border-red-500 hover:border-red-600 text-red-600 rounded-md flex items-center gap-2 transition-colors">
          Cancel
        </a>
        <button type="submit"
          class="px-4 py-2 cursor-pointer bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 flex items-center gap-2 transition-colors">
          Update Assignment
        </button>
      </div>
    </form>
  </div>
@endsection
