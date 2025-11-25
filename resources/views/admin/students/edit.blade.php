@extends('layouts.admin')
@section('title', 'Edit Student: ' . $student->name)
@section('content')

  <div
    class="box px-4 py-6 md:p-8 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">

    <div class="flex justify-between items-center mb-6 border-b pb-4 border-gray-200 dark:border-gray-700">
      <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
        {{-- Icon for Student (User) --}}
        <svg class="size-8 rounded-full p-1 bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
          xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
          stroke-linecap="round" stroke-linejoin="round">
          <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
          <circle cx="8.5" cy="7" r="4"></circle>
          <polyline points="17 11 19 13 23 9"></polyline>
        </svg>
        Edit Student: {{ $student->name }}
      </h3>
      <a href="{{ route('admin.students.index') }}"
        class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 transition-colors">
        Back to List
      </a>
    </div>

    {{-- Form for editing (using PUT method spoofing for Laravel resource routes) --}}
    <form action="{{ route('admin.students.update', $student) }}" method="POST" enctype="multipart/form-data"
      id="editForm" class="p-0">
      @csrf
      @method('PUT')

      <h4 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4">Account Information</h4>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">

        {{-- Name --}}
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            Full Name <span class="text-red-500">*</span>
          </label>
          <input type="text" id="name" name="name" value="{{ old('name', $student->name) }}" required
            class="w-full px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('name') border-red-500 @enderror">
          @error('name')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- Email --}}
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            Email Address <span class="text-red-500">*</span>
          </label>
          <input type="email" id="email" name="email" value="{{ old('email', $student->email) }}" required
            class="w-full px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('email') border-red-500 @enderror">
          @error('email')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- Avatar/Profile Picture --}}
        <div>
          <label for="avatar" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            Change Profile Picture (Optional)
          </label>
          @if ($student->avatar)
            <div class="flex items-center space-x-3 mb-2">
              <img src="{{ Storage::url($student->avatar) }}" alt="Current Avatar"
                class="size-10 rounded-full object-cover border border-gray-300 dark:border-gray-600">
              <span class="text-xs text-gray-500 dark:text-gray-400">Current file uploaded.</span>
            </div>
          @endif
          <input type="file" id="avatar" name="avatar"
            class="w-full px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 file:mr-4 file:py-1 file:px-2 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 @error('avatar') border-red-500 @enderror">
          @error('avatar')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>
      </div>

      <h4
        class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4 border-t pt-6 border-gray-200 dark:border-gray-700">
        Change Password (Optional)</h4>
      <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
        Leave both fields empty to keep the current password.
      </p>
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">

        {{-- Password --}}
        <div>
          <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            New Password
          </label>
          <input type="password" id="password" name="password"
            class="w-full px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('password') border-red-500 @enderror">
          @error('password')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- Confirm Password --}}
        <div>
          <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            Confirm New Password
          </label>
          <input type="password" id="password_confirmation" name="password_confirmation"
            class="w-full px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300">
        </div>
      </div>

      <h4
        class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-4 border-t pt-6 border-gray-200 dark:border-gray-700">
        Personal & Academic Details</h4>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">

        {{-- Phone --}}
        <div>
          <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            Phone Number (Optional)
          </label>
          <input type="text" id="phone" name="phone" value="{{ old('phone', $student->phone) }}"
            class="w-full px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('phone') border-red-500 @enderror">
          @error('phone')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- Date of Birth --}}
        <div>
          <label for="date_of_birth" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            Date of Birth (Optional)
          </label>
          <input type="date" id="date_of_birth" name="date_of_birth"
            value="{{ old('date_of_birth', $student->date_of_birth) }}"
            class="w-full px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('date_of_birth') border-red-500 @enderror">
          @error('date_of_birth')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- Gender --}}
        <div>
          <label for="gender" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            Gender (Optional)
          </label>
          <select id="gender" name="gender"
            class="w-full px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('gender') border-red-500 @enderror">
            <option value="">Select Gender</option>
            @foreach (['Male', 'Female', 'Other'] as $g)
              <option value="{{ $g }}" @selected(old('gender', $student->gender) == $g)>{{ $g }}</option>
            @endforeach
          </select>
          @error('gender')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- Admission Date --}}
        <div>
          <label for="admission_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            Admission Date (Optional)
          </label>
          <input type="date" id="admission_date" name="admission_date"
            value="{{ old('admission_date', $student->admission_date) }}"
            class="w-full px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('admission_date') border-red-500 @enderror">
          @error('admission_date')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- Blood Group --}}
        <div>
          <label for="blood_group" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            Blood Group (Optional)
          </label>
          <input type="text" id="blood_group" name="blood_group"
            value="{{ old('blood_group', $student->blood_group) }}" maxlength="5"
            class="w-full px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('blood_group') border-red-500 @enderror">
          @error('blood_group')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- Nationality --}}
        <div>
          <label for="nationality" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            Nationality (Optional)
          </label>
          <input type="text" id="nationality" name="nationality"
            value="{{ old('nationality', $student->nationality) }}" maxlength="50"
            class="w-full px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('nationality') border-red-500 @enderror">
          @error('nationality')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- Religion --}}
        <div>
          <label for="religion" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            Religion (Optional)
          </label>
          <input type="text" id="religion" name="religion" value="{{ old('religion', $student->religion) }}"
            maxlength="50"
            class="w-full px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('religion') border-red-500 @enderror">
          @error('religion')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- Occupation (as a potential student might be working) --}}
        <div>
          <label for="occupation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            Occupation (Optional)
          </label>
          <input type="text" id="occupation" name="occupation"
            value="{{ old('occupation', $student->occupation) }}" maxlength="100"
            class="w-full px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('occupation') border-red-500 @enderror">
          @error('occupation')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
        {{-- Company (if applicable) --}}
        <div>
          <label for="company" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            Company (Optional)
          </label>
          <input type="text" id="company" name="company" value="{{ old('company', $student->company) }}"
            maxlength="100"
            class="w-full px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('company') border-red-500 @enderror">
          @error('company')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        {{-- Address --}}
        <div class="sm:col-span-2">
          <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
            Address (Optional)
          </label>
          <textarea id="address" name="address" rows="3" maxlength="500"
            class="w-full px-3 py-2 border rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white border-slate-300 @error('address') border-red-500 @enderror">{{ old('address', $student->address) }}</textarea>
          @error('address')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>
      </div>

      <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200 dark:border-gray-700">
        <a href="{{ route('admin.students.index') }}"
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
          Update Student
        </button>
      </div>
    </form>
  </div>
@endsection
