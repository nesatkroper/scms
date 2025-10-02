@extends('layouts.admin')
@section('title', 'User Profile')
@section('content')

  @if (session('status'))
    <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
      {{ session('status') }}
    </div>
  @endif

  <div class="space-y-6 mb-14">

    <div class="box px-2 py-4 md:p-6 bg-white dark:bg-gray-800 sm:rounded-lg shadow-sm flex items-center gap-6">
      <img class="w-24 h-24 rounded-full object-cover border-4 border-indigo-500/50"
        src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('images/scms.png') }}"
        alt="{{ $user->name }}'s Avatar">

      <div>
        <h1 class="text-3xl font-extrabold text-gray-900 dark:text-gray-100">{{ $user->name }}</h1>
        <p class="text-lg text-indigo-600 dark:text-indigo-400 font-medium">{{ $user->occupation }}</p>
        <p class="text-gray-500 dark:text-gray-400">{{ $user->email }}</p>
      </div>
    </div>

    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

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

          @include('admin.profile.partials.form-input', ['label' => 'Full Name', 'name' => 'name', 'type' => 'text', 'value' => old('name', $user->name)])
          @include('admin.profile.partials.form-input', ['label' => 'Email Address', 'name' => 'email', 'type' => 'email', 'value' => old('email', $user->email)])
          @include('admin.profile.partials.form-input', ['label' => 'Phone Number', 'name' => 'phone', 'type' => 'text', 'value' => old('phone', $user->phone), 'required' => false])

          @include('admin.profile.partials.form-input', ['label' => 'Date of Birth', 'name' => 'date_of_birth', 'type' => 'date', 'value' => old('date_of_birth', $user->date_of_birth?->format('Y-m-d')), 'required' => false])

          <div>
            <label for="gender"
              class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Gender</label>
            <select id="gender" name="gender"
              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
              <option value="male" @selected(old('gender', $user->gender) == 'male')>Male</option>
              <option value="female" @selected(old('gender', $user->gender) == 'female')>Female</option>
            </select>
            @error('gender') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
          </div>

          @include('admin.profile.partials.form-input', ['label' => 'Nationality', 'name' => 'nationality', 'type' => 'text', 'value' => old('nationality', $user->nationality), 'required' => false])

          @include('admin.profile.partials.form-input', ['label' => 'Religion', 'name' => 'religion', 'type' => 'text', 'value' => old('religion', $user->religion), 'required' => false])
          @include('admin.profile.partials.form-input', ['label' => 'Blood Group', 'name' => 'blood_group', 'type' => 'text', 'value' => old('blood_group', $user->blood_group), 'required' => false])
          @include('admin.profile.partials.form-input', ['label' => 'Update Avatar', 'name' => 'avatar', 'type' => 'file', 'required' => false])

          <div class="md:col-span-2 lg:col-span-3">
            <label for="address"
              class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Address</label>
            <textarea id="address" name="address" rows="2"
              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 @error('address') border-red-500 @enderror">{{ old('address', $user->address) }}</textarea>
            @error('address') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
          </div>

        </div>

        <div class="mt-6 pt-4 border-t border-gray-200 dark:border-gray-700 flex justify-end">
          <button type="submit"
            class="px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 transition duration-150">
            Save Personal Information
          </button>
        </div>
      </div>
    </form>

    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

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
          <div>
            <label for="department_id"
              class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Department</label>
            @include('admin.profile.partials.form-input', ['label' => 'Department ID', 'name' => 'department_id', 'type' => 'number', 'value' => old('department_id', $user->department_id), 'required' => false])
          </div>

          @include('admin.profile.partials.form-input', ['label' => 'Joining Date', 'name' => 'joining_date', 'type' => 'date', 'value' => old('joining_date', $user->joining_date?->format('Y-m-d')), 'required' => false])
          @include('admin.profile.partials.form-input', ['label' => 'Annual Salary', 'name' => 'salary', 'type' => 'number', 'value' => old('salary', $user->salary), 'required' => false])


          @include('admin.profile.partials.form-input', ['label' => 'Qualification', 'name' => 'qualification', 'type' => 'text', 'value' => old('qualification', $user->qualification), 'required' => false])
          @include('admin.profile.partials.form-input', ['label' => 'Experience', 'name' => 'experience', 'type' => 'text', 'value' => old('experience', $user->experience), 'required' => false])
          @include('admin.profile.partials.form-input', ['label' => 'Occupation/Title', 'name' => 'occupation', 'type' => 'text', 'value' => old('occupation', $user->occupation), 'required' => false])


          @include('admin.profile.partials.form-input', ['label' => 'Company/Employer', 'name' => 'company', 'type' => 'text', 'value' => old('company', $user->company), 'required' => false])
          @include('admin.profile.partials.form-input', ['label' => 'Admission Date', 'name' => 'admission_date', 'type' => 'date', 'value' => old('admission_date', $user->admission_date?->format('Y-m-d')), 'required' => false])
          @include('admin.profile.partials.form-input', ['label' => 'Update CV (.pdf, .doc)', 'name' => 'cv', 'type' => 'file', 'required' => false])


          <div class="md:col-span-2 lg:col-span-3">
            <label for="specialization"
              class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Specialization</label>
            <textarea id="specialization" name="specialization" rows="2"
              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 @error('specialization') border-red-500 @enderror">{{ old('specialization', $user->specialization) }}</textarea>
            @error('specialization') <p class="text-sm text-red-500 mt-1">{{ $message }}</p> @enderror
          </div>
        </div>

        <div class="mt-6 pt-4 border-t border-gray-200 dark:border-gray-700 flex justify-between items-center">
          <div>
            <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Current CV</p>
            @if($user->cv)
              <a href="{{ asset('storage/' . $user->cv) }}" target="_blank"
                class="mt-1 text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 font-medium flex items-center gap-1">
                View CV
              </a>
            @else
              <p class="mt-1 text-gray-800 dark:text-gray-300 font-medium">No file uploaded</p>
            @endif
          </div>

          <button type="submit"
            class="px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 transition duration-150">
            Save Professional Data
          </button>
        </div>
      </div>
    </form>

  </div>

@endsection