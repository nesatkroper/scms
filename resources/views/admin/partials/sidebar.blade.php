@php

@endphp

<aside id="sidebar"
  class="sidebar bg-indigo-800 dark:bg-slate-800 border-r border-gray-200 dark:border-gray-700 text-white fixed h-full z-30 left-0 top-0 w-64 md:translate-x-0 -translate-x-full">
  <!-- Sidebar header -->
  <div class="flex items-center justify-between p-4 border-b border-indigo-700 dark:border-gray-700">
    <div class="flex items-center space-x-2">
      <img
        src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='white' width='24' height='24'%3E%3Cpath d='M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3zm6.82 6L12 12.72 5.18 9 12 5.28 18.82 9zM17 15.99l-5 2.73-5-2.73v-3.72L12 15l5-2.73v3.72z'/%3E%3C/svg%3E"
        alt="Logo" class="hidden md:block w-8 h-8">
      <h1 class="text-lg font-bold sidebar-text text-hidden">SCMS G2</h1>
    </div>
    <button id="close-sidebar"
      class="md:hidden text-red-400 hover:bg-red-50 dark:hover:bg-gray-700 cursor-pointer rounded-full p-1 hover:text-red-500">
      <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
        </path>
      </svg>
    </button>
  </div>
  <!-- Sidebar menu -->
  <nav class="pt-4 flex-grow overflow-y-auto">
    <ul>
      <!-- Dashboard -->
      <li class="menu-item relative">
        <a href="{{ route('admin.home') }}"
          class="flex items-center justify-between px-4 py-3 hover:bg-indigo-700 dark:hover:bg-gray-700 rounded-lg mx-2 transition-all duration-200">
          <div class="wr-icon flex items-center">
            <i class="fas fa-tachometer-alt text-center"></i>
            <span class="ml-3 sidebar-text text-hidden">Dashboard</span>
          </div>
          <span class="menu-tooltip">Dashboard</span>
        </a>
      </li>
      <li class="separator border-b border-white/10 dark:border-gray-700/50 px-2 pb-2 my-2"></li>
      <!-- Academics -->
      <li class="menu-item relative">
        <div
          class="flex items-center justify-between px-4 py-3 hover:bg-indigo-700 dark:hover:bg-gray-700 rounded-lg mx-2 cursor-pointer transition-all duration-200 js-submenu-toggle">
          <div class="wr-icon flex items-center">
            <i class="ri-graduation-cap-fill text-lg"></i>
            <span class="ml-3 sidebar-text text-hidden">Academics</span>
          </div>
          <i class="fas fa-chevron-right menu-icon text-xs sidebar-text text-hidden"></i>
          <span class="menu-tooltip">Academics</span>
        </div>
        <div class="submenu">
          <ul class="pl-4 pr-4">
            <li><a href="{{ route('admin.departments.index') }}"
                class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300 capitalize">departments</a>
            </li>
            <li>
              <a href="{{ route('admin.subjects.index') }}"
                class="flex items-center justify-between py-2 hover:text-indigo-300 dark:hover:text-indigo-300 capitalize">
                subjects
              </a>
            </li>
            <li>
              <a href="{{ route('admin.exams.index') }}"
                class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300 capitalize">exams</a>
            </li>
            <li>
              <a href="{{ route('admin.scores.index') }}"
                class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300 capitalize">scores</a>
            </li>
            <li>
              <a href="{{ route('admin.course_offerings.index') }}"
                class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300 capitalize">Course</a>
            </li>
            <li>
              <a href="{{ route('admin.classrooms.index') }}"
                class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300 capitalize">Classrooms</a>
            </li>
          </ul>
        </div>
      </li>

      {{-- Organization --}}
      <li class="menu-item relative">
        <div
          class="flex items-center justify-between px-4 py-3 hover:bg-indigo-700 dark:hover:bg-gray-700 rounded-lg mx-2 cursor-pointer transition-all duration-200 js-submenu-toggle">
          <div class="wr-icon flex items-center">
            <i class="fa-solid fa-lock"></i>
            <span class="ml-3 sidebar-text text-hidden">Organization</span>
          </div>
          <i class="fas fa-chevron-right menu-icon text-xs sidebar-text text-hidden"></i>
          <span class="menu-tooltip">Organization</span>
        </div>
        <div class="submenu">
          <ul class="pl-4 pr-4">
            <li>
              <a href="{{ route('admin.teachers.index') }}"
                class="flex items-center justify-between py-2 hover:text-indigo-300 dark:hover:text-indigo-300 capitalize">
                <span class="ml-2">teachers</span>
                <span class="bg-amber-500 text-white text-xs font-medium px-2 py-0.5 rounded-full">3</span>
              </a>
            </li>
            <li>
              <a href="{{ route('admin.students.index') }}"
                class="flex items-center justify-between py-2 hover:text-indigo-300 dark:hover:text-indigo-300 capitalize">
                <span class="ml-2">Students</span>
                <span class="bg-amber-500 text-white text-xs font-medium px-2 py-0.5 rounded-full">3</span>
              </a>
            </li>
          </ul>
        </div>
      </li>

      <li class="separator border-b border-white/10 dark:border-gray-700/50 px-2 pb-2 my-2">
      </li>

      <li class="menu-item relative">
        <div
          class="flex items-center justify-between px-4 py-3 hover:bg-indigo-700 dark:hover:bg-gray-700 rounded-lg
                            mx-2 cursor-pointer transition-all duration-200 js-submenu-toggle">
          <div class="wr-icon flex items-center">
            <i class="fas fa-money-bill-wave text-center"></i>
            <span class="ml-3 sidebar-text text-hidden">Finance</span>
          </div>
          <i class="fas fa-chevron-right menu-icon text-xs sidebar-text text-hidden"></i>
          <span class="menu-tooltip">Finance</span>
        </div>
        <div class="submenu">
          <ul class="pl-2 pr-2">

            <li class="relative">
              <a href="{{ route('admin.expenses.index') }}"
                class="flex items-center justify-between px-3 py-2 hover:bg-indigo-700
                                         dark:hover:bg-gray-700 rounded-lg transition-all duration-200">
                <div class="flex items-center">
                  <i class="ri-money-dollar-circle-fill text-lg"></i>
                  <span class="ml-2">Expenses</span>
                </div>
              </a>
            </li>
            <li class="relative">
              <div
                class="cursor-pointer px-3 flex items-center justify-between py-2 hover:bg-indigo-700 dark:hover:bg-gray-700
                                         rounded-md transition-all duration-200 js-submenu-toggle">
                <div class="flex items-center">
                  <i class="ri-presentation-fill text-lg"></i>
                  <span class="ml-2">Reports</span>
                </div>
                <i class="fas fa-chevron-right menu-icon text-xs"></i>
              </div>
              <div class="submenu">
                <ul class="pl-2">
                  <li>
                    <a href="#"
                      class="flex items-center justify-between px-3 py-2 hover:bg-indigo-700
                                         dark:hover:bg-gray-700 rounded-lg transition-all duration-200">
                      <div class="flex items-center">
                        <span class="ml-2">Daily Collection</span>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#"
                      class="flex items-center justify-between px-3 py-2 hover:bg-indigo-700
                                         dark:hover:bg-gray-700 rounded-lg transition-all duration-200">
                      <div class="flex items-center">
                        <i class="ri-money-dollar-circle-fill text-lg"></i>
                        <span class="ml-2">Monthly Reports</span>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#"
                      class="flex items-center justify-between px-3 py-2 hover:bg-indigo-700
                                         dark:hover:bg-gray-700 rounded-lg transition-all duration-200">
                      <div class="flex items-center">
                        <i class="ri-money-dollar-circle-fill text-lg"></i>
                        <span class="ml-2">Annual Reports</span>
                      </div>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="relative">
              <div
                class="cursor-pointer px-3 flex items-center justify-between py-2 hover:bg-indigo-700 dark:hover:bg-gray-700
                                         rounded-md transition-all duration-200 js-submenu-toggle">
                <div class="flex items-center">
                  <span>Reports</span>
                </div>
                <i class="fas fa-chevron-right menu-icon text-xs"></i>
              </div>
              <div class="submenu">
                <ul class="pl-2">
                  <li>
                    <a href="#"
                      class="flex items-center justify-between px-3 py-2 hover:bg-indigo-700
                                         dark:hover:bg-gray-700 rounded-lg transition-all duration-200">
                      <div class="flex items-center">
                        <span class="ml-2">Daily Collection</span>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#"
                      class="flex items-center justify-between px-3 py-2 hover:bg-indigo-700
                                         dark:hover:bg-gray-700 rounded-lg transition-all duration-200">
                      <div class="flex items-center">
                        <i class="ri-money-dollar-circle-fill text-lg"></i>
                        <span class="ml-2">Monthly Reports</span>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#"
                      class="flex items-center justify-between px-3 py-2 hover:bg-indigo-700
                                         dark:hover:bg-gray-700 rounded-lg transition-all duration-200">
                      <div class="flex items-center">
                        <i class="ri-money-dollar-circle-fill text-lg"></i>
                        <span class="ml-2">Annual Reports</span>
                      </div>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
          </ul>
        </div>
      </li>

      <li class="separator border-b border-white/10 dark:border-gray-700/50 px-2 pb-2 my-2">
      </li>

      @if (Auth::user()->hasRole('admin'))
        <li class="menu-item relative">
          <div
            class="flex items-center justify-between px-4 py-3 hover:bg-indigo-700 dark:hover:bg-gray-700 rounded-lg mx-2 cursor-pointer transition-all duration-200 js-submenu-toggle">
            <div class="wr-icon flex items-center">
              <i class="fa-solid fa-lock"></i>
              <span class="ml-3 sidebar-text text-hidden">Administrator</span>
            </div>
            <i class="fas fa-chevron-right menu-icon text-xs sidebar-text text-hidden"></i>
            <span class="menu-tooltip">Administrator</span>
          </div>
          <div class="submenu">
            <ul class="pl-4 pr-4">
              <li><a href="{{ route('admin.users.index') }}"
                  class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300 capitalize">Users</a>
              </li>
              <li><a href="{{ route('admin.roles.index') }}"
                  class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300 capitalize">roles</a>
              </li>
          </div>
        </li>
      @endif

    </ul>
  </nav>
</aside>
