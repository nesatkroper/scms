@extends('layouts.admin')
@section('title', 'Enroll Student: ' . $student->name)
@section('content')

  <div class="mb-6 flex justify-between items-center">
    <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 flex items-center gap-2">
      <svg class="size-8 rounded-full p-1 bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
        stroke-linecap="round" stroke-linejoin="round">
        <path d="M12 20h0v-4a4 4 0 0 0-4-4H4a4 4 0 0 0-4 4v4h24v-4a4 4 0 0 0-4-4H12z" />
        <circle cx="12" cy="7" r="4" />
      </svg>
      Enroll **{{ $student->name }}** in a Course
    </h3>
  </div>

  <div
    class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 max-w-2xl mx-auto">

    <form action="{{ route('admin.students.enrollments.store', $student) }}" method="POST">
      @csrf

      <div class="space-y-6">

        {{-- Course Offering Selection --}}
        <div>
          <label for="course_offering_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
            Select Course Offering
          </label>
          <select id="course_offering_id" name="course_offering_id" required
            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
            <option value="">-- Choose a course --</option>
            @foreach ($availableCourses as $course)
              <option value="{{ $course->id }}" {{ old('course_offering_id') == $course->id ? 'selected' : '' }}>
                {{ $course->subject->name ?? 'N/A Subject' }} - Teacher: {{ $course->teacher->name ?? 'N/A' }}
                (Fee: ${{ number_format($course->fee, 0) }})
              </option>
            @endforeach
          </select>
          @error('course_offering_id')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- Enrollment Status --}}
        <div>
          <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
            Enrollment Status
          </label>
          <select id="status" name="status" required
            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
            @foreach (['active', 'completed', 'dropped'] as $s)
              <option value="{{ $s }}" {{ old('status', 'active') == $s ? 'selected' : '' }}>
                {{ ucfirst($s) }}
              </option>
            @endforeach
          </select>
          @error('status')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- Payment Status --}}
        <div>
          <label for="payment_status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
            Payment Status
          </label>
          <select id="payment_status" name="payment_status" required
            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
            @foreach (['paid', 'pending', 'waived'] as $p)
              <option value="{{ $p }}" {{ old('payment_status', 'pending') == $p ? 'selected' : '' }}>
                {{ ucfirst($p) }}
              </option>
            @endforeach
          </select>
          @error('payment_status')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- Final Grade (optional at creation) --}}
        <div>
          <label for="grade_final" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
            Initial Grade (Optional)
          </label>
          <input type="text" name="grade_final" id="grade_final" value="{{ old('grade_final') }}" maxlength="5"
            class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">
          @error('grade_final')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- Remarks --}}
        <div>
          <label for="remarks" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
            Remarks (Optional)
          </label>
          <textarea name="remarks" id="remarks" rows="3"
            class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100">{{ old('remarks') }}</textarea>
          @error('remarks')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>
      </div>

      <div class="mt-8 flex justify-end space-x-3">
        <a href="{{ route('admin.students.courses.index', $student) }}"
          class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 transition-colors">
          Cancel
        </a>
        <button type="submit"
          class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700 transition-colors">
          Confirm Enrollment
        </button>
      </div>
    </form>
  </div>
@endsection
