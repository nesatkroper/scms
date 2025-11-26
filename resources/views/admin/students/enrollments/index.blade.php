@extends('layouts.admin')
@section('title', 'Courses for: ' . $student->name)
@section('content')

  <div class="mb-6 flex justify-between items-center">
    <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 flex items-center gap-2">
      <svg class="size-8 rounded-full p-1 bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
        stroke-linecap="round" stroke-linejoin="round">
        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20v2.5a2.5 2.5 0 0 1-2.5 2.5H6.5A2.5 2.5 0 0 1 4 19.5z" />
        <path d="M14 17V7a2 2 0 0 0-2-2H4" />
        <path d="M4 7V4a2 2 0 0 1 2-2h14v10" />
      </svg>
      Enrolled Courses for: {{ $student->name }}
    </h3>
    <div class="flex space-x-3">
      <a href="{{ route('admin.students.enrollments.create', $student) }}"
        class="px-4 py-2 bg-indigo-600 text-white rounded-md shadow-sm text-sm font-medium hover:bg-indigo-700 transition-colors flex items-center gap-1">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd"
            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
            clip-rule="evenodd" />
        </svg>
        Add Admission
      </a>

      <a href="{{ route('admin.students.show', $student) }}"
        class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 transition-colors flex items-center gap-1">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
          <path
            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2.586l3-3V17a1 1 0 001 1h2a1 1 0 001-1v-6.586l1.293-1.293a1 1 0 000-1.414l-7-7z" />
        </svg>
        Back to Student Details
      </a>
    </div>
  </div>

  <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
    <div class="overflow-x-auto">
      @if ($courses->isEmpty())
        <p class="text-gray-500 dark:text-gray-400 p-4">This student is not currently enrolled in any courses.</p>
      @else
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
          <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
              <th
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                Course/Subject
              </th>
              <th
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                Teacher
              </th>
              <th
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                Classroom / Schedule
              </th>
              <th
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                Enrollment Date
              </th>
              <th
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                Final Grade
              </th>
              <th class="relative px-6 py-3">
                <span class="sr-only">Actions</span>
              </th>
            </tr>
          </thead>
          <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
            @foreach ($courses as $course)
              @php
                // The course enrollment pivot data is available under the 'enrollment' alias
                $enrollment = $course->enrollment;
              @endphp
              <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                  {{ $course->subject->name ?? 'N/A Subject' }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                  {{ $course->teacher->name ?? 'Unassigned' }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                  {{ $course->classroom->name ?? 'N/A' }} ({{ $course->schedule ?? 'TBA' }})
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                  {{ $enrollment->created_at?->format('M d, Y') }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold">
                  <span
                    class="p-1 rounded text-xs
                    @if (in_array($enrollment->grade_final, ['A', 'B', 'C'])) bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100
                    @elseif (in_array($enrollment->grade_final, ['D', 'E'])) bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100
                    @elseif ($enrollment->grade_final === 'F') bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100
                    @else bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300 @endif
                  ">
                    {{ $enrollment->grade_final ?? 'Pending' }}
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                  {{-- Link to individual Course Offering show page --}}
                  {{-- <a href="{{ route('admin.courseofferings.show', $course) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">View Details</a> --}}
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>

        <div class="mt-4">
          {{ $courses->links() }}
        </div>
      @endif
    </div>
  </div>
@endsection
