@extends('layouts.admin')

@section('title', 'Roles')

@section('content')
  <div class="mx-auto px-4 sm">

    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between mb-8">

      {{-- Group 1: Title and Add Button --}}
      <div class="flex flex-col sm:flex-row sm:items-center gap-4 flex-shrink-0">
        <h1 class="text-xl font-bold text-gray-800 dark:text-gray-100 tracking-tight">Roles Management</h1>

        <a href="{{ route('admin.roles.create') }}"
          class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm
                 text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2
                 focus:ring-blue-500 dark:focus:ring-offset-gray-900 transition duration-150 ease-in-out">
          <i class="fa fa-plus -ml-1 mr-2 h-4 w-4"></i> Add Role
        </a>
      </div>

      {{-- Group 2: Search Bar --}}
      <div class="w-full md:w-96 md:ml-6 flex-shrink">
        <form action="{{ route('admin.roles.index') }}" method="GET" class="flex gap-3 items-center">
          <div class="relative flex-grow">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <i class="fa fa-search text-gray-400"></i>
            </div>
            <input type="text" name="search" placeholder="Search roles by name..." value="{{ request('search') }}"
              class="block w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-700
                     rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100
                     focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out sm:text-sm shadow-sm">
          </div>

          <button type="submit"
            class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200
                   rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition duration-150 ease-in-out shadow-sm
                   border border-gray-300 dark:border-gray-700">
            <i class="fa fa-search"></i>
            <span class="sr-only">Search</span>
          </button>

          @if (request('search'))
            <a href="{{ route('admin.roles.index') }}"
              class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg shadow-sm
                     transition duration-150 ease-in-out flex items-center">
              <i class="fa fa-times h-4 w-4"></i>
            </a>
          @endif
        </form>
      </div>
    </div>
    {{-- Alerts (Softer Style) --}}
    @if (session('success'))
      <div
        class="mb-6 p-3 rounded-lg bg-green-50 dark:bg-green-900/30 text-green-800 dark:text-green-300 border border-green-200 dark:border-green-800">
        <i class="fa fa-check-circle mr-2"></i> {{ session('success') }}
      </div>
    @endif
    @if (session('error'))
      <div
        class="mb-6 p-3 rounded-lg bg-red-50 dark:bg-red-900/30 text-red-800 dark:text-red-300 border border-red-200 dark:border-red-800">
        <i class="fa fa-exclamation-triangle mr-2"></i> {{ session('error') }}
      </div>
    @endif

    {{-- Roles Table --}}
    <div class="shadow overflow-hidden border border-gray-200 dark:border-gray-700 rounded-xl">

      <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
        <thead class="bg-gray-50 dark:bg-gray-700/50">
          <tr>
            {{-- Using your original px-4 py-3 for tighter spacing --}}
            <th scope="col"
              class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-700 dark:text-gray-300">
              #</th>
            <th scope="col"
              class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-700 dark:text-gray-300">
              Name</th>
            <th scope="col"
              class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-700 dark:text-gray-300">
              Permissions</th>
            <th scope="col"
              class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-700 dark:text-gray-300">
              Users</th>
            <th scope="col"
              class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-700 dark:text-gray-300">
              Actions</th>
          </tr>
        </thead>

        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
          @forelse($roles as $role)
            <tr>
              <td class="px-4 py-3 text-sm text-gray-500 dark:text-gray-400">{{ $role->id }}</td>
              <td class="px-4 py-3 text-sm font-medium text-gray-900 dark:text-gray-100">{{ $role->name }}</td>

              {{-- Using modern pills/badges for clarity --}}
              <td class="px-4 py-3 text-sm">
                <span
                  class="inline-flex items-center px-3 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                  {{ $role->permissions_count }}
                </span>
              </td>
              <td class="px-4 py-3 text-sm">
                <span
                  class="inline-flex items-center px-3 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                  {{ $role->users_count }}
                </span>
              </td>

              <td class="px-4 py-3 text-right whitespace-nowrap">
                <a href="{{ route('admin.roles.edit', $role->id) }}"
                  class="inline-flex px-3 py-1.5 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg text-sm transition duration-150 ease-in-out shadow-sm mr-1">
                  <i class="fa-regular fa-pen-to-square"></i>
                </a>

                <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" class="inline"
                  onsubmit="return confirm('Are you sure you want to delete the role \'{{ $role->name }}\'?');">
                  @csrf
                  @method('DELETE')

                  <button type="submit"
                    class="inline-flex px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm transition duration-150 ease-in-out shadow-sm">
                    <i class="fa-regular fa-trash-can"></i>
                  </button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="px-4 py-4 text-center text-gray-600 dark:text-gray-400">
                <i class="fa fa-info-circle mr-2"></i> No roles found.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>

      {{-- Pagination --}}
      <div class="px-4 py-3 bg-gray-50 dark:bg-gray-900">
        {{ $roles->withQueryString()->links() }}
      </div>

    </div>

  </div>
@endsection
