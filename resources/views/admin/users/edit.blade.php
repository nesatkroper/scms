@extends('layouts.admin')
@section('title', 'Edit User')
@section('content')

  <div class="p-6">
    <div class="flex items-center justify-between mb-6">
      <h1 class="text-2xl font-semibold">Edit User: {{ $user->name }}</h1>
      <a href="{{ route('admin.users.index') }}"
        class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">
        Back to Users List
      </a>
    </div>

    @if (session('error'))
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
      </div>
    @endif

    @php
      $rolesMap = $roles->pluck('name', 'name')->toArray();
      $userRoleName = old('type', $user->roles->first()->name ?? '');

      $inputClasses =
          'form-control w-full px-3 py-2 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300';

      $fileClasses =
          'form-control w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 dark:file:bg-gray-700 dark:file:text-white dark:hover:file:bg-gray-600';
    @endphp

    <form id="Formedit" action="{{ route('admin.users.update', $user) }}" method="POST"
      class="bg-white dark:bg-gray-800 shadow-xl rounded-lg p-6" enctype="multipart/form-data" novalidate
      x-data="{
          userRole: '{{ $userRoleName }}',
          avatarCleared: false,
          clearAvatar() {
              this.avatarCleared = true;
          }
      }">
      @csrf
      @method('PUT')

      <div class="space-y-6">
        <div class="relative h-28 flex items-end justify-center bg-gray-50 dark:bg-gray-700 rounded-t-lg">
          <div class="absolute -bottom-12">
            <x-photos.upload2 name="avatar" size="xl" :current-image-url="$user->avatar ? asset($user->avatar) : null" :can-remove="true" :remove-action="'$parent.clearAvatar()'" />
          </div>
        </div>

        <div class="pt-16 pb-4 border-b">
          <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">👤 Basic Information</h3>
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-4 gap-x-6">

            <div class="mb-2">
              <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Name <span class="text-red-500">*</span>
              </label>
              <input type="text" id="name" name="name" placeholder="Enter name" required
                value="{{ old('name', $user->name) }}"
                class="{{ $inputClasses }} @error('name') border-red-500 @enderror">
              @error('name')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <div class="mb-2">
              <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Email <span class="text-red-500">*</span>
              </label>
              <input type="email" id="email" name="email" placeholder="Enter email" required
                value="{{ old('email', $user->email) }}"
                class="{{ $inputClasses }} @error('email') border-red-500 @enderror">
              @error('email')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <div class="mb-2">
              <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Password (New)
              </label>
              <input type="password" id="password" name="password" placeholder="Leave blank to keep current"
                class="{{ $inputClasses }} @error('password') border-red-500 @enderror">
              @error('password')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <div class="mb-2">
              <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Confirm Password
              </label>
              <input type="password" id="password_confirmation" name="password_confirmation"
                placeholder="Confirm new password"
                class="{{ $inputClasses }} @error('password_confirmation') border-red-500 @enderror">
              @error('password_confirmation')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <div class="mb-2">
              <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                User Role <span class="text-red-500">*</span>
              </label>
              <select id="type" name="type" required x-model="userRole"
                class="form-control form-select w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                    focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                    dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700
                    border-slate-300 @error('type') border-red-500 @enderror">
                <option value="" disabled>Select User Role</option>
                @foreach ($rolesMap as $name => $name)
                  <option class="capitalize" value="{{ $name }}" @selected(old('type', $userRoleName) == $name)>
                    {{ $name }}</option>
                @endforeach
              </select>
              @error('type')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <div class="mb-2">
              <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Phone number
              </label>
              <input type="tel" id="phone" name="phone" placeholder="Enter phone number"
                value="{{ old('phone', $user->phone) }}"
                class="{{ $inputClasses }} @error('phone') border-red-500 @enderror">
              @error('phone')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <div class="mb-2">
              <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Address
              </label>
              <input type="text" id="address" name="address" placeholder="Enter address"
                value="{{ old('address', $user->address) }}"
                class="{{ $inputClasses }} @error('address') border-red-500 @enderror">
              @error('address')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <div class="mb-2">
              <label for="date_of_birth" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Date of Birth
              </label>
              <input type="date" id="date_of_birth" name="date_of_birth" placeholder="Enter Date of Birth"
                value="{{ old('date_of_birth', $user->date_of_birth?->toDateString()) }}"
                class="{{ $inputClasses }} @error('date_of_birth') border-red-500 @enderror">
              @error('date_of_birth')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <div class="mb-2">
              <label for="gender" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Gender
              </label>
              <select id="gender" name="gender"
                class="form-control form-select w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                    focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                    dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700
                    border-slate-300 @error('gender') border-red-500 @enderror">
                @foreach (['male' => 'Male', 'female' => 'Female', 'other' => 'Other'] as $key => $label)
                  <option value="{{ $key }}" @selected(old('gender', $user->gender) == $key)>{{ $label }}</option>
                @endforeach
              </select>
              @error('gender')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <div class="mb-2">
              <label for="nationality" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Nationality
              </label>
              <input type="text" id="nationality" name="nationality" placeholder="Enter nationality"
                value="{{ old('nationality', $user->nationality) }}"
                class="{{ $inputClasses }} @error('nationality') border-red-500 @enderror">
              @error('nationality')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <div class="mb-2">
              <label for="religion" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Religion
              </label>
              <input type="text" id="religion" name="religion" placeholder="Enter religion"
                value="{{ old('religion', $user->religion) }}"
                class="{{ $inputClasses }} @error('religion') border-red-500 @enderror">
              @error('religion')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <div class="mb-2">
              <label for="blood_group" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Blood Group
              </label>
              <select id="blood_group" name="blood_group"
                class="form-control form-select w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                    focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                    dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700
                    border-slate-300 @error('blood_group') border-red-500 @enderror">
                <option value="" @selected(old('blood_group', $user->blood_group) == '')>Select Blood Group</option>
                @foreach (['A+' => 'A+', 'A-' => 'A-', 'B+' => 'B+', 'B-' => 'B-', 'AB+' => 'AB+', 'AB-' => 'AB-', 'O+' => 'O+', 'O-' => 'O-'] as $key => $label)
                  <option value="{{ $key }}" @selected(old('blood_group', $user->blood_group) == $key)>{{ $label }}</option>
                @endforeach
              </select>
              @error('blood_group')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

          </div>
        </div>

        <div class="pb-4 border-b mt-8" x-show="['teacher', 'admin', 'staff'].includes(userRole)">
          <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">🧑‍💼 Employment/Academic Details</h3>
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-4 gap-x-6">

            <div class="mb-2">
              <label for="department_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Department
              </label>
              <select id="department_id" name="department_id"
                class="form-control form-select w-full px-3 py-2 border rounded-md focus:outline focus:outline-white
                    focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                    dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700
                    border-slate-300 @error('department_id') border-red-500 @enderror">
                <option value="" @selected(old('department_id', $user->department_id) == '')>Select Department</option>
                @foreach ($departments->pluck('name', 'id')->toArray() as $id => $name)
                  <option value="{{ $id }}" @selected(old('department_id', $user->department_id) == $id)>{{ $name }}</option>
                @endforeach
              </select>
              @error('department_id')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <div class="mb-2">
              <label for="joining_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Joining Date
              </label>
              <input type="date" id="joining_date" name="joining_date" placeholder="Enter Joining Date"
                value="{{ old('joining_date', $user->joining_date?->toDateString()) }}"
                class="{{ $inputClasses }} @error('joining_date') border-red-500 @enderror">
              @error('joining_date')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <div class="mb-2">
              <label for="qualification" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Qualification
              </label>
              <input type="text" id="qualification" name="qualification" placeholder="e.g., Master of Science"
                value="{{ old('qualification', $user->qualification) }}"
                class="{{ $inputClasses }} @error('qualification') border-red-500 @enderror">
              @error('qualification')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <div class="mb-2">
              <label for="experience" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Experience (Years)
              </label>
              <input type="number" id="experience" name="experience" placeholder="e.g., 5" min="0"
                step="0.5" value="{{ old('experience', $user->experience) }}"
                class="{{ $inputClasses }} @error('experience') border-red-500 @enderror">
              @error('experience')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <div class="mb-2">
              <label for="specialization" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Specialization
              </label>
              <input type="text" id="specialization" name="specialization" placeholder="e.g., Computer Science"
                value="{{ old('specialization', $user->specialization) }}"
                class="{{ $inputClasses }} @error('specialization') border-red-500 @enderror">
              @error('specialization')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <div class="mb-2">
              <label for="salary" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Salary
              </label>
              <input type="number" id="salary" name="salary" placeholder="Enter salary amount" min="0"
                step="0.01" value="{{ old('salary', $user->salary) }}"
                class="{{ $inputClasses }} @error('salary') border-red-500 @enderror">
              @error('salary')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <div class="mb-2">
              <label for="cv" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                CV/Resume
              </label>
              <input type="file" id="cv" name="cv" accept=".pdf,.doc,.docx"
                class="{{ $fileClasses }}">
              @error('cv')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

          </div>
        </div>

        <div class="pb-4 mt-8" x-show="userRole === 'student'">
          <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">🎓 Student Details</h3>
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-4 gap-x-6">

            <div class="mb-2">
              <label for="admission_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Admission Date
              </label>
              <input type="date" id="admission_date" name="admission_date" placeholder="Enter Admission Date"
                value="{{ old('admission_date', $user->admission_date?->toDateString()) }}"
                class="{{ $inputClasses }} @error('admission_date') border-red-500 @enderror">
              @error('admission_date')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <div class="mb-2">
              <label for="occupation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Parent/Guardian Occupation
              </label>
              <input type="text" id="occupation" name="occupation" placeholder="Enter Occupation"
                value="{{ old('occupation', $user->occupation) }}"
                class="{{ $inputClasses }} @error('occupation') border-red-500 @enderror">
              @error('occupation')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <div class="mb-2">
              <label for="company" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Parent/Guardian Company
              </label>
              <input type="text" id="company" name="company" placeholder="Enter Company Name"
                value="{{ old('company', $user->company) }}"
                class="{{ $inputClasses }} @error('company') border-red-500 @enderror">
              @error('company')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

          </div>
        </div>
      </div>

      <div class="mt-8 pt-4 border-t flex justify-end space-x-3">
        <a href="{{ route('admin.users.index') }}"
          class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">Cancel</a>
        <button type="submit"
          class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700">Update
          User</button>
      </div>

      <input type="hidden" name="clear_avatar" :value="avatarCleared ? 1 : 0">
    </form>
  </div>
@endsection
