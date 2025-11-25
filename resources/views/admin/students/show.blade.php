@extends('layouts.admin')
@section('title', 'Student Details: ' . $student->name)
@section('content')

  <div class="mb-6 flex justify-between items-center">
    <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 flex items-center gap-2">
      <svg class="size-8 rounded-full p-1 bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
        stroke-linecap="round" stroke-linejoin="round">
        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
        <circle cx="8.5" cy="7" r="4"></circle>
        <polyline points="17 11 19 13 23 9"></polyline>
      </svg>
      {{ $student->name }} Details
    </h3>
    <div class="flex space-x-3">
      <a href="{{ route('admin.students.edit', $student) }}"
        class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 transition-colors flex items-center gap-1">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
          <path
            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zm-7.5 7.5a1 1 0 001.414 0l.707-.707.707.707a1 1 0 001.414 0l.707-.707.707.707a1 1 0 001.414 0l.707-.707.707.707a1 1 0 001.414 0l.707-.707.707.707a1 1 0 001.414 0L17 7.414V17a1 1 0 01-1 1H4a1 1 0 01-1-1V7a1 1 0 011-1h6.586l-1-1H4z" />
        </svg>
        Edit
      </a>
      <a href="{{ route('admin.students.index') }}"
        class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 transition-colors flex items-center gap-1">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
          <path
            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2.586l3-3V17a1 1 0 001 1h2a1 1 0 001-1v-6.586l1.293-1.293a1 1 0 000-1.414l-7-7z" />
        </svg>
        Back to List
      </a>
    </div>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    {{-- Left Column: Profile and Stats --}}
    <div class="lg:col-span-1">
      <div
        class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 text-center">
        <div class="mb-4">
          <img
            src="{{ $student->avatar ? Storage::url($student->avatar) : 'https://placehold.co/100x100/d1d5db/4b5563?text=S' }}"
            alt="{{ $student->name }}"
            class="size-28 mx-auto rounded-full object-cover border-4 border-indigo-200 dark:border-indigo-700 shadow-md">
        </div>
        <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ $student->name }}</h2>
        <p class="text-sm text-indigo-600 dark:text-indigo-400 font-medium">{{ $student->email }}</p>

        <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
          <h3 class="text-md font-semibold text-gray-700 dark:text-gray-300 mb-2">Student Metrics</h3>
          <div class="flex justify-around text-center">
            {{-- Assuming your controller loaded counts (e.g., withCount(['fees', 'attendances'])) --}}
            <div class="p-2">
              <div class="text-xl font-bold text-indigo-600 dark:text-indigo-400">
                {{ $student->fees_count ?? 0 }}
              </div>
              <div class="text-xs text-gray-500 dark:text-gray-400">Fee Records</div>
            </div>
            <div class="p-2">
              <div class="text-xl font-bold text-indigo-600 dark:text-indigo-400">
                {{ $student->attendances_count ?? 0 }}
              </div>
              <div class="text-xs text-gray-500 dark:text-gray-400">Attendance</div>
            </div>
          </div>
        </div>
      </div>

      {{-- Delete Button Card --}}
      <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 mt-6">
        <h3 class="text-md font-semibold text-red-600 dark:text-red-400 mb-3">Danger Zone</h3>
        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
          Permanently delete this student and all associated records. This action cannot be undone.
        </p>
        <form action="{{ route('admin.students.destroy', $student) }}" method="POST"
          onsubmit="return confirm('Are you sure you want to delete this student: {{ $student->name }}?');">
          @csrf
          @method('DELETE')
          <button type="submit"
            class="w-full px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700 transition-colors">
            Delete Student
          </button>
        </form>
      </div>

    </div>

    {{-- Right Column: Detailed Information --}}
    <div class="lg:col-span-2">
      <div
        class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 divide-y divide-gray-200 dark:divide-gray-700">
        <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4 pb-4">Personal & Contact Info</h3>

        {{-- Details Grid --}}
        <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4 pt-4">

          {{-- General Info --}}
          @include('admin.components.detail-item', [
              'label' => 'Gender',
              'value' => $student->gender ?? 'N/A',
          ])
          @include('admin.components.detail-item', [
              'label' => 'Date of Birth',
              'value' => $student->date_of_birth
                  ? \Carbon\Carbon::parse($student->date_of_birth)->format('M d, Y')
                  : 'N/A',
          ])
          @include('admin.components.detail-item', [
              'label' => 'Phone',
              'value' => $student->phone ?? 'N/A',
          ])
          @include('admin.components.detail-item', [
              'label' => 'Blood Group',
              'value' => $student->blood_group ?? 'N/A',
          ])

          {{-- Admission/Status Info --}}
          @include('admin.components.detail-item', [
              'label' => 'Admission Date',
              'value' => $student->admission_date
                  ? \Carbon\Carbon::parse($student->admission_date)->format('M d, Y')
                  : 'N/A',
          ])
          @include('admin.components.detail-item', [
              'label' => 'Account Created',
              'value' => \Carbon\Carbon::parse($student->created_at)->format('M d, Y'),
          ])
          @include('admin.components.detail-item', [
              'label' => 'Nationality',
              'value' => $student->nationality ?? 'N/A',
          ])
          @include('admin.components.detail-item', [
              'label' => 'Religion',
              'value' => $student->religion ?? 'N/A',
          ])

          {{-- Work/Address Info (Full Width) --}}
          @if ($student->occupation || $student->company)
            <div class="sm:col-span-2">
              <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Occupation / Company</dt>
              <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                @if ($student->occupation)
                  {{ $student->occupation }}
                @endif
                @if ($student->company)
                  @if ($student->occupation)
                    at
                  @endif
                  {{ $student->company }}
                @endif
                @if (!$student->occupation && !$student->company)
                  N/A
                @endif
              </dd>
            </div>
          @endif
          <div class="sm:col-span-2">
            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Address</dt>
            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $student->address ?? 'N/A' }}</dd>
          </div>
        </dl>
      </div>

      {{-- You can add sections here for Fees, Attendance, Assigned Courses, etc. --}}
      {{-- Example placeholder --}}
      <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 mt-6">
        <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Assigned Courses</h3>
        <p class="text-gray-500 dark:text-gray-400">
          *Course list integration would go here (e.g., using a table or list of courses related to the student).*
        </p>
      </div>
    </div>
  </div>

  {{-- Simple Blade Component for reusability (optional but good practice) --}}
  <script>
    // This is a placeholder for the component definition which would normally be in views/components/detail-item.blade.php
    // Since we can only provide full files, I'll place the logic here.
  </script>
@endsection
