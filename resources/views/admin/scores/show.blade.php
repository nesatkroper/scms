@extends('layouts.admin')

@section('content')
  <div class="p-4">
    <div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 sm:p-8">
      <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-6 text-center">Score Details</h1>

      <div class="space-y-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Score ID:</label>
          <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-gray-200">{{ $score->id }}</p>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Student Name:</label>
          <p class="mt-1 text-lg text-gray-900 dark:text-gray-200">{{ $score->student->name ?? 'N/A' }}</p>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Exam Name:</label>
          <p class="mt-1 text-lg text-gray-900 dark:text-gray-200">{{ $score->exam->name ?? 'N/A' }}</p>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Score:</label>
          <p class="mt-1 text-lg text-gray-900 dark:text-gray-200">{{ $score->score }}</p>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Grade:</label>
          <p class="mt-1 text-lg text-gray-900 dark:text-gray-200">{{ $score->grade ?? 'N/A' }}</p>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Remarks:</label>
          <p class="mt-1 text-lg text-gray-900 dark:text-gray-200">{{ $score->remarks ?? 'N/A' }}</p>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Created At:</label>
          <p class="mt-1 text-lg text-gray-900 dark:text-gray-200">{{ $score->created_at->format('M d, Y H:i A') }}</p>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Last Updated At:</label>
          <p class="mt-1 text-lg text-gray-900 dark:text-gray-200">{{ $score->updated_at->format('M d, Y H:i A') }}</p>
        </div>
      </div>

      <div class="mt-8 flex justify-end space-x-3">
        <a href="{{ route('scores.index') }}"
          class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 shadow-md">
          Back to Scores List
        </a>
        <a href="{{ route('scores.edit', $score->id) }}"
          class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150 shadow-md">
          Edit Score
        </a>
      </div>
    </div>
  </div>
@endsection
