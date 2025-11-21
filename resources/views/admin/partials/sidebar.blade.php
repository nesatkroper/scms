@php
  $academicsRoutes = [
      'admin.subjects.*',
      'admin.exams.*',
      'admin.scores.*',
      'admin.course_offerings.*',
      'admin.classrooms.*',
  ];
  $isAcademicsActive = request()->routeIs($academicsRoutes);

  $organizationRoutes = ['admin.departments.*', 'admin.teachers.*', 'admin.students.*'];
  $isOrganizationActive = request()->routeIs($organizationRoutes);

  $financeRoutes = ['admin.fee_types.*', 'admin.expense_categories.*', 'admin.expenses.*', 'admin.expenses.*'];
  $isFinanceActive = request()->routeIs($financeRoutes);

  $administratorRoutes = ['admin.users.*', 'admin.roles.*'];
  $isAdministratorActive = request()->routeIs($administratorRoutes);
@endphp

<aside id="sidebar"
  class="sidebar bg-indigo-800 dark:bg-slate-800 border-r border-gray-200 dark:border-gray-700 text-white fixed h-full z-30 left-0 top-0 w-64 md:translate-x-0 -translate-x-full">
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
  <nav class="pt-4 flex-grow overflow-y-auto">
    <ul>
      <li class="menu-item relative">
        <a href="{{ route('admin.home') }}"
          class="flex items-center justify-between px-4 py-3 hover:bg-indigo-700 dark:hover:bg-gray-700 rounded-lg mx-2 transition-all duration-200
          {{ request()->routeIs('admin.home') ? 'bg-indigo-700' : '' }}">
          <div class="wr-icon flex items-center">
            <i class="fas fa-tachometer-alt text-center"></i>
            <span class="ml-3 sidebar-text text-hidden">Dashboard</span>
          </div>
          <span class="menu-tooltip">Dashboard</span>
        </a>
      </li>
      <li class="separator border-b border-white/10 dark:border-gray-700/50 px-2 pb-2 my-2"></li>

      <li class="menu-item relative">
        <div
          class="flex items-center justify-between px-4 py-3 hover:bg-indigo-700 dark:hover:bg-gray-700 rounded-lg mx-2 cursor-pointer transition-all duration-200 js-submenu-toggle
          {{ $isAcademicsActive ? 'bg-indigo-700' : '' }}">
          <div class="wr-icon flex items-center">
            <i class="ri-graduation-cap-fill text-lg"></i>
            <span class="ml-3 sidebar-text text-hidden">Academics</span>
          </div>
          <i class="fas fa-chevron-right menu-icon text-xs sidebar-text text-hidden"></i>
          <span class="menu-tooltip">Academics</span>
        </div>
        <div class="submenu {{ $isAcademicsActive ? 'active' : '' }}">
          <ul class="pl-4 pr-4">
            <li>
              <a href="{{ route('admin.classrooms.index') }}"
                class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300 capitalize
                {{ request()->routeIs('admin.classrooms.*') ? 'text-indigo-300 font-semibold bg-indigo-700 dark:bg-gray-700 text-white dark:text-indigo-400 rounded-lg px-3 mt-1' : '' }}">Classrooms</a>
            </li>
            <li>
              <a href="{{ route('admin.subjects.index') }}"
                class="flex items-center justify-between py-2 hover:text-indigo-300 dark:hover:text-indigo-300 capitalize
                {{ request()->routeIs('admin.subjects.*') ? 'text-indigo-300 font-semibold bg-indigo-700 dark:bg-gray-700 text-white dark:text-indigo-400 rounded-lg px-3 mt-1' : '' }}">
                subjects
              </a>
            </li>
            <li>
              <a href="{{ route('admin.course_offerings.index') }}"
                class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300 capitalize
                {{ request()->routeIs('admin.course_offerings.*') ? 'text-indigo-300 font-semibold bg-indigo-700 dark:bg-gray-700 text-white dark:text-indigo-400 rounded-lg px-3 mt-1' : '' }}">Course
                Offerings</a>
            </li>
            <li>
              <a href="{{ route('admin.exams.index') }}"
                class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300 capitalize
                {{ request()->routeIs('admin.exams.*') ? 'text-indigo-300 font-semibold bg-indigo-700 dark:bg-gray-700 text-white dark:text-indigo-400 rounded-lg px-3 mt-1' : '' }}">exams</a>
            </li>
          </ul>
        </div>
      </li>

      <li class="menu-item relative">
        <div
          class="flex items-center justify-between px-4 py-3 hover:bg-indigo-700 dark:hover:bg-gray-700 rounded-lg mx-2 cursor-pointer transition-all duration-200 js-submenu-toggle
          {{ $isOrganizationActive ? 'bg-indigo-700' : '' }}">
          <div class="wr-icon flex items-center">
            <i class="fa-solid fa-lock"></i>
            <span class="ml-3 sidebar-text text-hidden">Organization</span>
          </div>
          <i class="fas fa-chevron-right menu-icon text-xs sidebar-text text-hidden"></i>
          <span class="menu-tooltip">Organization</span>
        </div>
        <div class="submenu {{ $isOrganizationActive ? 'active' : '' }}">
          <ul class="pl-4 pr-4">
            <li>
              <a href="{{ route('admin.departments.index') }}"
                class="flex items-center justify-between py-2 hover:text-indigo-300 dark:hover:text-indigo-300 capitalize
                {{ request()->routeIs('admin.departments.*') ? 'text-indigo-300 font-semibold bg-indigo-700 dark:bg-gray-700 text-white dark:text-indigo-400 rounded-lg px-3 mt-1' : '' }}">
                <span class="ml-2">departments</span>
              </a>
            </li>
            <li>
              <a href="{{ route('admin.teachers.index') }}"
                class="flex items-center justify-between py-2 hover:text-indigo-300 dark:hover:text-indigo-300 capitalize
                {{ request()->routeIs('admin.teachers.*') ? 'text-indigo-300 font-semibold bg-indigo-700 dark:bg-gray-700 text-white dark:text-indigo-400 rounded-lg px-3 mt-1' : '' }}">
                <span class="ml-2">teachers</span>
              </a>
            </li>
            <li>
              <a href="{{ route('admin.students.index') }}"
                class="flex items-center justify-between py-2 hover:text-indigo-300 dark:hover:text-indigo-300 capitalize
                {{ request()->routeIs('admin.students.*') ? 'text-indigo-300 font-semibold bg-indigo-700 dark:bg-gray-700 text-white dark:text-indigo-400 rounded-lg px-3 mt-1' : '' }}">
                <span class="ml-2">Students</span>
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
                            mx-2 cursor-pointer transition-all duration-200 js-submenu-toggle
                            {{ $isFinanceActive ? 'bg-indigo-700' : '' }}">
          <div class="wr-icon flex items-center">
            <i class="fas fa-money-bill-wave text-center"></i>
            <span class="ml-3 sidebar-text text-hidden">Finance</span>
          </div>
          <i class="fas fa-chevron-right menu-icon text-xs sidebar-text text-hidden"></i>
          <span class="menu-tooltip">Finance</span>
        </div>
        <div class="submenu {{ $isFinanceActive ? 'active' : '' }}">
          <ul class="pl-2 pr-2">

            <li>
              <a href="{{ route('admin.fee_types.index') }}"
                class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300 capitalize
                {{ request()->routeIs('admin.fee_types.*') ? 'text-indigo-300 font-semibold bg-indigo-700 dark:bg-gray-700 text-white dark:text-indigo-400 rounded-lg px-3 mt-1' : '' }}">fee
                types
              </a>
            </li>
            <li>
              <a href="{{ route('admin.expense_categories.index') }}"
                class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300 capitalize
                {{ request()->routeIs('admin.expense_categories.*') ? 'text-indigo-300 font-semibold bg-indigo-700 dark:bg-gray-700 text-white dark:text-indigo-400 rounded-lg px-3 mt-1' : '' }}">expense
                categories</a>
            </li>

            <li>
              <a href="{{ route('admin.expenses.index') }}"
                class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300 capitalize
                {{ request()->routeIs('admin.expenses.*') ? 'text-indigo-300 font-semibold bg-indigo-700 dark:bg-gray-700 text-white dark:text-indigo-400 rounded-lg px-3 mt-1' : '' }}">expenses</a>
            </li>
          </ul>
        </div>
      </li>

      <li class="separator border-b border-white/10 dark:border-gray-700/50 px-2 pb-2 my-2">
      </li>

      @if (Auth::user()->hasRole('admin'))
        <li class="menu-item relative">
          <div
            class="flex items-center justify-between px-4 py-3 hover:bg-indigo-700 dark:hover:bg-gray-700 rounded-lg mx-2 cursor-pointer transition-all duration-200 js-submenu-toggle
            {{ $isAdministratorActive ? 'bg-indigo-700' : '' }}">
            <div class="wr-icon flex items-center">
              <i class="fa-solid fa-lock"></i>
              <span class="ml-3 sidebar-text text-hidden">Administrator</span>
            </div>
            <i class="fas fa-chevron-right menu-icon text-xs sidebar-text text-hidden"></i>
            <span class="menu-tooltip">Administrator</span>
          </div>
          <div class="submenu {{ $isAdministratorActive ? 'active' : '' }}">
            <ul class="pl-4 pr-4">
              <li><a href="{{ route('admin.users.index') }}"
                  class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300 capitalize
                  {{ request()->routeIs('admin.users.*') ? 'text-indigo-300 font-semibold bg-indigo-700 dark:bg-gray-700 text-white dark:text-indigo-400 rounded-lg px-3 mt-1' : '' }}">Users</a>
              </li>
              <li><a href="{{ route('admin.roles.index') }}"
                  class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300 capitalize
                  {{ request()->routeIs('admin.roles.*') ? 'text-indigo-300 font-semibold bg-indigo-700 dark:bg-gray-700 text-white dark:text-indigo-400 rounded-lg px-3 mt-1' : '' }}">roles</a>
              </li>
          </div>
        </li>
      @endif

    </ul>
  </nav>
</aside>
