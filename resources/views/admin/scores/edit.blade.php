@extends('layouts.admin')

@section('content')
  <div class="p-4">
    <div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 sm:p-8">
      <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-6 text-center">Edit Score</h1>

      @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
          <strong class="font-bold">Error!</strong>
          <ul class="mt-2 list-disc list-inside">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('scores.update', $score->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div class="col-span-1">
            <label for="student_id"
              class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Student:</label>
            <select name="student_id" id="student_id" required
              class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:text-gray-200">
              <option value="">Select a Student</option>
              @foreach ($students as $student)
                <option value="{{ $student->id }}"
                  {{ old('student_id', $score->student_id) == $student->id ? 'selected' : '' }}>{{ $student->name }}
                </option>
              @endforeach
            </select>
            @error('student_id')
              <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
          </div>

          <div class="col-span-1">
            <label for="exam_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Exam:</label>
            <select name="exam_id" id="exam_id" required
              class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:text-gray-200">
              <option value="">Select an Exam</option>
              @foreach ($exams as $exam)
                <option value="{{ $exam->id }}" {{ old('exam_id', $score->exam_id) == $exam->id ? 'selected' : '' }}>
                  {{ $exam->name }} ({{ $exam->subject->name ?? 'N/A' }})</option>
              @endforeach
            </select>
            @error('exam_id')
              <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
          </div>

          <div class="col-span-1">
            <label for="score" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Score:</label>
            <input type="number" name="score" id="score" value="{{ old('score', $score->score) }}" required
              min="0"
              class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:text-gray-200">
            @error('score')
              <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
          </div>

          <div class="col-span-1">
            <label for="grade" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Grade
              (Optional):</label>
            <input type="text" name="grade" id="grade" value="{{ old('grade', $score->grade) }}"
              class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:text-gray-200">
            @error('grade')
              <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
          </div>

          <div class="col-span-full">
            <label for="remarks" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Remarks
              (Optional):</label>
            <textarea name="remarks" id="remarks" rows="3"
              class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:text-gray-200">{{ old('remarks', $score->remarks) }}</textarea>
            @error('remarks')
              <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
          </div>
        </div>

        <div class="mt-8 flex justify-end space-x-3">
          <a href="{{ route('scores.index') }}"
            class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 active:bg-gray-700 focus:outline-none focus:border-gray-700 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 shadow-md">
            Cancel
          </a>
          <button type="submit"
            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150 shadow-md">
            Update Score
          </button>
        </div>
      </form>
    </div>
  </div>
@endsection
