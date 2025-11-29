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
            class="p-2 h-8 w-8 flex items-center justify-center cursor-pointer bg-indigo-100 dark:bg-indigo-700 hover:bg-gray-300 dark:hover:bg-indigo-600 rounded-md transition-colors dark:text-white"
            style="margin-top: 0 !important" title="Reset Search">
            <i class="fa-solid fa-arrow-rotate-right"></i>
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
          class="bg-white dark:bg-slate-800 rounded-lg shadow border border-slate-300 dark:border-gray-700 overflow-hidden hover:shadow-lg transition-shadow duration-300 flex flex-col
">
          {{-- Card Header: Avatar, Name, and Roles --}}
          <div
            class="px-4 py-2 bg-slate-50 dark:bg-slate-700 border-b border-slate-300 dark:border-slate-600 flex items-center gap-4">
            <img src="{{ $user->avatar_url }}"
              class="w-14 h-14 rounded-full object-cover border-2 border-white shadow @if ($user->deleted_at) border-red-600 @endif">

            <div class="flex-grow">
              <h4 class="font-bold text-xl text-gray-800 dark:text-gray-200">{{ $user->name }}</h4>
              <p class="text-sm text-gray-500 dark:text-gray-400">{{ $user->email }}</p>
            </div>
            {{-- Roles Badges --}}
            <div class="mt-2 flex flex-wrap gap-1">
              @foreach ($user->roles as $role)
                <span
                  class="px-2 py-1 text-xs font-semibold rounded-full capitalize
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

          {{-- Card Body: Key Details --}}
          <div class="p-4 space-y-3 flex-grow">
            {{-- Contact --}}
            <x-info.item name="{{ $user->phone ?? 'N/A' }} | {{ $user->address ?? 'No Address' }}"
              icon="fa-solid fa-phone text-xl" label="Contact" labelcolor="text-gray-500 dark:text-gray-400"
              color="" position="left" />
            {{-- Qualification (Teacher Only) --}}
            @if ($user->hasRole('teacher'))
              <x-info.item name="{{ $user->qualification ?? 'Not Specified' }} | {{ $user->specialization ?? 'N/A' }}"
                icon="fa-solid fa-graduation-cap text-xl" label="Qualification / Specialization"
                labelcolor="text-gray-500 dark:text-gray-400" color="" position="left" />
            @endif
            {{-- Admission & DOB (Student Only) --}}
            @if ($user->hasRole('student'))
              <x-info.item
                name="Admission: {{ $user->admission_date ? $user->admission_date->format('Y-m-d') : 'N/A' }} | DOB: {{ $user->date_of_birth ? $user->date_of_birth->format('Y-m-d') : 'N/A' }}"
                icon="fa-solid fa-calendar-alt text-xl" label="Admission / DOB"
                labelcolor="text-gray-500 dark:text-gray-400" color="" position="left" />
            @endif
            {{-- Joined & Gender --}}
            <x-info.item
              name="{{ $user->joining_date ? $user->joining_date->format('Y-m-d') : 'N/A' }} | {{ $user->gender ?? 'N/A' }}"
              icon="fa-solid fa-calendar-check text-xl" label="Joined / Gender"
              labelcolor="text-gray-500 dark:text-gray-400" color="" position="left" />
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
                class="btn px-2 py-1 rounded-full flex items-center cursor-pointer text-green-600 dark:text-green-400 hover:bg-green-50 dark:hover:bg-slate-600 transition-colors"
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
      class="fixed inset-0 backdrop-blur-sm bg-black/40 flex items-center justify-center z-50">
      <div x-transition.scale
        class="bg-white dark:bg-gray-800 p-6 w-80 rounded-xl shadow-2xl border border-white/20
               dark:border-gray-700/40 relative min-w-lg">
        <!-- Header -->
        <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200 flex items-center gap-2">
          <i class="fa-solid fa-key text-amber-500"></i>
          Reset Password: <span x-text="user.name"></span>
        </h2>
        <!-- Form -->
        <form :action="'/admin/users/' + user.id + '/password'" method="POST">
          @csrf
          @method('PUT')
          <!-- Input -->
          <div class="relative mb-5">
            <input type="text" name="password"
              class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600
                           rounded-md bg-gray-50 dark:bg-gray-700/50 text-gray-900 dark:text-white
                           shadow-inner focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                           transition-all duration-200"
              placeholder="Enter new password">

            <i class="fa-solid fa-lock absolute right-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
          </div>
          <!-- Buttons -->
          <div class="flex justify-end gap-2">
            <button @click.prevent="closeModals()" type="button"
              class="px-3 py-2 text-sm font-medium rounded-md
                           bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300
                           hover:bg-gray-300 dark:hover:bg-gray-600 transition-all duration-200
                           flex items-center gap-2">
              <i class="fa-solid fa-xmark"></i> Close
            </button>
            <button type="submit"
              class="px-4 py-2 text-sm font-semibold text-white rounded-md
                           bg-gradient-to-r from-green-500 to-emerald-600
                           hover:from-green-600 hover:to-emerald-700
                           shadow-lg shadow-green-500/30
                           transition-all duration-200 flex items-center gap-2">
              <i class="fa-solid fa-check-circle"></i> Update
            </button>
          </div>
        </form>
      </div>
    </div>
    {{-- ---------------------------------- --}}
    <div x-show="showRoleModal" x-cloak x-transition.opacity
      class="fixed inset-0 flex items-center justify-center backdrop-blur-sm bg-black/10  z-50 p-4">
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl w-full max-w-xl">
        <!-- Header -->
        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-4 py-2 text-white rounded-[1px_12px_0px_12px]">
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
              <i class="fas fa-user-tag text-white"></i>
            </div>
            <div>
              <h2 class="text-xl font-bold">Assign Roles</h2>
              <p class="text-indigo-100 text-sm font-bold" x-text="user.name"></p>
            </div>
          </div>
        </div>

        <form :action="'/admin/users/role/' + user.id + ''" method="POST" class="p-4">
          @csrf
          @method('PUT')

          <!-- Role Selection -->
          <div class="mb-6">
            <div class="mb-4 flex justify-between items-center">
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Select Role(s) <span class="text-red-500">*</span>
              </label>
              <!-- Selection Status -->
              <div class="flex items-center justify-between">
                <span class="text-sm text-gray-500 dark:text-gray-400">
                  Selected:
                  <span x-text="selectedRoles.length" class="font-semibold text-indigo-600 dark:text-indigo-400"></span>
                  role(s)
                </span>
              </div>
            </div>

            <!-- Role Cards Grid -->
            <div class=" gap-2 grid grid-cols-1 xl:grid-cols-2 max-h-80 overflow-y-auto pr-2">
              @foreach ($roles as $role)
                <label class="block cursor-pointer group">
                  <input type="checkbox" name="role_names[]" value="{{ $role->name }}"
                    :checked="selectedRoles.includes('{{ $role->name }}')" x-model="selectedRoles"
                    class="hidden peer">

                  <!-- Role Card -->
                  <div
                    class="border-1 border-gray-200 dark:border-gray-600 rounded-lg p-2
                                    transition-all duration-200
                                    peer-checked:border-indigo-500 peer-checked:bg-indigo-200
                                    peer-checked:dark:bg-indigo-800/50 peer-checked:dark:border-indigo-500
                                    group-hover:border-gray-300 dark:group-hover:border-gray-500
                                    group-hover:shadow-md ">

                    <div class="flex items-center justify-between">
                      <div class="flex items-center gap-2">
                        <!-- Role Icon -->
                        <div
                          class="flex-shrink-0 size-8 rounded-lg
                                                bg-gradient-to-br from-indigo-100 to-purple-100
                                                dark:from-gray-700 dark:to-gray-600
                                                peer-checked:from-indigo-200 peer-checked:to-purple-200
                                                dark:peer-checked:from-indigo-900 dark:peer-checked:to-purple-900
                                                flex items-center justify-center
                                                transition-all duration-200">
                          <i
                            class="fas text-lg
                                            {{ $role->name === 'admin' ? 'fa-crown text-yellow-500' : '' }}
                                            {{ $role->name === 'teacher' ? 'fa-chalkboard-user text-blue-500' : '' }}
                                            {{ $role->name === 'student' ? 'fa-graduation-cap text-green-500' : '' }}
                                            {{ !in_array($role->name, ['admin', 'teacher', 'student']) ? 'fa-user-gear text-gray-500' : '' }}">
                          </i>
                        </div>

                        <!-- Role Info -->
                        <div>
                          <span class="font-semibold text-gray-900 dark:text-white capitalize block">
                            {{ $role->name }}
                          </span>
                          <span class="text-xs text-gray-500 dark:text-gray-400 block mt-1">
                            @if ($role->name === 'admin')
                              Full system access
                            @elseif($role->name === 'teacher')
                              Teaching access
                            @elseif($role->name === 'student')
                              Learning access
                            @else
                              Custom role permissions
                            @endif
                          </span>
                        </div>
                      </div>

                      <!-- Checkbox Indicator -->
                      <div
                        class="flex-shrink-0 w-6 h-6 border-1 border-gray-500  dark:border-gray-500 rounded
                                flex items-center justify-center transition-all duration-200"
                        :class="{
                            'bg-indigo-600 border-indigo-500 dark:border-indigo-400 dark:bg-indigo-500': selectedRoles
                                .includes('{{ $role->name }}')
                        }">
                        <i class="ri-checkbox-circle-line text-xl transition-opacity duration-200"
                          :class="{
                              'text-white': selectedRoles.includes('{{ $role->name }}'),
                              'text-transparent': !selectedRoles.includes(
                                  '{{ $role->name }}')
                          }"></i>
                      </div>
                    </div>
                  </div>
                </label>
              @endforeach
            </div>

            <span x-show="selectedRoles.length === 0" class="text-red-500 text-xs font-medium">
              <i class="fas fa-exclamation-circle mr-1"></i>
              Please select at least one role
            </span>
          </div>

          <!-- Action Buttons -->
          <div class="flex justify-end gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
            <button @click.prevent="closeModals()" type="button"
              class="px-5 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300
                               bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600
                               rounded-lg transition-colors duration-200 flex items-center gap-2">
              <i class="fas fa-arrow-left"></i>
              Cancel
            </button>

            <button type="submit" :disabled="selectedRoles.length === 0"
              class="px-5 py-2.5 text-sm font-medium text-white
                               bg-gradient-to-r from-green-500 to-emerald-600
                               hover:from-green-600 hover:to-emerald-700 shadow-lg shadow-green-500/30
                               disabled:from-gray-400 disabled:to-gray-500 disabled:cursor-not-allowed
                               rounded-lg transition-all duration-200 flex items-center gap-2">
              <i class="fas fa-check-circle"></i>
              Update Roles
            </button>
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
