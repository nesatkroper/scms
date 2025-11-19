@extends('layouts.admin')
@section('title', 'Users')

@section('content')

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

  @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
      <strong class="font-bold">Validation Failed!</strong>
      <span class="block sm:inline">Please check the form on the create or edit page for specific errors.</span>
    </div>
  @endif

  <div
    class="box px-2 py-4 md:p-4 bg-white mb-16 dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm min-h-[80vh]">
    <h3 class="text-lg mb-3 font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
      <svg class="size-8 p-1 rounded-full bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
      </svg>
      Users List
    </h3>

    <div
      class="p-2 md:flex gap-2 justify-between items-center border rounded-md border-gray-200 dark:border-gray-700 bg-violet-50 dark:bg-slate-800">

      <a href="{{ route('admin.users.create') }}" id="createRedirectLink"
        class="text-nowrap px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 cursor-pointer transition-colors flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd"
            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
            clip-rule="evenodd" />
        </svg>
        Create New User
      </a>

      <div class="flex items-center mt-3 md:mt-0 gap-2">
        <div class="relative w-full">
          <input type="search" id="searchInput" placeholder="Search Users..."
            class="w-full border border-gray-300 dark:border-gray-500 dark:bg-gray-700 text-sm rounded-lg pl-8 pr-2 py-1.5
                        focus:outline-none focus:ring-2 focus:ring-indigo-500 text-gray-800 dark:text-gray-100">
          <i class="fas fa-search absolute left-2.5 top-2.5 text-gray-400 text-xs"></i>
        </div>
        <button id="resetSearch"
          class="p-2 h-8 w-8 flex items-center justify-center cursor-pointer bg-indigo-100 dark:bg-indigo-700 hover:bg-gray-300 dark:hover:bg-indigo-600 rounded-md transition-colors">
          <i class="ri-reset-right-line text-indigo-600 dark:text-gray-300 text-xl"></i>
        </button>
      </div>
    </div>

    <form action="{{ route('admin.users.index') }}" method="GET" id="FilterForm" class="space-y-4">
      <div class="flex items-center space-x-4 my-4">

        <label for="roleFilterSelect" class="text-sm font-medium text-gray-700 dark:text-gray-300">Filter by Role:</label>

        <select id="roleFilterSelect" name="role_filter" onchange="this.form.submit()"
          class="px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm dark:bg-gray-700 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
          <option value="">All Roles</option>
          @foreach ($roles as $role)
            <option value="{{ $role->name }}" @selected($role->name == ($roleFilter ?? null))>
              {{ Str::title($role->name) }}
            </option>
          @endforeach
        </select>

        @if (request('search'))
          <input type="hidden" name="search" value="{{ request('search') }}">
        @endif

      </div>
    </form>

    <div id="TableContainer" class="table-respone overflow-y-hidden overflow-x-auto">
      <table class="w-full text-sm text-left">
        <thead class="bg-gray-50 dark:bg-gray-700/50 text-xs text-gray-700 dark:text-gray-400 uppercase">
          <tr class="text-nowrap">
            <th scope="col" class="px-4 py-4">User Name</th>
            <th scope="col" class="px-4 py-4">Role</th>
            <th scope="col" class="px-4 py-4">Email</th>
            <th scope="col" class="px-4 py-4">Phone</th>
            <th scope="col" class="px-4 py-4">Joining Date</th>
            <th scope="col" class="px-4 py-4">Gender</th>
            <th scope="col" class="px-4 py-4 text-center">Actions</th>
          </tr>
        </thead>
        <tbody>
          @if ($users->count() > 0)
            @foreach ($users as $item)
              <tr
                class="bg-white dark:bg-gray-800 border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">

                <td class="px-4 py-2 whitespace-nowrap text-gray-900 dark:text-white capitalize">
                  <div class="flex items-center space-x-3">
                    <div
                      class="flex-shrink-0 size-8 rounded-full bg-indigo-500 text-white flex items-center justify-center text-xs font-semibold overflow-hidden">
                      @if ($item->avatar ?? false)
                        <img src="{{ asset($item->avatar) }}" alt="{{ $item->name }} avatar"
                          class="size-full object-cover">
                      @else
                        {{ strtoupper(substr($item->name, 0, 2)) }}
                      @endif
                    </div>
                    <span class="font-medium text-gray-800 dark:text-gray-200">
                      {{ $item->name }}
                    </span>
                  </div>
                </td>

                <td class="px-4 py-2 whitespace-nowrap text-gray-900 dark:text-white capitalize">
                  {{ Str::title($item->roles->first()?->name ?? 'N/A') }}
                </td>

                <td class="px-4 py-2 whitespace-nowrap text-gray-900 dark:text-white capitalize">
                  {{ $item->email }}
                </td>

                <td class="px-4 py-2 whitespace-nowrap text-gray-900 dark:text-white capitalize">
                  {{ $item->phone }}
                </td>

                <td class="px-4 py-2 whitespace-nowrap text-gray-900 dark:text-white capitalize">
                  {{ $item->joining_date ? \Carbon\Carbon::parse($item->joining_date)->format('M d, Y') : 'N/A' }}
                </td>

                <td class="px-4 py-2 whitespace-nowrap text-gray-900 dark:text-white capitalize">
                  {{ $item->gender }}
                </td>

                <td class="px-4 py-2 text-right">
                  <div class="flex items-center justify-end space-x-2 text-nowrap">

                    <a href="{{ route('admin.users.edit', $item->id) }}" title="Edit Id({{ $item->id }})"
                      class="edit-btn text-indigo-600 dark:text-indigo-500 hover:text-indigo-800 dark:hover:text-indigo-400 transition-colors p-1"
                      data-id="{{ $item->id }}">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path
                          d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                      </svg>
                    </a>

                    <button type="button" title="Delete Id({{ $item->id }})"
                      class="delete-btn text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 transition-colors p-1"
                      data-id="{{ $item->id }}">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                          d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                          clip-rule="evenodd" />
                      </svg>
                    </button>
                  </div>
                </td>
              </tr>
            @endforeach
          @else
            <tr>
              <td colspan="7" class="p-4 text-center">
                <div class="py-8 text-center text-gray-500 dark:text-gray-400">
                  <p class="text-lg font-semibold">No Users Found</p>
                  <p class="text-sm">Create your first users to get started</p>
                </div>
              </td>
            </tr>
          @endif
        </tbody>
      </table>
    </div>

    <div class="my-4">
      {{ $users->links() }}
    </div>

  </div>

  <div id="Modaldelete" class="fixed inset-0 z-50 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen p-4 text-center">
      <div class="fixed inset-0 transition-opacity" aria-hidden="true">
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
      </div>

      <div
        class="inline-block align-bottom bg-white dark:bg-gray-700 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:align-middle sm:max-w-lg sm:w-full">
        <div class="bg-white dark:bg-gray-700 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
          <div class="sm:flex sm:items-start">
            <div
              class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
              <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.3 16c-.77 1.333.192 3 1.732 3z" />
              </svg>
            </div>
            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
              <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white" id="modal-title">
                Delete User
              </h3>
              <div class="mt-2">
                <p class="text-sm text-gray-500 dark:text-gray-300">
                  Are you sure you want to delete this User? This action cannot be undone.
                </p>
              </div>
            </div>
          </div>
        </div>
        <form id="Formdelete" method="POST">
          @csrf
          @method('DELETE')
          <div class="bg-gray-50 dark:bg-gray-800 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
            <button type="submit"
              class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
              Delete
            </button>
            <button type="button" onclick="hideModal('Modaldelete')"
              class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm dark:bg-gray-600 dark:text-white dark:hover:bg-gray-500 dark:border-gray-600">
              Cancel
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div id="modalBackdrop" class="fixed inset-0 bg-black/50 z-40 hidden backdrop-blur-sm"></div>

@endsection

@push('scripts')
  <script src="{{ asset('assets/js/modal.js') }}"></script>
  <script>
    function showModal(id) {
      document.getElementById(id).classList.remove('hidden');
      document.getElementById('modalBackdrop').classList.remove('hidden');
    }

    function hideModal(id) {
      document.getElementById(id).classList.add('hidden');
      document.getElementById('modalBackdrop').classList.add('hidden');
    }

    document.addEventListener('DOMContentLoaded', function() {
      const searchInput = document.getElementById('searchInput');
      const resetSearch = document.getElementById('resetSearch');
      const filterForm = document.getElementById('FilterForm');

      function submitSearch() {
        const currentUrl = new URL(filterForm.action);
        currentUrl.searchParams.set('search', searchInput.value);
        currentUrl.searchParams.delete('page');

        const roleFilter = document.getElementById('roleFilterSelect').value;
        if (roleFilter) {
          currentUrl.searchParams.set('role_filter', roleFilter);
        } else {
          currentUrl.searchParams.delete('role_filter');
        }

        window.location.href = currentUrl.toString();
      }

      searchInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
          e.preventDefault();
          submitSearch();
        }
      });

      resetSearch.addEventListener('click', () => {
        searchInput.value = '';
        const currentUrl = new URL(filterForm.action);
        currentUrl.searchParams.delete('search');
        currentUrl.searchParams.delete('page');
        currentUrl.searchParams.delete('role_filter');
        window.location.href = currentUrl.toString();
      });

      function handleDeleteClick(e) {
        e.preventDefault();
        const Id = this.dataset.id;
        const deleteForm = document.getElementById('Formdelete');
        deleteForm.setAttribute('action', `{{ url('admin/users') }}/${Id}`);
        showModal('Modaldelete');
      }

      function attachRowEventHandlers() {
        document.querySelectorAll('.delete-btn').forEach(btn => {
          btn.removeEventListener('click', handleDeleteClick);
          btn.addEventListener('click', handleDeleteClick);
        });
      }

      attachRowEventHandlers();
    });
  </script>
@endpush
