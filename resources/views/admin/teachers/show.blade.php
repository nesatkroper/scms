@extends('layouts.admin')
@section('title', 'Teacher Details: ' . $teacher->name)
@section('content')

  <div class="mb-6 flex justify-between items-center">
    <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 flex items-center gap-2">
      <div
        class="size-10 p-2 flex justify-center items-center rounded-full bg-blue-50 text-blue-600 border border-indigo-300 dark:border-indigo-800 dark:text-blue-50 dark:bg-slate-800">
        <i class="ri-user-2-fill text-2xl"></i>
      </div>
      {{ $teacher->name }} Details
    </h3>
    <div class="flex space-x-3">
      @if (Auth::user()->hasPermissionTo('update_teacher'))
        <a href="{{ route('admin.teachers.edit', $teacher->id) }}"
          class="p-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 transition-colors flex items-center gap-1">
          <i class="fa-solid fa-user-pen"></i>
          Edit Profile
        </a>
      @endif

      <a href="{{ route('admin.teachers.index') }}"
        class="p-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 transition-colors flex items-center gap-1">
        <i class="fa-regular fa-house"></i>
        Back to List
      </a>
    </div>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-1">
      <div class="lg:sticky lg:top-10">
        <div
          class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 text-center">
          <div class="mb-4">
            <img src="{{ $teacher->avatar_url }}" alt="{{ $teacher->name }}"
              class="size-56 mx-auto rounded-full object-cover border-4 border-indigo-200 dark:border-indigo-700 shadow-md">
          </div>
          <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100 capitalize">{{ $teacher->name }}</h2>
          <p class="text-sm text-indigo-600 dark:text-indigo-400 font-medium capitalize">
            {{ $teacher->specialization ?? 'Faculty Member' }}</p>

          <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
            <h3 class="text-md font-semibold text-gray-700 dark:text-gray-300 mb-2">Faculty Metrics</h3>
            <div class="flex justify-around text-center">
              <div class="p-2">
                <div class="text-xl font-bold text-indigo-600 dark:text-indigo-400">
                  {{ $teacher->teachingCourses->count() }}
                </div>
                <div class="text-xs text-gray-500 dark:text-gray-400">Courses</div>
              </div>
              <div class="p-2">
                <div class="text-xl font-bold text-indigo-600 dark:text-indigo-400">
                  {{ $teacher->experience ?? 0 }}
                </div>
                <div class="text-xs text-gray-500 dark:text-gray-400">Exp. Years</div>
              </div>
              <div class="p-2">
                <div class="text-xl font-bold text-indigo-600 dark:text-indigo-400">
                  ${{ number_format($teacher->salary ?? 0, 0) }}
                </div>
                <div class="text-xs text-gray-500 dark:text-gray-400">Monthly</div>
              </div>
            </div>
          </div>

          {{-- CV Section --}}
          <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700 text-left">
            <h3 class="text-md font-semibold text-gray-700 dark:text-gray-300 mb-3 ml-2">Documents</h3>
            @if ($teacher->cv)
              <a href="{{ asset($teacher->cv) }}" target="_blank"
                class="flex items-center justify-between p-3 bg-indigo-50 dark:bg-indigo-900/30 rounded-xl text-indigo-700 dark:text-indigo-300 hover:bg-indigo-100 transition-colors">
                <div class="flex items-center gap-2">
                  <i class="ri-file-pdf-2-line text-xl"></i>
                  <span class="text-xs font-bold uppercase">View Teacher CV</span>
                </div>
                <i class="ri-external-link-line"></i>
              </a>
            @else
              <p class="text-xs text-gray-400 italic text-center py-2">No CV uploaded</p>
            @endif
          </div>
        </div>

        @if (Auth::user()->hasPermissionTo('delete_teacher'))
          <div
            class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border-2 border-dashed border-red-500 dark:border-red-700 mt-4">
            <h3 class="text-md font-semibold text-red-600 dark:text-red-400 mb-3">Danger Zone</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
              Permanently delete this teacher and all associated records. This action cannot be undone.
            </p>
            <form action="{{ route('admin.teachers.destroy', $teacher->id) }}" method="POST"
              onsubmit="return confirm('Are you sure you want to delete this teacher: {{ $teacher->name }}?');">
              @csrf
              @method('DELETE')
              <button type="submit"
                class="w-full p-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition-colors">
                Delete Teacher
              </button>
            </form>
          </div>
        @endif

      </div>
    </div>

    {{-- Right Column: Detailed Information --}}
    <div class="lg:col-span-2">
      <div
        class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 divide-y divide-gray-200 dark:divide-gray-700">
        <div class="flex justify-between items-center pb-2">
          <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Personal & Contact Info</h3>
        </div>

        {{-- Details Grid --}}
        <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4 pt-4">

          {{-- General Info --}}
          @include('admin.components.detail-item', [
              'label' => 'Email Address',
              'value' => $teacher->email,
          ])
          @include('admin.components.detail-item', [
              'label' => 'Phone Number',
              'value' => $teacher->phone ?? __('message.n/a'),
          ])
          @include('admin.components.detail-item', [
              'label' => 'Gender',
              'value' => ucfirst($teacher->gender) ?? __('message.n/a'),
          ])
          @include('admin.components.detail-item', [
              'label' => 'Date of Birth',
              'value' => $teacher->date_of_birth
                  ? \Carbon\Carbon::parse($teacher->date_of_birth)->format('M d, Y')
                  : __('message.n/a'),
          ])

          {{-- Professional Info --}}
          @include('admin.components.detail-item', [
              'label' => 'Joining Date',
              'value' => $teacher->joining_date
                  ? \Carbon\Carbon::parse($teacher->joining_date)->format('M d, Y')
                  : __('message.n/a'),
          ])
          @include('admin.components.detail-item', [
              'label' => 'Highest Qualification',
              'value' => $teacher->qualification ?? __('message.n/a'),
          ])
          @include('admin.components.detail-item', [
              'label' => 'Account Created',
              'value' => \Carbon\Carbon::parse($teacher->created_at)->format('M d, Y'),
          ])
          @include('admin.components.detail-item', [
              'label' => 'Specialization',
              'value' => $teacher->specialization ?? __('message.n/a'),
          ])

          {{-- Address Info (Full Width) --}}
          <div class="sm:col-span-2">
            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Current Address</dt>
            <dd class="mt-1 text-sm text-gray-900 dark:text-gray-100">{{ $teacher->address ?? __('message.n/a') }}</dd>
          </div>
        </dl>
      </div>

      {{-- Assigned Courses --}}
      <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 mt-4">
        <div class="flex justify-between items-center pb-2">
          <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Teaching Assignments</h3>
        </div>

        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
          Details about courses this faculty member is currently teaching.
        </p>
        @if ($teacher->teachingCourses->isEmpty())
          <p class="text-gray-500 dark:text-gray-400">No active course assignments found.</p>
        @else
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
              <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                  <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    Subject
                  </th>
                  <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    Code
                  </th>
                  <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    Classroom
                  </th>
                  <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                    Schedule
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($teacher->teachingCourses as $course)
                  <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                      {{ $course->subject->name ?? __('message.n/a') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                      {{ $course->subject->code ?? 'N/A' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                      {{ $course->classroom->name ?? 'Online/Var' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 capitalize">
                      {{ $course->schedule ?? __('message.n/a') }}
                      ({{ $course->start_time ? \Carbon\Carbon::parse($course->start_time)->format('h:i A') : 'N/A' }}
                      -
                      {{ $course->end_time ? \Carbon\Carbon::parse($course->end_time)->format('h:i A') : 'N/A' }})
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @endif
      </div>
    </div>
  </div>

@endsection
