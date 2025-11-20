@extends('layouts.admin')

@section('title', 'Record New Score')

@section('content')

  <div class="mx-auto">
    <div
      class="box px-4 py-6 md:p-8 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">

      <div class="flex justify-between items-center mb-6 border-b pb-4 border-gray-200 dark:border-gray-700">
        <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
          {{-- Icon for Create Score --}}
          <svg class="size-8 rounded-full p-1 bg-blue-50 text-blue-600 dark:text-blue-50 dark:bg-blue-900"
            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
              clip-rule="evenodd" />
          </svg>
          Record Score for Exam: <span class="ml-1 text-blue-600 dark:text-blue-400">
            {{ $exam->name ?? 'N/A' }}
          </span>
        </h3>
        {{-- Back to Register Button --}}
        <a href="{{ route('admin.scores.index', ['exam_id' => $examId]) }}"
          class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 transition-colors">
          Back to Register
        </a>
      </div>

      {{-- Success/Error Messages (Re-added here for store validation errors) --}}
      @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
          {{ session('error') }}
        </div>
      @endif

      <form action="{{ route('admin.scores.store') }}" method="POST" class="p-0">
        @csrf

        <div class="space-y-6">

          {{-- Hidden Exam ID --}}
          <input type="hidden" name="exam_id" value="{{ $examId }}">

          {{-- Student Select Field --}}
          <div class="border-t pt-6 border-gray-200 dark:border-gray-700">
            <label for="student_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              Select Student <span class="text-red-500">*</span>
            </label>
            <select name="student_id" id="student_id" required
              class="w-full px-3 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('student_id') border-red-500 @enderror">
              <option value="" disabled selected>Choose a student</option>
              @foreach ($students as $student)
                <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                  {{ $student->name }} (ID: {{ $student->id }})
                </option>
              @endforeach
            </select>
            @error('student_id')
              <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
          </div>

          {{-- Score and Grade (2 Columns) --}}
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 border-t pt-6 border-gray-200 dark:border-gray-700">

            {{-- 1. Score Field (Input) --}}
            <div>
              <label for="score" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Raw Score (0-100) <span class="text-red-500">*</span>
              </label>
              <input type="number" step="0.01" min="0" max="100" name="score" id="score" required
                value="{{ old('score') }}" placeholder="e.g., 85.50"
                class="w-full px-3 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('score') border-red-500 @enderror">
              @error('score')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
              @enderror
            </div>

            {{-- 2. Grade Field (Select) --}}
            <div>
              <label for="grade" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Letter Grade <span class="text-red-500">*</span>
              </label>
              <select name="grade" id="grade" required
                class="w-full px-3 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('grade') border-red-500 @enderror">
                <option value="" disabled selected>Select Grade</option>
                @foreach ($grades as $grade)
                  <option value="{{ $grade }}" {{ old('grade') == $grade ? 'selected' : '' }}>
                    {{ $grade }}
                  </option>
                @endforeach
              </select>
              @error('grade')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
              @enderror
            </div>
          </div>

          {{-- 3. Remarks Field (Textarea) --}}
          <div class="border-t pt-6 border-gray-200 dark:border-gray-700">
            <label for="remarks" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              Remarks (Optional)
            </label>
            <textarea name="remarks" id="remarks" rows="5" placeholder="Any special notes or comments regarding this score."
              class="w-full border-gray-300 p-3 dark:border-gray-600 dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('remarks') border-red-500 @enderror">{{ old('remarks') }}</textarea>
            @error('remarks')
              <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
          </div>

        </div>

        {{-- Submit Button Row --}}
        <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200 dark:border-gray-700 mt-8">
          <a href="{{ route('admin.scores.index', ['exam_id' => $examId]) }}"
            class="px-4 py-2 cursor-pointer border border-red-500 hover:border-red-600 text-red-600 rounded-md flex items-center gap-2 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd"
                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                clip-rule="evenodd" />
            </svg>
            Cancel
          </a>
          <button type="submit"
            class="px-4 py-2 cursor-pointer bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 flex items-center gap-2 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd"
                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                clip-rule="evenodd" />
            </svg>
            Save Score
          </button>
        </div>
      </form>
    </div>
  </div>

@endsection
