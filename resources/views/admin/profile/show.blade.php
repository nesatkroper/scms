@extends('layouts.admin')
@section('title', 'User Profile')
@section('content')

  @if (session('status'))
    <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
      role="alert">
      {{ session('status') }}
    </div>
  @endif

  <div class="space-y-6 mb-14">

    <div class="box px-2 py-4 md:p-6 bg-white dark:bg-gray-800 sm:rounded-lg shadow-sm flex items-center gap-6">
      <img class="w-24 h-24 rounded-full object-cover border-4 border-indigo-500/50"
        src="{{ $user->avatar ? asset($user->avatar) : asset('assets/images/cambodia.png') }}"
        alt="{{ $user->name }}'s Avatar">

      <div>
        <h1 class="text-3xl font-extrabold text-gray-900 dark:text-gray-100">{{ $user->name }}</h1>
        <p class="text-lg text-indigo-600 dark:text-indigo-400 font-medium">{{ $user->role?->name ?? 'Unspecified Role' }}
        </p>
        <p class="text-gray-500 dark:text-gray-400">{{ $user->email }}</p>
      </div>
    </div>

    <div
      class="box px-2 py-4 md:p-6 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
      <h3 class="text-xl mb-4 font-bold text-gray-800 dark:text-gray-200 flex items-center gap-3">
        <svg class="size-8 p-1 rounded-full bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
          xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd"
            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-5.5-2.5a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0zM10 12a5.5 5.5 0 00-5.5 5.5.5.5 0 00.5.5h10a.5.5 0 00.5-.5A5.5 5.5 0 0010 12z"
            clip-rule="evenodd" />
        </svg>
        Personal Information
      </h3>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-4 gap-x-6">

        @include('admin.profile.read-only-field', [
            'label' => 'Full Name',
            'value' => $user->name,
        ])
        @include('admin.profile.read-only-field', [
            'label' => 'Email Address',
            'value' => $user->email,
        ])
        @include('admin.profile.read-only-field', [
            'label' => 'Phone Number',
            'value' => $user->phone,
        ])

        @include('admin.profile.read-only-field', [
            'label' => 'Date of Birth',
            'value' => $user->date_of_birth?->format('F j, Y'),
        ])

        @include('admin.profile.read-only-field', [
            'label' => 'Gender',
            'value' => $user->gender ? ucfirst($user->gender) : null,
        ])

        @include('admin.profile.read-only-field', [
            'label' => 'Nationality',
            'value' => $user->nationality,
        ])
        @include('admin.profile.read-only-field', [
            'label' => 'Religion',
            'value' => $user->religion,
        ])
        @include('admin.profile.read-only-field', [
            'label' => 'Blood Group',
            'value' => $user->blood_group,
        ])

        <div class="md:col-span-2 lg:col-span-3">
          @include('admin.profile.read-only-field', [
              'label' => 'Address',
              'value' => $user->address,
          ])
        </div>

      </div>
    </div>

    <div
      class="box px-2 py-4 md:p-6 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
      <h3 class="text-xl mb-4 font-bold text-gray-800 dark:text-gray-200 flex items-center gap-3">
        <svg class="size-8 p-1 rounded-full bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
          xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd"
            d="M6 3a2 2 0 00-2 2v11a2 2 0 002 2h8a2 2 0 002-2V5a2 2 0 00-2-2H6zm3.25 9.75a.75.75 0 001.5 0v-5.5a.75.75 0 00-1.5 0v5.5z"
            clip-rule="evenodd" />
        </svg>
        Professional/HR Information
      </h3>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-4 gap-x-6">

        @include('admin.profile.read-only-field', [
            'label' => 'Department ID',
            'value' => $user->department_id,
        ])
        @include('admin.profile.read-only-field', [
            'label' => 'Joining Date',
            'value' => $user->joining_date?->format('F j, Y'),
        ])
        @include('admin.profile.read-only-field', [
            'label' => 'Annual Salary',
            'value' => $user->salary ? number_format($user->salary, 2) : null,
        ])

        @include('admin.profile.read-only-field', [
            'label' => 'Qualification',
            'value' => $user->qualification,
        ])
        @include('admin.profile.read-only-field', [
            'label' => 'Experience',
            'value' => $user->experience,
        ])
        @include('admin.profile.read-only-field', [
            'label' => 'Occupation/Title',
            'value' => $user->occupation,
        ])

        @include('admin.profile.read-only-field', [
            'label' => 'Company/Employer',
            'value' => $user->company,
        ])
        @include('admin.profile.read-only-field', [
            'label' => 'Admission Date',
            'value' => $user->admission_date?->format('F j, Y'),
        ])

        <div>
          <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Current CV</p>
          @if ($user->cv)
            <a href="{{ asset('storage/' . $user->cv) }}" target="_blank"
              class="mt-1 text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 font-medium flex items-center gap-1">
              View CV
            </a>
          @else
            <p class="mt-1 text-gray-800 dark:text-gray-300 font-medium">N/A</p>
          @endif
        </div>

        <div class="md:col-span-2 lg:col-span-3">
          @include('admin.profile.read-only-field', [
              'label' => 'Specialization',
              'value' => $user->specialization,
          ])
        </div>

      </div>

    </div>

  </div>

@endsection
