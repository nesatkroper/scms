@extends('layouts.admin')
@section('title', 'Create Role')
@section('content')

  <div class="container mx-auto px-4 py-8">
    <h2 class="text-2xl font-bold mb-4">Create New Role</h2>

    <form action="{{ route('admin.roles.store') }}" method="POST"
      class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
      @csrf

      <div class="mb-4">
        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
          Name <span class="text-red-500">*</span>
        </label>
        <input type="text" id="name" name="name" value="{{ old('name') }}"
          class="w-full px-3 py-2 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white dark:focus:bg-slate-700 border-slate-300 dark:border-slate-500"
          placeholder="Enter name" required maxlength="255">
        @error('name')
          <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
          Permissions
        </label>
        <div
          class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-2 border p-2 rounded-md border-gray-300 dark:border-gray-700">
          @foreach ($permissions as $permission)
            <div class="flex items-center space-x-2">
              <input id="permission-{{ $permission->id }}-create" name="permissions[]" type="checkbox"
                value="{{ $permission->id }}"
                class="h-4 w-4 text-indigo-600 bg-gray-100 border-gray-300 rounded focus:ring-indigo-500"
                {{ in_array($permission->id, old('permissions', [])) ? 'checked' : '' }}>
              <label for="permission-{{ $permission->id }}-create"
                class="text-sm font-medium text-gray-900 dark:text-gray-300 capitalize">
                {{ $permission->name }}
              </label>
            </div>
          @endforeach
        </div>
        @error('permissions')
          <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
        @enderror
      </div>

      <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200 dark:border-gray-700">
        <a href="{{ route('admin.roles.index') }}"
          class="px-4 py-2 cursor-pointer border border-red-500 hover:text-white hover:bg-red-600 text-red-500 rounded-md flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
              clip-rule="evenodd" />
          </svg>
          Cancel
        </a>
        <button type="submit"
          class="px-4 py-2 cursor-pointer bg-indigo-600 text-white rounded-md hover:bg-indigo-700 flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
              clip-rule="evenodd" />
          </svg>
          Create
        </button>
      </div>
    </form>
  </div>

@endsection
