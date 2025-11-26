@extends('layouts.admin')

@section('title', 'Users List')

@section('content')

  <div
    class="box px-2 py-4 md:p-4 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
    <h3 class="text-lg mb-3 font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
      <svg class="size-8 p-1 rounded-full bg-indigo-50 text-indigo-600 dark:text-indigo-50 dark:bg-indigo-900"
        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
        <circle cx="9" cy="7" r="4"></circle>
        <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
      </svg>
      Users List
    </h3>

    {{-- Session Messages --}}
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

    {{-- Search/Create Form --}}
    <form action="{{ route('admin.users.index') }}" method="GET">
      <div
        class="p-2 md:flex gap-2 justify-between items-center border rounded-md border-gray-200 dark:border-gray-700 bg-violet-50 dark:bg-slate-800">

        <a href="{{ route('admin.users.create') }}"
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
            <input type="search" name="search" id="searchInput" placeholder="Search users by name, email, or phone..."
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
          <a href="{{ route('admin.users.index') }}" id="resetSearch"
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

    {{-- START: Card View for Users --}}
    <div id="CardContainer" class="my-5 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
      @forelse ($users as $user)
        <div
          class="bg-white dark:bg-slate-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-lg transition-shadow duration-300 flex flex-col">

          {{-- Card Header: Avatar, Name, and Roles --}}
          <div
            class="px-4 py-3 bg-slate-50 dark:bg-slate-700 border-b border-gray-100 dark:border-slate-700 flex items-start gap-4">
            {{-- User Avatar --}}
            <img src="{{ $user->avatar ? asset($user->avatar) : asset('assets/images/cambodia.png') }}"
              alt="{{ $user->name }}" class="w-12 h-12 rounded-full object-cover">

            <div class="flex-grow">
              <h4 class="font-bold text-xl text-gray-800 dark:text-gray-200">{{ $user->name }}</h4>
              <p class="text-sm text-gray-500 dark:text-gray-400">{{ $user->email }}</p>

              {{-- Roles Badges --}}
              <div class="mt-2 flex flex-wrap gap-1">
                @foreach ($user->roles as $role)
                  <span
                    class="px-2 py-0.5 text-xs font-semibold rounded-full capitalize
                      @if ($role->name === 'admin') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                      @elseif ($role->name === 'teacher') bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200
                      @elseif ($role->name === 'student') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                      @else bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300 @endif">
                    {{ $role->name }}
                  </span>
                @endforeach
              </div>
            </div>
          </div>

          {{-- Card Body: Key Details --}}
          <div class="p-4 space-y-3 flex-grow">
            {{-- Phone & Address --}}
            <div class="flex items-center gap-3 text-sm">
              <div class="p-2 rounded-lg bg-blue-50 dark:bg-slate-700 text-blue-600 dark:text-blue-300">
                <i class="fa-solid fa-phone size-5"></i>
              </div>
              <div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Contact</p>
                <p class="font-medium text-gray-700 dark:text-gray-200">
                  {{ $user->phone ?? 'N/A' }}
                  <span class="text-xs text-gray-400 dark:text-gray-500 ml-2"> |
                    {{ $user->address ?? 'No Address' }}</span>
                </p>
              </div>
            </div>

            {{-- Conditional Stats: Teacher Specialization/Qualification --}}
            @if ($user->hasRole('teacher'))
              <div class="flex items-center gap-3 text-sm">
                <div class="p-2 rounded-lg bg-purple-50 dark:bg-slate-700 text-purple-600 dark:text-purple-300">
                  <i class="fa-solid fa-graduation-cap size-5"></i>
                </div>
                <div>
                  <p class="text-xs text-gray-500 dark:text-gray-400">Qualification / Specialization</p>
                  <p class="font-medium text-gray-700 dark:text-gray-200">
                    {{ $user->qualification ?? 'Not Specified' }}
                    <span class="text-xs text-gray-400 dark:text-gray-500 ml-2"> |
                      {{ $user->specialization ?? 'N/A' }}</span>
                  </p>
                </div>
              </div>
            @endif

            {{-- Conditional Stats: Student Admission Date / DOB --}}
            @if ($user->hasRole('student'))
              <div class="flex items-center gap-3 text-sm">
                <div class="p-2 rounded-lg bg-pink-50 dark:bg-slate-700 text-pink-600 dark:text-pink-300">
                  <i class="fa-solid fa-calendar-alt size-5"></i>
                </div>
                <div>
                  <p class="text-xs text-gray-500 dark:text-gray-400">Admission / DOB</p>
                  <p class="font-medium text-gray-700 dark:text-gray-200">
                    Admission: {{ $user->admission_date ? $user->admission_date->format('Y-m-d') : 'N/A' }}
                    <span class="text-xs text-gray-400 dark:text-gray-500 ml-2"> | DOB:
                      {{ $user->date_of_birth ? $user->date_of_birth->format('Y-m-d') : 'N/A' }}</span>
                  </p>
                </div>
              </div>
            @endif

            {{-- Generic Stats: Joining Date / Gender --}}
            <div class="flex items-center gap-3 text-sm">
              <div class="p-2 rounded-lg bg-yellow-50 dark:bg-slate-700 text-yellow-600 dark:text-yellow-300">
                <i class="fa-solid fa-calendar-check size-5"></i>
              </div>
              <div>
                <p class="text-xs text-gray-500 dark:text-gray-400">Joined / Gender</p>
                <p class="font-medium text-gray-700 dark:text-gray-200 capitalize">
                  {{ $user->joining_date ? $user->joining_date->format('Y-m-d') : 'N/A' }}
                  <span class="text-xs text-gray-400 dark:text-gray-500 ml-2"> | {{ $user->gender ?? 'N/A' }}</span>
                </p>
              </div>
            </div>
          </div>

          {{-- Card Footer: Actions --}}
          <div
            class="px-4 py-2 bg-gray-50 dark:bg-slate-700/50 border-t border-gray-100 dark:border-slate-700 flex justify-between">

            <div class="flex">
              {{-- Password Button: Triggers Password Modal --}}
              <button type="button" @click="openPasswordModal({{ $user }})"
                class="btn px-2 py-1 rounded-full flex items-center cursor-pointer text-yellow-600 dark:text-yellow-400 hover:bg-yellow-50 dark:hover:bg-slate-600 transition-colors"
                title="Reset Password">
                <i class="fa-solid fa-unlock-keyhole me-2"></i>
                Password
              </button>

              {{-- Role Button: Triggers Role Modal --}}
              <button type="button" @click="openRoleModal({{ $user }})"
                class="btn px-2 py-1 rounded-full flex items-center cursor-pointer text-green-600 dark:text-green-400 hover:bg-green-50 dark:hover:bg-slate-600 transition-colors"
                title="Change Role">
                <i class="fa-solid fa-fingerprint me-2"></i>
                Role
              </button>
            </div>
            {{-- <div class="flex">
              <a href=""
                class="btn px-2 py-1 rounded-full flex items-center cursor-pointer text-yellow-600 dark:text-yellow-400 hover:bg-yellow-50 dark:hover:bg-slate-600 transition-colors"
                title="View User">
                <i class="fa-solid fa-unlock-keyhole me-2"></i>
                Password
              </a>

              <a href=""
                class="btn px-2 py-1 rounded-full flex items-center cursor-pointer text-green-600 dark:text-green-400 hover:bg-green-50 dark:hover:bg-slate-600 transition-colors"
                title="Edit User">
                <i class="fa-solid fa-fingerprint me-2"></i>
                Role
              </a>
            </div> --}}

            <div class="flex">
              {{-- Show Button --}}
              <a href="{{ route('admin.users.show', $user->id) }}"
                class="btn px-2 py-1 rounded-full flex items-center cursor-pointer text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-slate-600 transition-colors"
                title="View User">
                <i class="fa-regular fa-eye me-2"></i>
                Show
              </a>

              {{-- Edit Button --}}
              <a href="{{ route('admin.users.edit', $user->id) }}"
                class="btn px-2 py-1 rounded-full flex items-center cursor-pointer text-yellow-600 dark:text-yellow-400 hover:bg-yellow-50 dark:hover:bg-slate-600 transition-colors"
                title="Edit User">
                <i class="fa-solid fa-pen-to-square me-2"></i>
                Edit
              </a>

              {{-- Delete Form/Button --}}
              <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                onsubmit="return confirm('Are you sure you want to delete the user \'{{ $user->name }}\'? This action cannot be undone.');">
                @csrf
                @method('DELETE')
                <button type="submit"
                  class="delete-btn px-2 py-1 rounded-full flex items-center cursor-pointer text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-slate-600 transition-colors"
                  title="Delete User">
                  <i class="fa-regular fa-trash-can me-2"></i>
                  Delete
                </button>
              </form>
            </div>
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
            <h3 class="mt-4 text-lg font-medium text-red-500 dark:text-red-500">No Users Found</h3>
            <p class="mt-1 text-sm text-red-500 dark:text-red-500">Create new users to manage your system.</p>
          </div>
        </div>
      @endforelse
    </div>
    {{-- END: Card View for Users --}}

    <div class="mt-6">
      {{-- Assuming $users is the pagination instance --}}
      {{ $users->links() }}
    </div>

  </div>

  <div x-show="isPasswordModalOpen" style="display: none;" x-transition:enter="ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
    class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">

    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
      <div @click="closeModals()" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
        aria-hidden="true"></div>

      <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
      <div
        class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
        <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
          <div class="sm:flex sm:items-start">
            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
              <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100" id="modal-title">
                Reset Password for <span x-text="currentUser ? currentUser.name : ''"
                  class="text-indigo-600 dark:text-indigo-400"></span>
              </h3>

              <div class="mt-4">
                <form :action="passwordFormAction" method="POST">
                  @csrf
                  @method('PUT')

                  <div class="mb-4">
                    <label for="modal_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                      New Password
                    </label>
                    <input type="password" name="password" id="modal_password" required
                      placeholder="Enter new password"
                      class="form-control w-full px-3 py-2 border rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 border-slate-300">
                  </div>

                  <div class="mb-4">
                    <label for="modal_password_confirmation"
                      class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                      Confirm New Password
                    </label>
                    <input type="password" name="password_confirmation" id="modal_password_confirmation" required
                      placeholder="Confirm new password"
                      class="form-control w-full px-3 py-2 border rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 border-slate-300">
                  </div>

                  <div class="mt-5 sm:mt-6 sm:flex sm:flex-row-reverse">
                    <button type="submit"
                      class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 sm:ml-3 sm:w-auto sm:text-sm">
                      Reset Password
                    </button>
                    <button @click="closeModals()" type="button"
                      class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white dark:bg-gray-700 dark:text-gray-300 text-base font-medium text-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 sm:mt-0 sm:w-auto sm:text-sm">
                      Cancel
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div x-show="isRoleModalOpen" style="display: none;" x-transition:enter="ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
    class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">

    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
      <div @click="closeModals()" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
        aria-hidden="true"></div>

      <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
      <div
        class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
        <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
          <div class="sm:flex sm:items-start">
            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
              <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100" id="modal-title">
                Change Role for <span x-text="currentUser ? currentUser.name : ''"
                  class="text-indigo-600 dark:text-indigo-400"></span>
              </h3>

              <div class="mt-4">
                <form :action="roleFormAction" method="POST">
                  @csrf
                  @method('PUT')

                  <div class="mb-4">
                    <label for="modal_role_name"
                      class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Assign New Role</label>
                    <select name="role_name" id="modal_role_name" required x-model="currentRoleName"
                      class="form-control form-select w-full px-3 py-2 border rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 border-slate-300">
                      <template x-for="role in roles" :key="role">
                        <option :value="role" :selected="role === currentRoleName"
                          x-text="role.charAt(0).toUpperCase() + role.slice(1)"></option>
                      </template>
                    </select>
                  </div>

                  <div class="mt-5 sm:mt-6 sm:flex sm:flex-row-reverse">
                    <button type="submit"
                      class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 sm:ml-3 sm:w-auto sm:text-sm">
                      Change Role
                    </button>
                    <button @click="closeModals()" type="button"
                      class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white dark:bg-gray-700 dark:text-gray-300 text-base font-medium text-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 sm:mt-0 sm:w-auto sm:text-sm">
                      Cancel
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
