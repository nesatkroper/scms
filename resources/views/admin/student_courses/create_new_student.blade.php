@extends('layouts.admin')

@section('title', 'Create New Student and Enrollment')

@section('content')

  <div class="mx-auto">
    <div
      class="box px-4 py-6 md:p-8 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">

      <div class="flex justify-between items-center mb-6 border-b pb-4 border-gray-200 dark:border-gray-700">
        <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
          {{-- Icon for Create Student and Enrollment --}}
          <svg class="size-8 rounded-full p-1 bg-green-50 text-green-600 dark:text-green-50 dark:bg-green-900"
            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path
              d="M10 9a3 3 0 100-6 3 3 0 000 6zM9.013 14H1.325a6 6 0 0110.15-4.498.99.99 0 01-1.428.985A4 4 0 009.013 14zM16 11h-1v-1a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2z" />
          </svg>
          Enroll New Student in: {{ $courseOffering?->subject?->name ?? 'Course' }}
        </h3>
        {{-- Back to Register Button --}}
        <a href="{{ route('admin.student_courses.index', ['course_offering_id' => $courseOfferingId]) }}"
          class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 transition-colors">
          Back to Register
        </a>
      </div>

      <form action="{{ route('admin.student_courses.store.new_student') }}" method="POST" class="p-0">
        @csrf

        <input type="hidden" name="course_offering_id" value="{{ $courseOfferingId }}">
        <input type="hidden" name="status" value="studying"> {{-- Default Status --}}

        {{-- NEW STUDENT DETAILS SECTION --}}
        <h4 class="text-lg font-semibold text-indigo-600 dark:text-indigo-400 mb-4 border-b pb-2">
          Student Personal Information
        </h4>

        <div class="space-y-6 mb-8">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- 1. Name Field --}}
            <div>
              <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Full Name <span class="text-red-500">*</span>
              </label>
              <input type="text" name="name" id="name" required value="{{ old('name') }}"
                class="w-full px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('name') border-red-500 @enderror">
              @error('name')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
              @enderror
            </div>

            {{-- 2. Email Field --}}
            <div>
              <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Email Address <span class="text-red-500">*</span>
              </label>
              <input type="email" name="email" id="email" required value="{{ old('email') }}"
                class="w-full px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('email') border-red-500 @enderror">
              @error('email')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
              @enderror
            </div>

            {{-- 3. Password Field --}}
            <div>
              <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Initial Password <span class="text-red-500">*</span>
              </label>
              <input type="password" name="password" id="password" required
                class="w-full px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('password') border-red-500 @enderror">
              @error('password')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
              @enderror
            </div>

            {{-- 4. Phone Field --}}
            <div>
              <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Phone (Optional)
              </label>
              <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                class="w-full px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('phone') border-red-500 @enderror">
              @error('phone')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
              @enderror
            </div>

            {{-- 5. Date of Birth Field --}}
            <div>
              <label for="date_of_birth" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Date of Birth (Optional)
              </label>
              <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}"
                class="w-full px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('date_of_birth') border-red-500 @enderror">
              @error('date_of_birth')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
              @enderror
            </div>

            {{-- 6. Gender Field --}}
            <div>
              <label for="gender" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Gender (Optional)
              </label>
              <select name="gender" id="gender"
                class="w-full px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('gender') border-red-500 @enderror">
                <option value="" disabled {{ old('gender') == '' ? 'selected' : '' }}>Select Gender</option>
                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
              </select>
              @error('gender')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
              @enderror
            </div>
          </div>

          {{-- Address Field (Full Width) --}}
          <div>
            <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              Address (Optional)
            </label>
            <textarea name="address" id="address" rows="2"
              class="w-full border-gray-300 p-3 dark:border-gray-600 dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('address') border-red-500 @enderror">{{ old('address') }}</textarea>
            @error('address')
              <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
          </div>
        </div>

        {{-- ENROLLMENT DETAILS SECTION --}}
        <h4 class="text-lg font-semibold text-indigo-600 dark:text-indigo-400 mb-4 border-b pb-2 pt-4">
          Enrollment Details for {{ $courseOffering?->subject?->name ?? 'Course' }}
        </h4>

        <div class="space-y-6">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- 1. Admission Date Field --}}
            <div>
              <label for="admission_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Admission Date (Optional, defaults to today)
              </label>
              <input type="date" name="admission_date" id="admission_date"
                value="{{ old('admission_date', now()->toDateString()) }}"
                class="w-full px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('admission_date') border-red-500 @enderror">
              @error('admission_date')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
              @enderror
            </div>

            {{-- 2. Payment Status Field (Select) --}}
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

          {{-- Remarks Field (Textarea) --}}
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
          <a href="{{ route('admin.student_courses.index', ['course_offering_id' => $courseOfferingId]) }}"
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
            Create Student & Enroll
          </button>
        </div>
      </form>
    </div>
  </div>

@endsection
