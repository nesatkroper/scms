@extends('layouts.admin')
@section('title', 'Teacher-Subject Assignments')
@section('content')

  <div
    class="box px-4 py-6 md:p-8 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
    <div class="flex justify-between items-center mb-6 border-b pb-4 border-gray-200 dark:border-gray-700">
      <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
        <svg class="size-8 p-1 rounded-full bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
          xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
          <path
            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-14h2v6h-2zm0 8h2v2h-2z" />
        </svg>
        Teacher-Subject Assignments
      </h3>

      <a href="{{ route('admin.assignments.create') }}"
        class="text-nowrap px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 cursor-pointer transition-colors flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd"
            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
            clip-rule="evenodd" />
        </svg>
        Assign New
      </a>
    </div>

    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
        <thead class="bg-gray-50 dark:bg-gray-700">
          <tr>
            <th scope="col"
              class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
              Teacher</th>
            <th scope="col"
              class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
              Subject</th>
            <th scope="col"
              class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
              Time Slot</th>
            <th scope="col"
              class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
              Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
          @forelse ($assignments as $assignment)
            <tr>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                {{ $assignment->teacher->name ?? 'N/A' }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                {{ $assignment->subject->name ?? 'N/A' }} ({{ $assignment->subject->code ?? '' }})
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-indigo-600 dark:text-indigo-400">
                {{ ucfirst($assignment->time_slot) }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex justify-end gap-2">

                {{-- Edit Link --}}
                <a href="{{ route('admin.assignments.edit', [$assignment->teacher_id, $assignment->subject_id]) }}"
                  class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 transition-colors"
                  title="Edit Assignment">
                  <!-- svg icon -->
                </a>

                {{-- Delete Form --}}
                <form
                  action="{{ route('admin.assignments.destroy', [$assignment->teacher_id, $assignment->subject_id]) }}"
                  method="POST" onsubmit="return confirm('Are you sure you want to remove this assignment?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit"
                    class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 transition-colors"
                    title="Delete Assignment">
                    <!-- svg icon -->
                  </button>
                </form>

              </td>
            </tr>
          @empty
            <tr>
              <td colspan="4" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                No subject assignments found.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{-- Pagination --}}
    @if ($assignments->hasPages())
      <div class="mt-4">
        {{ $assignments->links() }}
      </div>
    @endif
  </div>
@endsection
