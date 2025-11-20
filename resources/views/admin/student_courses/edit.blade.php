@extends('layouts.admin')
@section('title', 'Edit Enrollment')

@php
  // Helper to get Subject/Code for title
  $subject = $studentCourse->courseOffering->subject;
  $courseTitle =
      ($subject ? "{$subject->code} - {$subject->name}" : 'N/A') .
      ' (' .
      $studentCourse->courseOffering->time_slot .
      ')';
@endphp

@section('content')

  <div
    class="box px-4 py-6 md:p-8 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm max-w-4xl mx-auto">

    <div class="flex justify-between items-center mb-6 border-b pb-4 border-gray-200 dark:border-gray-700">
      <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
        <svg class="size-8 rounded-full p-1 bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
          xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-3-6h-3a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 007.5 21h4.5m-9-10.5h10.5m-10.5 0h10.5m-10.5 0v10.5A2.25 2.25 0 005.25 21h4.5m-9-10.5v10.5A2.25 2.25 0 005.25 21h4.5m-9-10.5v10.5A2.25 2.25 0 005.25 21h4.5" />
        </svg>
        Edit Enrollment
      </h3>
      <a href="{{ route('admin.student_courses.index') }}"
        class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 transition-colors">
        Back to Enrollments
      </a>
    </div>

    <div class="mb-4 p-4 rounded-lg bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600">
      <p class="text-sm font-semibold text-gray-700 dark:text-gray-300">
        <span class="text-indigo-600 dark:text-indigo-400">Student:</span> {{ $studentCourse->student->name }}
      </p>
      <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mt-1">
        <span class="text-indigo-600 dark:text-indigo-400">Course:</span> {{ $courseTitle }}
      </p>
    </div>

    <form action="{{ route('admin.student_courses.update', $studentCourse->id) }}" method="POST" class="p-0">
      @csrf
      @method('PUT')

      {{-- Include hidden fields for fixed IDs, required by StudentCourseRequest validation --}}
      <input type="hidden" name="student_id" value="{{ $studentCourse->student_id }}">
      <input type="hidden" name="course_offering_id" value="{{ $studentCourse->course_offering_id }}">

      <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-6">

        {{-- Final Grade --}}
        <div>
          <label for="grade_final" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            Final Grade (0-100)
          </label>
          <input type="number" id="grade_final" name="grade_final"
            value="{{ old('grade_final', $studentCourse->grade_final ?? '') }}" min="0" max="100"
            step="0.01"
            class="w-full px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('grade_final') border-red-500 @enderror"
            placeholder="e.g., 85.5">
          @error('grade_final')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- Student Status --}}
        <div>
          <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            Enrollment Status <span class="text-red-500">*</span>
          </label>
          <select id="status" name="status" required
            class="w-full px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('status') border-red-500 @enderror">
            <option value="">Select Status</option>
            @foreach ($statuses as $s)
              <option value="{{ $s }}" @selected(old('status', $studentCourse->status) == $s)>
                {{ ucfirst($s) }}
              </option>
            @endforeach
          </select>
          @error('status')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- Payment Status --}}
        <div>
          <label for="payment_status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            Payment Status <span class="text-red-500">*</span>
          </label>
          <select id="payment_status" name="payment_status" required
            class="w-full px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('payment_status') border-red-500 @enderror">
            <option value="">Select Payment Status</option>
            @foreach ($paymentStatuses as $ps)
              <option value="{{ $ps }}" @selected(old('payment_status', $studentCourse->payment_status) == $ps)>
                {{ ucfirst($ps) }}
              </option>
            @endforeach
          </select>
          @error('payment_status')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>
      </div>

      <div class="mb-6">
        {{-- Remarks (Textarea) --}}
        <label for="remarks" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
          Remarks (Optional)
        </label>
        <textarea id="remarks" name="remarks" rows="3"
          class="w-full px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('remarks') border-red-500 @enderror"
          placeholder="Notes on student performance, withdrawal reason, etc.">{{ old('remarks', $studentCourse->remarks ?? '') }}</textarea>
        @error('remarks')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200 dark:border-gray-700">
        <a href="{{ route('admin.student_courses.index') }}"
          class="px-4 py-2 cursor-pointer border border-red-500 hover:border-red-600 text-red-600 rounded-md flex items-center gap-2 transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
              clip-rule="evenodd" />
          </svg>
          Cancel
        </a>
        <button type="submit"
          class="px-4 py-2 cursor-pointer bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 flex items-center gap-2 transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
              clip-rule="evenodd" />
          </svg>
          Update Enrollment
        </button>
      </div>
    </form>

  </div>
@endsection
