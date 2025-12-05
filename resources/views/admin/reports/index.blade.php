@extends('layouts.admin')

@section('title', 'System Reports')

@section('content')

  <div
    class="box px-2 py-4 md:p-4 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm mb-10">

    <h3 class="text-lg mb-3 font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
      <svg class="size-8 p-1 rounded-full bg-blue-50 text-blue-600 dark:text-blue-50 dark:bg-blue-900"
        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
        stroke-linecap="round" stroke-linejoin="round">
        <path d="M3 3v18h18" />
        <path d="M18.7 8.3L12 15 7.1 10.1" />
      </svg>
      Generate System Reports
    </h3>

    <!-- FILTER BOX -->
    <div class="p-4 bg-blue-50 dark:bg-slate-800 rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm mb-8">
      <h4
        class="text-base font-semibold text-gray-800 dark:text-gray-200 mb-4 border-b pb-2 border-gray-200 dark:border-gray-600">
        Select Report Parameters
      </h4>

      <form method="GET" action="{{ route('admin.reports.generate') }}" class="space-y-4">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

          <!-- Report Type -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              Report Type <span class="text-red-500">*</span>
            </label>
            <select class="form-control-tailwind" id="report_type" name="report_type" required>
              <option value="">Select a Report</option>

              <option value="student_enrollment" {{ request('report_type') == 'student_enrollment' ? 'selected' : '' }}>
                Student Enrollment</option>

              <option value="financial_expenses" {{ request('report_type') == 'financial_expenses' ? 'selected' : '' }}>
                Financial Expenses</option>

              <option value="attendance" {{ request('report_type') == 'attendance' ? 'selected' : '' }}>
                Attendance Report</option>

              <option value="scores" {{ request('report_type') == 'scores' ? 'selected' : '' }}>
                Score Report</option>

              <option value="financial_summary" {{ request('report_type') == 'financial_summary' ? 'selected' : '' }}>
                Financial Summary</option>
            </select>
          </div>

          <!-- Start Date -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Start Date</label>
            <input type="date" class="form-control-tailwind" name="start_date"
              value="{{ request('start_date') ?? ($defaultStart ? date('Y-m-d', strtotime($defaultStart)) : '') }}">

          </div>

          <!-- End Date -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">End Date</label>
            <input type="date" class="form-control-tailwind" name="end_date"
              value="{{ request('end_date') ?? ($defaultEnd ? date('Y-m-d', strtotime($defaultEnd)) : '') }}">
          </div>

        </div>

        <!-- DYNAMIC FILTERS -->
        <div class="p-4 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-600">

          <h5 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
            Report Specific Filters
          </h5>

          {{-- Student Enrollment Filters --}}
          @if (request('report_type') == 'student_enrollment')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

              <!-- Course -->
              <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Course Offering</label>
                <select class="form-control-tailwind" name="course_offering_id">
                  <option value="">All Courses</option>
                  @foreach ($courses as $id => $name)
                    <option value="{{ $id }}" {{ request('course_offering_id') == $id ? 'selected' : '' }}>
                      {{ $name }}</option>
                  @endforeach
                </select>
              </div>

              <!-- Status -->
              <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                <select class="form-control-tailwind" name="status">
                  <option value="">All</option>
                  @foreach (['studying', 'suspended', 'dropped', 'completed'] as $status)
                    <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                      {{ ucfirst($status) }}</option>
                  @endforeach
                </select>
              </div>

            </div>

            {{-- Attendance Filters --}}
          @elseif (request('report_type') == 'attendance')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

              <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Course Offering</label>
                <select class="form-control-tailwind" name="course_offering_id">
                  <option value="">All Courses</option>
                  @foreach ($courses as $id => $name)
                    <option value="{{ $id }}" {{ request('course_offering_id') == $id ? 'selected' : '' }}>
                      {{ $name }}</option>
                  @endforeach
                </select>
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                <select class="form-control-tailwind" name="status">
                  <option value="">All</option>
                  @foreach (['present', 'absent', 'late'] as $status)
                    <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                      {{ ucfirst($status) }}</option>
                  @endforeach
                </select>
              </div>

            </div>

            {{-- Score Filters --}}
          @elseif (request('report_type') == 'scores')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

              <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Course Offering</label>
                <select class="form-control-tailwind" name="course_offering_id">
                  <option value="">All Courses</option>
                  @foreach ($courses as $id => $name)
                    <option value="{{ $id }}" {{ request('course_offering_id') == $id ? 'selected' : '' }}>
                      {{ $name }}</option>
                  @endforeach
                </select>
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Exam Type</label>
                <select class="form-control-tailwind" name="exam_type">
                  <option value="">All</option>
                  @foreach (['quiz', 'midterm', 'final'] as $type)
                    <option value="{{ $type }}" {{ request('exam_type') == $type ? 'selected' : '' }}>
                      {{ ucfirst($type) }}</option>
                  @endforeach
                </select>
              </div>

            </div>

            {{-- No filters --}}
          @else
            <p class="text-sm text-gray-500 dark:text-gray-400 italic">
              Select a report type to show specific filters.
            </p>
          @endif

        </div>

        <!-- GENERATE BUTTON -->
        <div class="flex justify-end">
          <button type="submit"
            class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 flex items-center gap-2 transition-colors">
            <i class="fa-solid fa-file-export"></i>
            Generate Report
          </button>
        </div>

      </form>
    </div>

    <!-- SHOW REPORT RESULT -->
    @if (isset($reportView))
      <div class="box p-4 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-lg">

        <div class="flex justify-between items-center mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
          <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200">{{ $title }}</h3>

          <div class="flex gap-2">

            <!-- Export Excel -->
            <a href="{{ request()->fullUrlWithQuery(['export' => 'excel']) }}"
              class="px-3 py-2 bg-green-600 text-white rounded-md text-sm hover:bg-green-700">
              Excel
            </a>

            <!-- Export PDF -->
            <a href="{{ request()->fullUrlWithQuery(['export' => 'pdf']) }}"
              class="px-3 py-2 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700">
              PDF
            </a>

          </div>
        </div>

        <div>
          @include($reportView, ['data' => $data])
        </div>

      </div>
    @endif

    <!-- Tailwind Form Control Styling -->
    <style>
      .form-control-tailwind {
        width: 100%;
        padding: 0.5rem 0.75rem;
        border-radius: 0.375rem;
        border: 1px solid #d1d5db;
        background-color: white;
        color: #1f2937;
        transition: 0.15s;
      }

      .dark .form-control-tailwind {
        background-color: #374151;
        border-color: #4b5563;
        color: #f3f4f6;
      }

      .form-control-tailwind:focus {
        outline: none;
        border-color: #ef4444;
        box-shadow: 0 0 0 2px #ef4444;
        background-color: #f8fafc;
      }

      .dark .form-control-tailwind:focus {
        background-color: #1f2937;
      }
    </style>

  </div>

@endsection

@push('scripts')
  <script>
    document.getElementById('report_type').addEventListener('change', function() {
      const url = new URL(window.location.href);

      ['course_offering_id', 'status', 'exam_type', 'expense_category_id']
      .forEach(param => url.searchParams.delete(param));

      url.searchParams.set('report_type', this.value);
      window.location.href = url.toString();
    });
  </script>
@endpush
