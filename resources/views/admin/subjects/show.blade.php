@extends('layouts.admin')
@section('title', 'Subject Details: ' . $subject->name)
@section('content')
  <div
    class="box px-4 py-6 md:p-8 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
    <div class="flex justify-between items-center mb-6 border-b pb-4 border-gray-200 dark:border-gray-700">
      <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200">
        Subject Details: {{ $subject->name }}
      </h3>
      <a href="{{ route('admin.subjects.index') }}"
        class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 transition-colors">
        Back to List
      </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div>
        <div class="mb-4">
          <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Name</p>
          <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $subject->name }}</p>
        </div>
        <div class="mb-4">
          <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Code</p>
          <p class="mt-1 text-lg font-semibold text-indigo-600 dark:text-indigo-400">{{ $subject->code }}</p>
        </div>
        <div class="mb-4">
          <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Department</p>
          <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-gray-100">
            {{ $subject->department->name ?? 'N/A' }}
          </p>
        </div>
        <div class="mb-4">
          <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Credit Hours</p>
          <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $subject->credit_hours }}</p>
        </div>
      </div>

      <div>
        <div class="mb-4">
          <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Created At</p>
          <p class="mt-1 text-base text-gray-700 dark:text-gray-300">{{ $subject->created_at->format('M d, Y H:i A') }}
          </p>
        </div>
        <div class="mb-4">
          <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Last Updated At</p>
          <p class="mt-1 text-base text-gray-700 dark:text-gray-300">{{ $subject->updated_at->format('M d, Y H:i A') }}
          </p>
        </div>
        <div class="mb-4 md:col-span-2">
          <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Description</p>
          <div class="mt-1 p-3 bg-gray-50 dark:bg-gray-700 rounded-md border border-gray-200 dark:border-gray-600">
            <p class="text-base text-gray-700 dark:text-gray-300">
              {{ $subject->description ?? 'No description provided.' }}</p>
          </div>
        </div>
      </div>
    </div>

    <div class="mt-8 pt-4 border-t border-gray-200 dark:border-gray-700 flex justify-end gap-3">
      <a href="{{ route('admin.subjects.edit', $subject->id) }}"
        class="px-4 py-2 bg-green-600 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-green-700 transition-colors">
        Edit Subject
      </a>
    </div>
  </div>
@endsection
