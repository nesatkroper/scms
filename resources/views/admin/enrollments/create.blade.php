@extends('layouts.admin')

@section('title', 'Create New Admission')

@section('content')

  <div class="mx-auto">
    <div
      class="box px-4 py-6 md:p-8 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">

      <div class="flex justify-between items-center mb-6 border-b pb-4 border-gray-200 dark:border-gray-700">
        <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
          {{-- Icon for Create Admission --}}
          <svg class="size-8 rounded-full p-1 bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path
              d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zm0 1c-2.67 0-4.85 1.58-5.78 3.5.93 1.92 3.11 3.5 5.78 3.5s4.85-1.58 5.78-3.5c-.93-1.92-3.11-3.5-5.78-3.5z" />
            <path d="M17 11h-1v-1a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2z" />
          </svg>
          Create New Admission Record {{ $courseOffering?->subject?->name ?? 'Deleted' }}
        </h3>
        {{-- Back to Register Button --}}
        <a href="{{ route('admin.enrollments.index', ['course_offering_id' => $courseOfferingId]) }}"
          class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 transition-colors">
          Back to Register
        </a>
      </div>

      {{-- Success/Error Messages --}}
      @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
          {{ session('success') }}
        </div>
      @endif
      @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
          {{ session('error') }}
        </div>
      @endif

      <form action="{{ route('admin.enrollments.store') }}" method="POST" class="p-0">
        @csrf

        <div class="space-y-6">
          {{-- Student and Course Selects (2 Columns) --}}
          <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <input type="hidden" name="course_offering_id" value="{{ $courseOfferingId }}">
            <input type="hidden" name="status" value="studying">
            <input type="hidden" name="fee" value="{{ $courseOffering->fee }}">

            {{-- 1. Student Field (Select) --}}
            <div>
              <label for="student_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Student <span class="text-red-500">*</span>
              </label>

              <select name="student_id" id="student_id" required
                class="w-full px-3 py-2 border rounded-md
      dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300">
                <option value="">Select Student</option>

                @foreach ($students as $student)
                  <option value="{{ $student->id }}">{{ $student->name }} (ID: {{ $student->id }})</option>
                @endforeach
              </select>

              @error('student_id')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
              @enderror
            </div>

            {{-- <div>
              <label for="student_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Student <span class="text-red-500">*</span>
              </label>
              <select name="student_id" id="student_id" required
                class="w-full px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('student_id') border-red-500 @enderror">
                <option value="" disabled>Select Student</option>
                @foreach ($students as $student)
                  <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                    {{ $student->name }} (ID: {{ $student->id }})
                  </option>
                @endforeach
              </select>
              @error('student_id')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
              @enderror
            </div> --}}

            {{-- 4. Payment Status Field (Select) --}}
            <div>
              <label for="payment_status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Payment Status <span class="text-red-500">*</span>
              </label>
              <select name="payment_status" id="payment_status" required
                class="w-full px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('payment_status') border-red-500 @enderror">
                <option value="" disabled>Select Payment Status</option>
                @foreach ($paymentStatuses as $pStatus)
                  <option value="{{ $pStatus }}" {{ old('payment_status') == $pStatus ? 'selected' : '' }}>
                    {{ ucfirst($pStatus) }}
                  </option>
                @endforeach
              </select>
              @error('payment_status')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
              @enderror
            </div>

          </div>

          {{-- 6. Remarks Field (Textarea) --}}
          <div class="border-t pt-6 border-gray-200 dark:border-gray-700">
            <label for="remarks" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              Remarks (Optional)
            </label>
            <textarea name="remarks" id="remarks" rows="5"
              placeholder="Any special notes about this student's admission or progress."
              class="w-full border-gray-300 p-3 dark:border-gray-600 dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('remarks') border-red-500 @enderror">{{ old('remarks') }}</textarea>
            @error('remarks')
              <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
          </div>

        </div>

        {{-- Submit Button Row --}}
        <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200 dark:border-gray-700 mt-8">
          <a href="{{ route('admin.enrollments.index', ['course_offering_id' => $courseOfferingId]) }}"
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
                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                clip-rule="evenodd" />
            </svg>
            Create Admission
          </button>
        </div>
      </form>
    </div>
  </div>

@endsection

@push('script')
  <script>
    new SlimSelect({
      select: '#student_id',
      settings: {
        placeholderText: 'Search student…',
        searchPlaceholder: 'Type to search...',
        searchHighlight: true,
      }
    })
  </script>
@endpush

@push('style')
  <style>
    .ss-main {
      @apply w-full px-3 py-[6px] border rounded-md bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300;
    }

    .ss-main .ss-values .ss-placeholder {
      @apply text-gray-500 dark:text-gray-300;
    }

    .ss-list {
      @apply bg-white dark:bg-gray-700 dark:text-gray-200 border border-gray-200 dark:border-gray-600 rounded-md shadow-lg mt-1;
    }

    .ss-option {
      @apply px-3 py-2 hover:bg-indigo-50 dark:hover:bg-gray-600 cursor-pointer;
    }

    .ss-option.selected {
      @apply bg-indigo-100 dark:bg-gray-600;
    }
  </style>
@endpush
