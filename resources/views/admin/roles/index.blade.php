@extends('layouts.admin')

@section('title', 'Roles List')

@section('content')

  <div
    class="box px-2 py-4 md:p-4 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
    <h3 class="text-lg mb-3 font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
      <svg class="size-8 p-1 rounded-full bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M12 2L2 7l10 5 10-5-10-5z" />
        <path d="M2 17l10 5 10-5" />
        <path d="M2 12l10 5 10-5" />
      </svg>
      Roles List
    </h3>

    @if (session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
      </div>
    @endif
    @if (session('error'))
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
      </div>
    @endif

    <form action="{{ route('admin.roles.index') }}" method="GET">
      <div
        class="p-2 md:flex gap-2 justify-between items-center border rounded-md border-gray-200 dark:border-gray-700 bg-violet-50 dark:bg-slate-800">

        <a href="{{ route('admin.roles.create') }}"
          class="text-nowrap px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 cursor-pointer transition-colors flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
              clip-rule="evenodd" />
          </svg>
          Create New Role
        </a>

        <div class="flex items-center mt-3 md:mt-0 gap-2">
          <div class="relative w-full">
            <input type="search" name="search" id="searchInput" placeholder="Search roles by name..."
              class="w-full border border-gray-300 dark:border-gray-500 dark:bg-gray-700 text-sm rounded-lg pl-8 pr-2 py-1.5
                focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-800 dark:text-gray-100"
              value="{{ request('search') }}">
            <i class="fas fa-search absolute left-2.5 top-2.5 text-gray-400 text-xs"></i>
          </div>

          <button type="submit"
            class="p-2 h-8 w-8 flex items-center justify-center cursor-pointer bg-indigo-600 dark:bg-indigo-700 hover:bg-indigo-700 dark:hover:bg-indigo-600 rounded-md transition-colors text-white"
            title="Search">
            <i class="fas fa-search text-white text-xs"></i>
          </button>
          <a href="{{ route('admin.roles.index') }}" id="resetSearch"
            class="p-2 h-8 w-8 flex items-center justify-center cursor-pointer bg-indigo-100 dark:bg-indigo-700 hover:bg-gray-300 dark:hover:bg-indigo-600 rounded-md transition-colors"
            title="Reset Search">
            <svg class="h-5 w-5 text-indigo-600 dark:text-gray-300" fill="none" stroke="currentColor"
              viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 4v5h.582m15.356-2A8.98 8.98 0 0020 12a9 9 0 11-8-9.98l-7.9 7.9M2 12h2"></path>
            </svg>
          </a>
        </div>
      </div>
    </form>

    {{-- START: Card View for Roles --}}
    <div id="CardContainer" class="my-5 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
      @forelse ($roles as $role)
        <div
          class="bg-white dark:bg-slate-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-lg transition-shadow duration-300">

          {{-- Card Header: Role Name --}}
          <div
            class="px-4 py-3 bg-slate-50 dark:bg-slate-700 border-b border-gray-100 dark:border-slate-700 flex justify-between items-center">
            <h4 class="font-bold text-xl text-gray-800 dark:text-gray-200 capitalize">
              {{ $role->name }}
            </h4>
            <svg class="size-6 text-indigo-600 dark:text-indigo-400" xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
              stroke-linejoin="round">
              <rect x="18" y="5" width="4" height="14"></rect>
              <path d="M14 10V8a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-2"></path>
            </svg>
          </div>

          {{-- Card Body: Stats --}}
          <div class="p-4 space-y-3">
            {{-- Permissions Count --}}
            <div class="flex items-center gap-3 text-sm">
              <div class="p-2 rounded-lg bg-blue-50 dark:bg-slate-700 text-blue-600 dark:text-blue-300">
                <i class="fa-solid fa-key size-5"></i>
              </div>
              <div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Permissions</p>
                <p class="font-medium text-gray-700 dark:text-gray-200">
                  <span class="text-sm text-blue-600 dark:text-blue-400">{{ $role->permissions->count() }}</span>
                  Total
                </p>
              </div>
            </div>

            {{-- Users Assigned Count --}}
            <div class="flex items-center gap-3 text-sm">
              <div class="p-2 rounded-lg bg-green-50 dark:bg-slate-700 text-green-600 dark:text-green-300">
                <i class="fa-solid fa-users size-5"></i>
              </div>
              <div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Users Assigned</p>
                <p class="font-medium text-gray-700 dark:text-gray-200">
                  <span class="text-sm text-green-600 dark:text-green-400">{{ $role->users()->count() }}</span>
                  Users
                </p>
              </div>
            </div>
          </div>

          {{-- Card Footer: Actions --}}
          <div
            class="px-4 py-2 bg-gray-50 dark:bg-slate-700/50 border-t border-gray-100 dark:border-slate-700 flex justify-end gap-2">

            {{-- Edit Button --}}
            <a href="{{ route('admin.roles.edit', $role->id) }}"
              class="btn px-3 py-1 rounded-lg flex items-center cursor-pointer text-yellow-600 dark:text-yellow-400 hover:bg-yellow-50 dark:hover:bg-slate-600 transition-colors"
              title="Edit Role">
              <i class="fa-solid fa-pen-to-square me-2"></i>
              Edit
            </a>

            {{-- Delete Form/Button --}}
            <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST"
              onsubmit="return confirm('Are you sure you want to delete the role \'{{ $role->name }}\'? This action cannot be undone.');">
              @csrf
              @method('DELETE')
              <button type="submit"
                class="delete-btn px-3 py-1 rounded-lg flex items-center cursor-pointer text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-slate-600 transition-colors"
                title="Delete Role">
                <i class="fa-regular fa-trash-can me-2"></i>
                Delete
              </button>
            </form>
          </div>
        </div>
      @empty
        <div class="col-span-full py-12 text-center">
          <div
            class="max-w-md mx-auto p-6 bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700">
            <div class="mx-auto h-16 w-16 rounded-full bg-red-50 dark:bg-slate-700 flex items-center justify-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-400 dark:text-red-500" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                  d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <h3 class="mt-4 text-lg font-medium text-red-500 dark:text-red-500">No Roles Found</h3>
            <p class="mt-1 text-sm text-red-500 dark:text-red-500">You must create roles to manage user permissions.
            </p>
          </div>
        </div>
      @endforelse
    </div>
    {{-- END: Card View for Roles --}}

    <div class="mt-6">
      {{ $roles->links() }}
    </div>

  </div>
@endsection

{{-- @extends('layouts.admin')

@section('title', 'Roles List')

@section('content')

  <div
    class="box px-2 py-4 md:p-4 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
    <h3 class="text-lg mb-3 font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
      <!-- Icon for Roles (e.g., briefcase or key) -->
      <svg class="size-8 p-1 rounded-full bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M12 2L2 7l10 5 10-5-10-5z" />
        <path d="M2 17l10 5 10-5" />
        <path d="M2 12l10 5 10-5" />
      </svg>
      Roles List
    </h3>

    @if (session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
      </div>
    @endif
    @if (session('error'))
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
      </div>
    @endif

    <form action="{{ route('admin.roles.index') }}" method="GET">
      <div
        class="p-2 md:flex gap-2 justify-between items-center border rounded-md border-gray-200 dark:border-gray-700 bg-violet-50 dark:bg-slate-800">

        <a href="{{ route('admin.roles.create') }}"
          class="text-nowrap px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 cursor-pointer transition-colors flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
              d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
              clip-rule="evenodd" />
          </svg>
          Create New Role
        </a>

        <div class="flex items-center mt-3 md:mt-0 gap-2">
          <div class="relative w-full">
            <input type="search" name="search" id="searchInput" placeholder="Search roles by name..."
              class="w-full border border-gray-300 dark:border-gray-500 dark:bg-gray-700 text-sm rounded-lg pl-8 pr-2 py-1.5
                focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-800 dark:text-gray-100"
              value="{{ request('search') }}">
            <i class="fas fa-search absolute left-2.5 top-2.5 text-gray-400 text-xs"></i>
          </div>

          <button type="submit"
            class="p-2 h-8 w-8 flex items-center justify-center cursor-pointer bg-indigo-600 dark:bg-indigo-700 hover:bg-indigo-700 dark:hover:bg-indigo-600 rounded-md transition-colors text-white"
            title="Search">
            <i class="fas fa-search text-white text-xs"></i>
          </button>
          <a href="{{ route('admin.roles.index') }}" id="resetSearch"
            class="p-2 h-8 w-8 flex items-center justify-center cursor-pointer bg-indigo-100 dark:bg-indigo-700 hover:bg-gray-300 dark:hover:bg-indigo-600 rounded-md transition-colors"
            title="Reset Search">
            <svg class="h-5 w-5 text-indigo-600 dark:text-gray-300" fill="none" stroke="currentColor"
              viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 4v5h.582m15.356-2A8.98 8.98 0 0020 12a9 9 0 11-8-9.98l-7.9 7.9M2 12h2"></path>
            </svg>
          </a>
        </div>
      </div>
    </form>

    <div class="overflow-x-auto mt-6 shadow-md sm:rounded-lg">
      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="px-6 py-3">Role Name</th>
            <th scope="col" class="px-6 py-3 text-center">Permissions Count</th>
            <th scope="col" class="px-6 py-3 text-center">Users Assigned</th>
            <th scope="col" class="px-6 py-3 text-right">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($roles as $role)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
              <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white capitalize">
                {{ $role->name }}
              </th>
              <td class="px-6 py-4 text-center">
                <span
                  class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                  {{ $role->permissions->count() }}
                </span>
              </td>
              <td class="px-6 py-4 text-center">
                <!-- Spatie stores user counts via the 'model_has_roles' pivot table -->
                <span
                  class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                  {{ $role->users()->count() }}
                </span>
              </td>
              <td class="px-6 py-4 text-right whitespace-nowrap">
                <div class="flex justify-end gap-2">

                  <a href="{{ route('admin.roles.edit', $role->id) }}"
                    class="btn p-2 rounded-full flex justify-center items-center cursor-pointer text-yellow-600 dark:text-yellow-400 hover:bg-yellow-50 dark:hover:bg-slate-600 transition-colors"
                    title="Edit Role">
                    <i class="fa-solid fa-pen-to-square text-sm"></i>
                  </a>

                  <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete the role \'{{ $role->name }}\'? This action cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                      class="delete-btn p-2 rounded-full flex justify-center items-center cursor-pointer text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-slate-600 transition-colors"
                      title="Delete Role">
                      <i class="fa-regular fa-trash-can text-sm"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="4" class="py-12 text-center bg-gray-50 dark:bg-gray-700">
                <div
                  class="max-w-md mx-auto p-6 bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 dark:border-slate-700">
                  <div
                    class="mx-auto h-16 w-16 rounded-full bg-red-50 dark:bg-slate-700 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-400 dark:text-red-500" fill="none"
                      viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                  </div>
                  <h3 class="mt-4 text-lg font-medium text-red-500 dark:text-red-500">No Roles Found</h3>
                  <p class="mt-1 text-sm text-red-500 dark:text-red-500">You must create roles to manage user
                    permissions.
                  </p>
                </div>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="mt-6">
      {{ $roles->links() }}
    </div>

  </div>
@endsection --}}
