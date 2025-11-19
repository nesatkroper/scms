@extends('layouts.admin')
@section('title', 'Record New Exam Score')

@php
  $showScoreTable = $students->isNotEmpty();
  $selectedExamId = $selectedExamId ?? old('exam_id');
  $selectedCourseOfferingId = $selectedCourseOfferingId ?? old('course_offering_id');
  $selectedSemester = $selectedSemester ?? old('semester');
@endphp

@section('content')

  <div
    class="box px-4 py-6 md:p-8 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">

    <div class="flex justify-between items-center mb-6 border-b pb-4 border-gray-200 dark:border-gray-700">
      <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
        <svg class="size-8 rounded-full p-1 bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
          xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd"
            d="M5 4a3 3 0 00-3 3v6a3 3 0 003 3h10a3 3 0 003-3V7a3 3 0 00-3-3H5zm.5 2a.5.5 0 00-.5.5v7a.5.5 0 00.5.5h9a.5.5 0 00.5-.5v-7a.5.5 0 00-.5-.5h-9zM10 9a1 1 0 011 1v1h1a1 1 0 110 2h-2a1 1 0 110-2h1V9a1 1 0 01-1-1 1 1 0 011-1z"
            clip-rule="evenodd" />
        </svg>
        Batch Record Exam Scores
      </h3>
      <a href="{{ route('admin.scores.index') }}"
        class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 transition-colors">
        Back to Scores List
      </a>
    </div>

    <form action="{{ route('admin.scores.filterStudents') }}" method="GET" class="p-0 mb-8" id="filter-form">
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

        <div>
          <label for="exam_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            Exam <span class="text-red-500">*</span>
          </label>
          <select id="exam_id" name="exam_id" required
            class="w-full px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('exam_id') border-red-500 @enderror">
            <option value="">Select Exam</option>
            @foreach ($exams as $exam)
              <option value="{{ $exam->id }}" @selected($selectedExamId == $exam->id)>
                {{ $exam->name }}
              </option>
            @endforeach
          </select>
          @error('exam_id')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="course_offering_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            Course Offering <span class="text-red-500">*</span>
          </label>
          <select id="course_offering_id" name="course_offering_id" required
            class="w-full px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('course_offering_id') border-red-500 @enderror">
            <option value="">Select Course Offering</option>
            @foreach ($courseOfferings as $offering)
              <option value="{{ $offering->id }}" @selected($selectedCourseOfferingId == $offering->id)>
                {{ $offering->subject->name ?? 'N/A Subject' }} - {{ $offering->teacher->name ?? 'Unassigned' }}
              </option>
            @endforeach
          </select>
          @error('course_offering_id')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="semester" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            Semester <span class="text-red-500">*</span>
          </label>
          <select id="semester" name="semester" required
            class="w-full px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('semester') border-red-500 @enderror">
            <option value="">Select Semester</option>
            @foreach ($semesters as $sem)
              <option value="{{ $sem }}" @selected($selectedSemester == $sem)>
                {{ $sem }}
              </option>
            @endforeach
          </select>
          @error('semester')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <div class="self-end">
          <button type="submit"
            class="w-full px-4 py-2 cursor-pointer bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 flex items-center justify-center gap-2 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path
                d="M5.5 3.5a1 1 0 00-1 1v12a1 1 0 001 1h9a1 1 0 001-1v-12a1 1 0 00-1-1h-9zM5 4.5h9v11H5v-11zm5 1a.5.5 0 01.5.5v3a.5.5 0 01-.5.5h-2a.5.5 0 01-.5-.5v-3a.5.5 0 01.5-.5h2z" />
            </svg>
            Filter Students
          </button>
        </div>

      </div>
    </form>

    <hr class="my-6 border-gray-200 dark:border-gray-700">

    @if ($showScoreTable)
      <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">
        Students for Score Entry 📝
      </h4>
      <div
        class="p-4 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-700 rounded-md mb-6 text-sm text-yellow-800 dark:text-yellow-300">
        <p class="font-medium">Selected Criteria:</p>
        <p><strong>Exam:</strong> {{ $exams->firstWhere('id', $selectedExamId)->name ?? 'N/A' }}</p>
        @php
          $offering = $courseOfferings->firstWhere('id', $selectedCourseOfferingId);
        @endphp
        <p><strong>Course Offering:</strong> {{ $offering->subject->name ?? 'N/A' }}
          ({{ $offering->teacher->name ?? 'Unassigned' }})</p>
        <p><strong>Semester:</strong> {{ $selectedSemester ?? 'N/A' }}</p>
      </div>

      <form action="{{ route('admin.scores.store') }}" method="POST" class="p-0">
        @csrf

        <input type="hidden" name="exam_id" value="{{ $selectedExamId }}">
        <input type="hidden" name="course_offering_id" value="{{ $selectedCourseOfferingId }}">
        <input type="hidden" name="semester" value="{{ $selectedSemester }}">

        <div class="overflow-x-auto shadow-md sm:rounded-lg">
          <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
              <tr>
                <th scope="col" class="px-6 py-3">Student Name</th>
                <th scope="col" class="px-6 py-3 w-32">Score</th>
                <th scope="col" class="px-6 py-3 w-28">Grade</th>
                <th scope="col" class="px-6 py-3">Remarks</th>
                <th scope="col" class="px-6 py-3 w-28 text-center">Status</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($students as $index => $student)
                <tr
                  class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                  <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $student->name ?? 'User ID: ' . $student->id }}
                    <input type="hidden" name="scores[{{ $index }}][student_id]" value="{{ $student->id }}">
                  </th>
                  <td class="px-6 py-4">
                    <input type="number" name="scores[{{ $index }}][score]"
                      value="{{ old('scores.' . $index . '.score') }}" min="0" step="0.01"
                      class="w-full p-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                      placeholder="Score">
                  </td>
                  <td class="px-6 py-4">
                    <input type="text" name="scores[{{ $index }}][grade]"
                      value="{{ old('scores.' . $index . '.grade') }}" maxlength="10"
                      class="w-full p-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                      placeholder="Grade">
                  </td>
                  <td class="px-6 py-4">
                    <input type="text" name="scores[{{ $index }}][remarks]"
                      value="{{ old('scores.' . $index . '.remarks') }}" maxlength="500"
                      class="w-full p-2 border rounded-md dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                      placeholder="Remarks">
                  </td>
                  <td class="px-6 py-4 text-center">
                    @if ($student->score_recorded)
                      <span
                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100">
                        Recorded (Update)
                      </span>
                    @else
                      <span
                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100">
                        New Score
                      </span>
                    @endif
                  </td>
                </tr>
              @empty
                <tr class="bg-white dark:bg-gray-800">
                  <td colspan="5" class="px-6 py-4 text-center">No students found for this course offering.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        @if ($students->isNotEmpty())
          <div class="flex justify-end space-x-3 pt-4 mt-6 border-t border-gray-200 dark:border-gray-700">
            <a href="{{ route('admin.scores.create') }}"
              class="px-4 py-2 cursor-pointer border border-gray-300 hover:border-gray-400 text-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:border-gray-500 rounded-md flex items-center gap-2 transition-colors">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path
                  d="M10 2a8 8 0 100 16 8 8 0 000-16zM8.707 9.293a1 1 0 00-1.414 1.414L9.586 12l-2.293 2.293a1 1 0 001.414 1.414L11 13.414l2.293 2.293a1 1 0 001.414-1.414L12.414 12l2.293-2.293a1 1 0 00-1.414-1.414L10 10.586 8.707 9.293z" />
              </svg>
              Clear Filter / Start New
            </a>
            <button type="submit"
              class="px-4 py-2 cursor-pointer bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 flex items-center gap-2 transition-colors">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                  d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                  clip-rule="evenodd" />
              </svg>
              Save All Scores
            </button>
          </div>
        @endif
      </form>
    @else
      <p class="text-center py-10 text-gray-500 dark:text-gray-400">
        👆 Please select an **Exam**, **Course Offering**, and **Semester** above and click **Filter Students** to begin
        entering scores.
      </p>
    @endif
  </div>
@endsection
