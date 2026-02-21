@extends('layouts.admin')
@section('title', 'Edit Teacher: ' . $teacher->name)
@section('content')

  <div class="mb-10">
    {{-- Page Header --}}
    <div class="flex items-center justify-between px-3 md:px-0 mb-6">
      <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 flex items-center gap-2">
        <div
          class="size-10 p-2 flex justify-center items-center rounded-full bg-blue-50 text-blue-600 border border-indigo-300 dark:border-indigo-800 dark:text-blue-50 dark:bg-slate-800">
          <i class="ri-user-2-fill text-2xl"></i>
        </div>
        Edit Teacher: {{ $teacher->name }}
      </h3>
      <a href="{{ route('admin.teachers.index') }}"
        class="group relative inline-flex items-center justify-center px-6 py-3 text-sm font-semibold text-white  rounded-xl shadow-md hover:shadow-lg transition-all duration-300 ease-in-out overflow-hidden">
        <span
          class="absolute inset-0 bg-gradient-to-r from-purple-600 to-indigo-700 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
        <span class="relative flex items-center">
          <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition-transform duration-300" fill="none"
            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
          </svg>
          Back to Teachers List
        </span>
        <span
          class="absolute top-0 left-0 w-full h-full bg-white opacity-0 group-hover:opacity-10 transform -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-700"></span>
      </a>
    </div>

    @if (session('error'))
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
      </div>
    @endif

    <form action="{{ route('admin.teachers.update', $teacher->id) }}" method="POST"
      class="bg-white dark:bg-gray-800 shadow-xl rounded-lg p-6" enctype="multipart/form-data" novalidate x-data="{}">
      @csrf
      @method('PUT')

      <div class="space-y-6">

        {{-- Avatar Upload Area --}}
        <div class="relative h-28 flex items-end justify-center bg-gray-50 dark:bg-gray-700 rounded-t-lg">
          @php
            $avatarUrl = $teacher->avatar ? asset($teacher->avatar) : null;
          @endphp
          <x-photos.upload2 name="avatar" size="xl" :current-image-url="$avatarUrl" :clear-input-name="'clear_avatar'" />
        </div>

        {{-- Basic Information Section --}}
        <div class="pt-5 pb-4 border-b border-slate-300 dark:border-slate-700">
          <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">👤 Account & Basic Information</h3>
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-2 gap-x-6">

            {{-- Name --}}
            <div class="mb-2">
              <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Full Name <span class="text-red-500">*</span>
              </label>
              <input type="text" id="name" name="name" placeholder="Enter full name" required
                value="{{ old('name', $teacher->name) }}" class="form-control w-full p-2 border px-4 rounded-lg focus:outline focus:outline-white
                               focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                               dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700
                               border-slate-300 @error('name') border-red-500 @enderror">
              @error('name')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

            {{-- Email --}}
            <div class="mb-2">
              <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Email Address <span class="text-red-500">*</span>
              </label>
              <input type="email" id="email" name="email" placeholder="Enter email address" required
                value="{{ old('email', $teacher->email) }}" class="form-control w-full p-2 border px-4 rounded-lg focus:outline focus:outline-white
                               focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                               dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700
                               border-slate-300 @error('email') border-red-500 @enderror">
              @error('email')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

            {{-- Phone --}}
            <div class="mb-2">
              <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Phone Number <span class="text-red-500">*</span>
              </label>
              <input type="tel" id="phone" name="phone" placeholder="e.g., 012 345 678" required
                value="{{ old('phone', $teacher->phone) }}" x-on:input="
                          let val = $el.value.replace(/[^\d+]/g, '');
                          if (val.startsWith('+') && !val.startsWith('+855')) {
                            val = '+855' + val.replace(/^\+/, '');
                          }
                          if (val.length > 1 && !val.startsWith('0') && !val.startsWith('+')) {
                            val = '0' + val;
                          }
                          $el.value = val.slice(0, 15);
                        " class="form-control w-full p-2 border px-4 rounded-lg focus:outline focus:outline-white
                               focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                               dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700
                               border-slate-300 @error('phone')
                                border-red-500
                              @enderror">
              <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Only Cambodian numbers allowed (0... or +855...)
              </p>
              @error('phone')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

            {{-- Gender --}}
            <div class="mb-2">
              <label for="gender" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Gender <span class="text-red-500">*</span>
              </label>
              <select id="gender" name="gender" required class="form-control form-select w-full p-2 border px-4 rounded-lg focus:outline focus:outline-white
                            focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                            dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700
                            border-slate-300 @error('gender') border-red-500 @enderror">
                <option value="">Select Gender</option>
                @foreach (['male' => 'Male', 'female' => 'Female', 'other' => 'Other'] as $key => $label)
                  <option value="{{ $key }}" @selected(old('gender', strtolower($teacher->gender)) == $key)>{{ $label }}
                  </option>
                @endforeach
              </select>
              @error('gender')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

            {{-- Date of Birth --}}
            <div class="mb-2">
              <label for="date_of_birth" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Date of Birth <span class="text-red-500">*</span>
              </label>
              <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                  <svg class="w-4 h-4 text-body" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z" />
                  </svg>
                </div>
                <input type="text" id="date_of_birth" name="date_of_birth" datepicker datepicker-format="yyyy-mm-dd"
                  placeholder="Enter Date of Birth" required
                  value="{{ old('date_of_birth', $teacher->date_of_birth ? \Carbon\Carbon::parse($teacher->date_of_birth)->toDateString() : '') }}"
                  class="block w-full ps-9 pe-3 py-2.5
                     bg-neutral-secondary-medium border border-default-medium
                     text-heading text-sm rounded-base
                     focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                     shadow-xs placeholder:text-body
                     dark:bg-gray-700 dark:border-gray-600 dark:text-white
                     @error('date_of_birth') border-red-500 @enderror">
              </div>
              @error('date_of_birth')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

            {{-- Address (Full Width) --}}
            <div class="mb-2 col-span-1 md:col-span-2 lg:col-span-3">
              <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Address <span class="text-red-500">*</span>
              </label>
              <textarea id="address" name="address" placeholder="Enter full address" rows="2" required
                class="form-control w-full p-2 border px-4 rounded-lg focus:outline focus:outline-white
                               focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                               dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700
                               border-slate-300 @error('address') border-red-500 @enderror">{{ old('address', $teacher->address) }}</textarea>
              @error('address')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>
          </div>
        </div>

        {{-- Professional Information Section --}}
        <div class="pt-5 pb-4 border-b border-slate-300 dark:border-slate-700">
          <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">🏫 Professional Information</h3>
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-2 gap-x-6">

            {{-- Joining Date --}}
            <div class="mb-2">
              <label for="joining_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Joining Date <span class="text-red-500">*</span>
              </label>
              <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                  <svg class="w-4 h-4 text-body" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z" />
                  </svg>
                </div>
                <input type="text" id="joining_date" name="joining_date" datepicker datepicker-format="yyyy-mm-dd"
                  placeholder="Enter Joining Date" required
                  value="{{ old('joining_date', $teacher->joining_date ? \Carbon\Carbon::parse($teacher->joining_date)->toDateString() : '') }}"
                  class="block w-full ps-9 pe-3 py-2.5
                     bg-neutral-secondary-medium border border-default-medium
                     text-heading text-sm rounded-base
                     focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                     shadow-xs placeholder:text-body
                     dark:bg-gray-700 dark:border-gray-600 dark:text-white
                     @error('joining_date') border-red-500 @enderror">
              </div>
              @error('joining_date')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

            {{-- Qualification --}}
            <div class="mb-2">
              <label for="qualification" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Qualification <span class="text-red-500">*</span>
              </label>
              <input type="text" id="qualification" name="qualification" placeholder="e.g. Master in Science" required
                value="{{ old('qualification', $teacher->qualification) }}" class="form-control w-full p-2 border px-4 rounded-lg focus:outline focus:outline-white
                               focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                               dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700
                               border-slate-300 @error('qualification') border-red-500 @enderror">
              @error('qualification')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

            {{-- Experience --}}
            <div class="mb-2">
              <label for="experience" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Experience (Years) <span class="text-red-500">*</span>
              </label>
              <input type="number" id="experience" name="experience" placeholder="e.g., 5" required
                value="{{ old('experience', $teacher->experience) }}" min="0" x-on:input="
                          if ($el.value > 60 && $el.value < 1900) $el.value = 60;
                          if ($el.value > new Date().getFullYear()) $el.value = new Date().getFullYear() - 1980;
                        " x-on:blur="
                          if ($el.value >= 1900 && $el.value <= new Date().getFullYear()) { 
                            $el.value = new Date().getFullYear() - $el.value; 
                          }
                        " class="form-control w-full p-2 border px-4 rounded-lg focus:outline focus:outline-white
                               focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                               dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700
                               border-slate-300 @error('experience')
                                border-red-500
                              @enderror">
              <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Maximum 60 years. Years like 1993 will
                auto-convert.</p>
              @error('experience')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

            {{-- Specialization --}}
            <div class="mb-2">
              <label for="specialization" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Specialization
              </label>
              <input type="text" id="specialization" name="specialization" placeholder="e.g. Mathematics"
                value="{{ old('specialization', $teacher->specialization) }}" class="form-control w-full p-2 border px-4 rounded-lg focus:outline focus:outline-white
                               focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                               dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700
                               border-slate-300 @error('specialization') border-red-500 @enderror">
              @error('specialization')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

            {{-- Salary --}}
            <div class="mb-2">
              <label for="salary" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Monthly Salary ($)
              </label>
              <input type="number" id="salary" name="salary" placeholder="0.00" step="0.01"
                value="{{ old('salary', $teacher->salary) }}" class="form-control w-full p-2 border px-4 rounded-lg focus:outline focus:outline-white
                               focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                               dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700
                               border-slate-300 @error('salary') border-red-500 @enderror">
              @error('salary')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

            {{-- CV Upload --}}
            <div class="mb-2">
              <label for="cv" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Curriculum Vitae (PDF/DOC)
              </label>
              <input type="file" id="cv" name="cv" accept=".pdf,.doc,.docx" class="w-full text-sm text-gray-500 dark:text-gray-400
                               file:mr-4 file:py-2 file:px-4
                               file:rounded-lg file:border-0
                               file:text-sm file:font-semibold
                               file:bg-indigo-50 file:text-indigo-700
                               hover:file:bg-indigo-100
                               dark:file:bg-gray-700 dark:file:text-indigo-400">
              @if ($teacher->cv)
                <p class="mt-1 text-xs text-gray-500">Current CV: {{ basename($teacher->cv) }}</p>
              @endif
              @error('cv')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>
          </div>
        </div>

        {{-- Password Change Section --}}
        <div class="pb-4 border-b border-slate-300 dark:border-slate-700">
          <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-2">🔒 Change Password</h3>
          <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
            Leave both fields empty to keep the current password.
          </p>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-y-2 gap-x-6">

            {{-- Password --}}
            <div class="mb-2">
              <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                New Password
              </label>
              <input type="password" id="password" name="password" placeholder="Enter new password (optional)" class="form-control w-full p-2 border px-4 rounded-lg focus:outline focus:outline-white
                               focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                               dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700
                               border-slate-300 @error('password') border-red-500 @enderror">
              @error('password')
                <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

            {{-- Confirm Password --}}
            <div class="mb-2">
              <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Confirm New Password
              </label>
              <input type="password" id="password_confirmation" name="password_confirmation"
                placeholder="Confirm new password" class="form-control w-full p-2 border px-4 rounded-lg focus:outline focus:outline-white
                               focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700
                               dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700
                               border-slate-300">
            </div>

          </div>
        </div>

        {{-- Form Actions --}}
        <div class="flex justify-end space-x-3 pt-6 border-t border-slate-300 dark:border-slate-700">
          <a href="{{ route('admin.teachers.index') }}"
            class="px-6 py-3 text-sm font-semibold text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-700 rounded-xl shadow-md hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors duration-200">
            Cancel
          </a>
          <button type="submit"
            class="group relative inline-flex items-center justify-center px-6 py-3 text-sm font-semibold text-white bg-gradient-to-r from-indigo-600 to-purple-700 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 ease-in-out overflow-hidden">
            <span
              class="absolute inset-0 bg-gradient-to-r from-purple-700 to-indigo-800 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
            <span class="relative flex items-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                  d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                  clip-rule="evenodd" />
              </svg>
              Update Teacher
            </span>
          </button>
        </div>
      </div>
    </form>
  </div>
@endsection