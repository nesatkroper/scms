@extends('layouts.admin')

@section('title', 'Edit Score for ' . ($exam->name ?? 'N/A'))

@section('content')

  <div class="mx-auto">
    <div
      class="box px-4 py-6 md:p-8 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">

      @php
        $examName = $exam->name ?? 'Exam';
        $examId = $exam->id;
      @endphp

      <div class="flex justify-between items-center mb-6 border-b pb-4 border-gray-200 dark:border-gray-700">
        <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
          {{-- Icon for Edit Score --}}
          <svg class="size-8 rounded-full p-1 bg-green-50 text-green-600 dark:text-green-50 dark:bg-green-900"
            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
            <path fill-rule="evenodd"
              d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
              clip-rule="evenodd" />
          </svg>
          Edit Score for <span class="ml-1 text-green-600 dark:text-green-400">
            {{ $examName }} - {{ $student->name }}
          </span>
        </h3>
        {{-- Back to Register Button --}}
        <a href="{{ route('admin.scores.index', ['exam_id' => $examId]) }}"
          class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 transition-colors">
          Back to Register
        </a>
      </div>

      {{-- Form action uses the pivot keys (student_id, exam_id) --}}
      <form
        action="{{ route('admin.scores.update', [
            'student_id' => $score->student_id,
            'exam_id' => $examId,
        ]) }}"
        method="POST" class="p-0">

        @csrf
        @method('PUT')

        <div class="space-y-6">

          {{-- Hidden Fields for Pivot Keys --}}
          <input type="hidden" name="student_id" value="{{ $score->student_id }}">
          <input type="hidden" name="exam_id" value="{{ $examId }}">

          {{-- Student and Exam Info (Read-Only) --}}
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-6 border-t border-gray-200 dark:border-gray-700">
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Student</label>
              <p class="p-2 bg-gray-100 dark:bg-gray-700/50 rounded-md text-gray-800 dark:text-gray-200 font-semibold">
                {{ $student->name }}
              </p>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Exam</label>
              <p class="p-2 bg-gray-100 dark:bg-gray-700/50 rounded-md text-gray-800 dark:text-gray-200 font-semibold">
                {{ $exam->name }}
              </p>
            </div>
          </div>

          {{-- Score and Grade (2 Columns) --}}
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 border-t pt-6 border-gray-200 dark:border-gray-700">

            {{-- 1. Score Field (Input) --}}
            <div>
              <label for="score" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Raw Score (0-100) <span class="text-red-500">*</span>
              </label>
              <input type="number" step="0.01" min="0" max="100" name="score" id="score" required
                value="{{ old('score', $score->score) }}" placeholder="e.g., 85.50"
                class="w-full px-3 py-2 border rounded-md focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('score') border-red-500 @enderror">
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
                class="w-full px-3 py-2 border rounded-md focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('grade') border-red-500 @enderror">
                <option value="" disabled>Select Grade</option>
                @foreach ($grades as $gradeOption)
                  <option value="{{ $gradeOption }}"
                    {{ old('grade', $score->grade) == $gradeOption ? 'selected' : '' }}>
                    {{ $gradeOption }}
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
              class="w-full border-gray-300 p-3 dark:border-gray-600 dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-md shadow-sm focus:border-green-500 focus:ring-green-500 @error('remarks') border-red-500 @enderror">{{ old('remarks', $score->remarks) }}</textarea>
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
            class="px-4 py-2 cursor-pointer bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 flex items-center gap-2 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd"
                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                clip-rule="evenodd" />
            </svg>
            Update Score
          </button>
        </div>
      </form>
    </div>
  </div>

@endsection
