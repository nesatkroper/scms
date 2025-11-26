@extends('layouts.admin')

@section('title', 'Users List')

@section('content')

  {{-- <div
    class="box px-2 py-4 md:p-4 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm"> --}}
  <div x-data="userModals()"
    class="box px-2 py-4 md:p-4 bg-white dark:bg-gray-800 sm:rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm mb-10">

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
    <div id="CardContainer" class="my-5 grid grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3 gap-4">
      <script>
        window.UsersData = @json($users->items() ?? $users);
      </script>

      @forelse ($users as $user)
        <div
          class="bg-white dark:bg-slate-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-lg transition-shadow duration-300 flex flex-col @if ($user->hasRole('admin')) border border-red-300 dark:border-red-700 @endif
">

          {{-- Card Header: Avatar, Name, and Roles --}}
          <div
            class="px-4 py-3 bg-slate-50 dark:bg-slate-700 border-b border-gray-100 dark:border-slate-700 flex items-start gap-4">
            <img src="{{ $user->avatar_url }}" class="w-12 h-12 rounded-full object-cover">

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
                      @else bg-purple-100 text-purple-800 dark:bg-purple-700 dark:text-purple-300 @endif ">
                    <i class="fa-solid fa-shield-halved"></i>
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

              <button type="button" @click="openPasswordModal({{ $user->id }})"
                class="btn px-2 py-1 rounded-full flex items-center cursor-pointer text-yellow-600 dark:text-yellow-400 hover:bg-yellow-50 dark:hover:bg-slate-600 transition-colors">
                <i class="fa-solid fa-unlock-keyhole me-2"></i>
                Password
              </button>

              <button type="button" @click="openRoleModal({{ $user->id }})"
                class="btn px-2 py-1 rounded-full flex items-center cursor-pointer text-green-600 dark:text-green-400 hover:bg-green-50 dark:hover:bg-slate-600 transition-colors">
                <i class="fa-solid fa-fingerprint me-2"></i>
                Role
              </button>

              {{-- <button type="button"
                class="btn px-2 py-1 rounded-full flex items-center cursor-pointer text-yellow-600 dark:text-yellow-400 hover:bg-yellow-50 dark:hover:bg-slate-600 transition-colors"
                title="Reset Password">
                <i class="fa-solid fa-unlock-keyhole me-2"></i>
                Password
              </button>

              <button type="button"
                class="btn px-2 py-1 rounded-full flex items-center cursor-pointer text-green-600 dark:text-green-400 hover:bg-green-50 dark:hover:bg-slate-600 transition-colors"
                title="Change Role">
                <i class="fa-solid fa-fingerprint me-2"></i>
                Role
              </button> --}}
            </div>

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

    <div x-show="showPasswordModal" x-cloak x-transition.opacity
      class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
      <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-80">
        <h2 class="text-lg font-bold mb-3">Reset Password: <span x-text="user.name"></span></h2>

        <form :action="'/admin/users/' + user.id + '/password'" method="POST">
          @csrf
          @method('PUT')

          <input type="text" name="password"
            class="w-full border rounded px-3 py-2 mb-3 dark:bg-gray-700 dark:text-white" placeholder="New Password">

          <div class="flex justify-end gap-2">
            <button @click.prevent="closeModals()" type="button"
              class="px-3 py-1 bg-gray-300 dark:bg-gray-700 rounded">Close</button>

            <button type="submit" class="px-3 py-1 bg-green-600 text-white rounded">Update</button>
          </div>
        </form>
      </div>
    </div>

    <div x-show="showRoleModal" x-cloak x-transition.opacity
      class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
      <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-[28rem]">
        <h2 class="text-lg font-bold mb-3">
          Change Roles: <span x-text="user.name"></span>
        </h2>

        @php
          $allRoles = $roles;

          $inputClasses =
              'form-control w-full px-3 py-2 border rounded-md focus:outline focus:outline-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:bg-slate-100 dark:focus:bg-slate-700 border-slate-300';

          $fileClasses =
              'form-control w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 dark:file:bg-gray-700 dark:file:text-white dark:hover:file:bg-gray-600';
        @endphp

        <form :action="'/admin/users/role/' + user.id + ''" method="POST">
          @csrf
          @method('PUT')

          {{-- Role Multi-Select --}}
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              User Role(s) <span class="text-red-500">*</span>
            </label>

            <div class="flex flex-wrap gap-x-6 gap-y-2 p-3 border rounded-md dark:border-gray-600">
              @foreach ($roles as $role)
                <label
                  class="flex items-center text-sm font-medium text-gray-700 dark:text-gray-300 capitalize cursor-pointer">
                  <input type="checkbox" name="role_names[]" value="{{ $role->name }}"
                    :checked="selectedRoles.includes('{{ $role->name }}')" x-model="selectedRoles"
                    class="form-checkbox h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-offset-gray-800">

                  {{-- <input type="checkbox" name="role_names[]" value="{{ $role->name }}" x-model="selectedRoles"
                    :checked="selectedRoles.includes('{{ $role->name }}')"
                    class="form-checkbox h-4 w-4 text-indigo-600" /> --}}

                  <span class="ml-2">{{ $role->name }}</span>
                </label>
              @endforeach
            </div>
          </div>

          <div class="flex justify-end gap-2">
            <button @click.prevent="closeModals()" type="button"
              class="px-3 py-1 bg-gray-300 dark:bg-gray-700 rounded">Close</button>

            <button type="submit" class="px-3 py-1 bg-green-600 text-white rounded">Update</button>
          </div>
        </form>
      </div>
    </div>

  </div>
@endsection

@push('script')
  <script>
    document.getElementById('resetSearch').addEventListener('click', e => {
      document.getElementById('searchInput').value = '';
    });
  </script>
  <script>
    function userModals() {
      return {
        showPasswordModal: false,
        showRoleModal: false,

        user: {},

        openPasswordModal(id) {
          this.user = window.UsersData.find(u => u.id === id);
          this.showPasswordModal = true;
        },

        openRoleModal(id) {
          this.user = window.UsersData.find(u => u.id === id);
          this.selectedRoles = this.user.roles.map(r => r.name);
          this.showRoleModal = true;
        },

        closeModals() {
          this.showPasswordModal = false;
          this.showRoleModal = false;
        }
      }
    }
  </script>
@endpush

@push('styles')
  <style>
    [x-cloak] {
      display: none !important;
    }
  </style>
@endpush
