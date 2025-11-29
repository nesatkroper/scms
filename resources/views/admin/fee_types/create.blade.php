@extends('layouts.admin')
@section('title', 'Create New Fee Type')
@section('content')

  <div
    class="box px-4 py-6 md:p-8 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">

    <div class="flex justify-between items-center mb-6 border-b pb-4 border-gray-200 dark:border-gray-700">
      <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg"
          class="size-8 rounded-full p-1 bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
          viewBox="0 0 20 20" fill="currentColor">
          <path
            d="M10 18a8 8 0 100-16 8 8 0 000 16zM9 9H5a1 1 0 000 2h4v4a1 1 0 002 0v-4h4a1 1 0 000-2h-4V5a1 1 0 00-2 0v4z"
            clip-rule="evenodd" />
        </svg>
        Create New Fee Type
      </h3>
      <a href="{{ route('admin.fee_types.index') }}"
        class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 transition-colors">
        Back to List
      </a>
    </div>

    @if (session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
      </div>
    @endif
    @if (session('error'))
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
      </div>
    @endif

    {{-- Form submits to the store method --}}
    <form action="{{ route('admin.fee_types.store') }}" method="POST" id="createForm" class="p-0">
      @csrf

      <div class="grid grid-cols-3 gap-4 mb-4">

        <div class="col-span-2">
          <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            Fee Type Name <span class="text-red-500">*</span>
          </label>
          <input type="text" id="name" name="name" value="{{ old('name') }}"
            class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                         dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                    @error('name') border-red-500 @else border-gray-400 @enderror"
            placeholder="e.g., Tuition Fee, Examination Fee" required>
          @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <div class="">
          <label for="amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            Fee Cost <span class="text-red-500">*</span>
          </label>
          <input type="number" id="amount" name="amount" value="{{ old('amount') }}"
            class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                         dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                    @error('amount') border-red-500 @else border-gray-400 @enderror"
            placeholder="e.g., 15.00" step="0.01" required>
          @error('amount')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

      </div>

      <div class="mb-3">
        <label class="form-label fw-bold text-gray-800 dark:text-gray-200">
          Apply Fee Type to Courses (multiple):
        </label>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3 mt-2">
          @foreach ($courseOfferings as $course)
            <div class="flex items-center space-x-2 relative">
              <div class="relative flex items-center justify-center">
                <input id="course-{{ $course->id }}" type="checkbox" name="course_offering_ids[]"
                  value="{{ $course->id }}"
                  class="peer size-5 appearance-none rounded-md cursor-pointer
                        border-2 border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800
                        transition-all duration-200
                        checked:bg-indigo-600 checked:border-indigo-600
                        hover:border-indigo-400 dark:hover:border-indigo-500
                        focus:ring-2 focus:ring-indigo-300 dark:focus:ring-indigo-700
                        focus:ring-offset-2 dark:focus:ring-offset-gray-800 relative z-10">
                <svg
                  class="pointer-events-none absolute w-4 h-4 text-white
                        opacity-0 scale-75 transition-all duration-200
                        peer-checked:opacity-100 peer-checked:scale-100 z-20"
                  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                  stroke-linejoin="round">
                  <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
              </div>
              <label for="course-{{ $course->id }}" class="cursor-pointer text-sm text-gray-900 dark:text-gray-300">
                {{ $course->subject->name }} — ({{ $course->teacher->name }})
              </label>
            </div>
          @endforeach
        </div>
      </div>

      {{-- Fee Type Description Field --}}
      <div class="mb-6">
        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
          Description
        </label>
        <textarea id="description" name="description" rows="3"
          class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                         dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300
                @error('description') border-red-500 @else border-gray-400 @enderror"
          placeholder="Briefly describe the purpose of this fee type (e.g., Annual required payment for core courses).">{{ old('description') }}</textarea>

        @error('description')
          <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
      </div>

      <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200 dark:border-gray-700">
        <a href="{{ route('admin.fee_types.index') }}"
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
              d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
              clip-rule="evenodd" />
          </svg>
          Create Fee Type
        </button>
      </div>
    </form>
  </div>
@endsection
