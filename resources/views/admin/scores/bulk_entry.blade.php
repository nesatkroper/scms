@extends('layouts.admin')
@section('title', 'Bulk Score Entry')
@section('content')

  <div
    class="box px-4 py-6 md:p-8 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">

    <div class="flex justify-between items-center mb-6 border-b pb-4 border-gray-200 dark:border-gray-700">
      <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
        {{-- Icon for Bulk Entry (List/Clipboard with +) --}}
        <svg class="size-8 rounded-full p-1 bg-green-50 text-green-600 dark:text-green-50 dark:bg-green-900"
          xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd"
            d="M5 4a3 3 0 00-3 3v6a3 3 0 003 3h10a3 3 0 003-3V7a3 3 0 00-3-3H5zm0 .5a.5.5 0 00-.5.5v7a.5.5 0 00.5.5h9a.5.5 0 00.5-.5v-7a.5.5 0 00-.5-.5H5zM10 9a1 1 0 011 1v1h1a1 1 0 110 2h-2a1 1 0 110-2h1V9a1 1 0 01-1-1 1 1 0 011-1z"
            clip-rule="evenodd" />
        </svg>
        Bulk Score Entry
      </h3>
      <a href="{{ route('admin.scores.index') }}"
        class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 transition-colors">
        Back to Scores List
      </a>
    </div>

    @if (session('error'))
      <div class="mb-4 p-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200" role="alert">
        {{ session('error') }}
      </div>
    @endif

    {{-- 1. Class Selection Filter Form (Always visible) --}}
    <form action="{{ route('admin.scores.createBulk') }}" method="GET" class="p-0 mb-6">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
        {{-- Course Offering Select (Class) --}}
        <div>
          <label for="course_offering_id" class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">
            Select Class (Course Offering) <span class="text-red-500">*</span>
          </label>
          <select id="course_offering_id" name="course_offering_id" required
            class="w-full px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white border-slate-300">
            <option value="">Choose Class</option>
            @foreach ($courseOfferings as $offering)
              <option value="{{ $offering->id }}" @selected(request('course_offering_id') == $offering->id)>
                {{ $offering->subject->name ?? 'N/A Subject' }} (Taught by:
                {{ $offering->teacher->name ?? 'Unassigned' }})
              </option>
            @endforeach
          </select>
        </div>

        {{-- Exam Select --}}
        <div>
          <label for="exam_id" class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">
            Select Exam <span class="text-red-500">*</span>
          </label>
          <select id="exam_id" name="exam_id" required
            class="w-full px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white border-slate-300">
            <option value="">Choose Exam</option>
            @foreach ($exams as $exam)
              <option value="{{ $exam->id }}" @selected(request('exam_id') == $exam->id)>
                {{ $exam->name }} ({{ $exam->date ? \Carbon\Carbon::parse($exam->date)->format('M d') : 'N/A Date' }})
              </option>
            @endforeach
          </select>
        </div>

        {{-- Semester Input --}}
        <div>
          <label for="semester" class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">
            Semester <span class="text-red-500">*</span>
          </label>
          <input type="text" id="semester" name="semester"
            value="{{ old('semester', request('semester', 'Fall 2025')) }}" required
            class="w-full px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white border-slate-300"
            placeholder="e.g., Spring 2025">
        </div>

        {{-- Action Button --}}
        <div>
          <button type="submit"
            class="w-full px-4 py-2 bg-indigo-600 text-white rounded-md shadow-md text-sm font-medium hover:bg-indigo-700 transition-colors flex items-center justify-center gap-2">
            Load Roster
          </button>
        </div>
      </div>
    </form>

    {{-- 2. Bulk Score Entry Roster Form (Conditional) --}}
    @if ($students->isNotEmpty())
      <div
        class="mt-8 p-4 bg-yellow-50 dark:bg-yellow-900/30 border-l-4 border-yellow-400 text-yellow-800 dark:text-yellow-200">
        <p class="font-bold">Roster for: {{ $selectedCourse->subject->name ?? 'N/A' }} / Exam:
          {{ $selectedExam->name ?? 'N/A' }}</p>
        <p class="text-sm">Enter scores for the students below. Existing scores will be updated. Leave score/grade blank
          to skip a student.</p>
      </div>

      <form action="{{ route('admin.scores.storeBulk') }}" method="POST" class="p-0 mt-6">
        @csrf
        {{-- Hidden fields to pass context data --}}
        <input type="hidden" name="course_offering_id" value="{{ $selectedCourse->id }}">
        <input type="hidden" name="exam_id" value="{{ $selectedExam->id }}">
        <input type="hidden" name="semester" value="{{ request('semester') }}">

        <div class="overflow-x-auto shadow-md sm:rounded-lg">
          <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
              <tr>
                <th scope="col" class="px-6 py-3">Student Name</th>
                <th scope="col" class="px-6 py-3 w-1/5">Score Obtained (0-{{ $selectedExam->total_marks ?? '??' }})
                </th>
                <th scope="col" class="px-6 py-3 w-1/6">Grade (e.g., A, B)</th>
                <th scope="col" class="px-6 py-3 w-1/6">Previous Score</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($students as $index => $student)
                @php
                  // Fetch existing score for this student/exam/course combination (for convenience)
                  $existingScore = $student->scores
                      ->where('exam_id', $selectedExam->id)
                      ->where('course_offering_id', $selectedCourse->id)
                      ->first();
                @endphp
                <tr
                  class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                  <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $student->name ?? 'User ID: ' . $student->id }}
                    {{-- Hidden field for student ID --}}
                    <input type="hidden" name="scores[{{ $index }}][student_id]" value="{{ $student->id }}">
                  </th>

                  {{-- Score Input --}}
                  <td class="px-6 py-4">
                    <input type="number" name="scores[{{ $index }}][score]"
                      value="{{ old("scores.$index.score", $existingScore->score ?? '') }}" min="0"
                      max="{{ $selectedExam->total_marks ?? 100 }}" step="0.01" placeholder="e.g., 78.5"
                      class="w-full text-sm px-2 py-1 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300">
                  </td>

                  {{-- Grade Input --}}
                  <td class="px-6 py-4">
                    <input type="text" name="scores[{{ $index }}][grade]"
                      value="{{ old("scores.$index.grade", $existingScore->grade ?? '') }}" maxlength="10"
                      placeholder="e.g., A-"
                      class="w-full text-sm px-2 py-1 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300">
                  </td>
                  <td class="px-6 py-4 text-center font-semibold text-gray-800 dark:text-gray-200">
                    {{ $existingScore->score ?? '-' }}
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        {{-- Submit Button --}}
        <div class="flex justify-end space-x-3 pt-6 mt-6 border-t border-gray-200 dark:border-gray-700">
          <button type="submit"
            class="px-6 py-3 cursor-pointer bg-green-600 text-white rounded-lg hover:bg-green-700 focus:outline-none focus:ring-4 focus:ring-green-500 focus:ring-offset-2 flex items-center gap-2 transition-colors text-lg font-semibold shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd"
                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                clip-rule="evenodd" />
            </svg>
            Save All {{ $students->count() }} Scores
          </button>
        </div>
      </form>
    @else
      {{-- Initial instruction when no class is loaded --}}
      <div class="mt-8 p-6 text-center bg-gray-100 dark:bg-gray-700/50 rounded-lg">
        <p class="text-lg font-medium text-gray-600 dark:text-gray-400">
          Please select a **Class** and an **Exam** from the filter above, then click **Load Roster** to view the student
          list for bulk score entry.
        </p>
      </div>
    @endif
  </div>
@endsection
