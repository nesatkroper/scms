@extends('layouts.admin')
@section('title', 'Exam Scores Management')
@section('content')

  <div class="box px-4 py-6 md:p-8 bg-white dark:bg-gray-800 sm:rounded-lg shadow-sm">
    <div class="flex justify-between items-center mb-6 border-b pb-4 border-gray-200 dark:border-gray-700">
      <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-3">
        {{-- Icon for Scores (Trophy/Certificate) --}}
        <svg class="size-9 rounded-full p-1 bg-green-50 text-green-600 dark:text-green-50 dark:bg-green-900"
          xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
          <path fill-rule="evenodd"
            d="M11.54 22.351A2.433 2.433 0 0012 22.5c.376 0 .741-.096 1.06-.289l7.632-4.572a1.425 1.425 0 00.865-1.284V8.428a1.425 1.425 0 00-.865-1.284L13.06 2.404A2.433 2.433 0 0012 2.25c-.376 0-.741.096-1.06.289L3.308 7.144A1.425 1.425 0 002.443 8.428v7.615c0 .54.27 1.047.728 1.343l8.286 5.524zM12 21.085l-7.23-4.338V8.752l7.23 4.338v7.995zM12 12.352L4.77 7.954l7.23-4.338 7.23 4.338-7.23 4.398z"
            clip-rule="evenodd" />
        </svg>
        Exam Scores
      </h3>
      <a href="{{ route('admin.scores.create') }}"
        class="px-4 py-2 bg-indigo-600 text-white rounded-md shadow-md text-sm font-medium hover:bg-indigo-700 transition-colors flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd"
            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
            clip-rule="evenodd" />
        </svg>
        Record New Score
      </a>
    </div>

    @if (session('success'))
      <div class="mb-4 p-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200"
        role="alert">
        {{ session('success') }}
      </div>
    @endif

    <div class="overflow-x-auto shadow-md sm:rounded-lg">
      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="px-6 py-3">Student</th>
            <th scope="col" class="px-6 py-3">Exam</th>
            <th scope="col" class="px-6 py-3">Course / Subject</th>
            <th scope="col" class="px-6 py-3 text-center">Semester</th>
            <th scope="col" class="px-6 py-3 text-center">Score</th>
            <th scope="col" class="px-6 py-3 text-center">Grade</th>
            <th scope="col" class="px-6 py-3">Remarks</th>
            <th scope="col" class="px-6 py-3 text-center">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($scores as $score)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
              <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                {{ $score->student->name ?? 'N/A' }}
              </th>
              <td class="px-6 py-4">
                {{ $score->exam->name ?? 'Deleted Exam' }}
              </td>
              <td class="px-6 py-4">
                {{ $score->courseOffering->subject->name ?? 'Deleted Course' }}
              </td>
              <td class="px-6 py-4 text-center">
                {{ $score->semester }}
              </td>
              <td class="px-6 py-4 text-center font-semibold text-base">
                {{ $score->score }}
              </td>
              <td class="px-6 py-4 text-center">
                <span
                  class="font-bold px-2 py-0.5 rounded-full text-xs {{ $score->grade === 'A' ? 'bg-indigo-100 text-indigo-800' : ($score->grade === 'B' ? 'bg-blue-100 text-blue-800' : ($score->grade === 'F' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800')) }}">
                  {{ $score->grade ?? '-' }}
                </span>
              </td>
              <td class="px-6 py-4 text-xs max-w-[150px] truncate">
                {{ $score->remarks ?? 'No remarks' }}
              </td>
              <td class="px-6 py-4 text-center whitespace-nowrap">
                <a href="{{ route('admin.scores.edit', $score->id) }}"
                  class="font-medium text-blue-600 dark:text-blue-500 hover:underline mr-3">Edit</a>

                <form action="{{ route('admin.scores.destroy', $score->id) }}" method="POST" class="inline delete-form"
                  onsubmit="return confirm('Are you sure you want to delete this score record?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit"
                    class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
                </form>
              </td>
            </tr>
          @empty
            <tr class="bg-white dark:bg-gray-800">
              <td colspan="8" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                No scores have been recorded yet.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{-- Pagination links --}}
    <div class="mt-6">
      {{ $scores->links() }}
    </div>
  </div>

@endsection
