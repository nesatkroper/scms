<aside id="sidebar"
    class="sidebar bg-indigo-800 dark:bg-slate-800 border-r border-gray-200 dark:border-gray-700 text-white fixed h-full z-30 left-0 top-0 w-72  md:translate-x-0 -translate-x-full">
    <!-- Sidebar header -->
    <div class="flex items-center justify-between p-4 border-b border-indigo-700 dark:border-gray-700">
        <div class="flex items-center space-x-2">
            <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='white' width='24' height='24'%3E%3Cpath d='M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3zm6.82 6L12 12.72 5.18 9 12 5.28 18.82 9zM17 15.99l-5 2.73-5-2.73v-3.72L12 15l5-2.73v3.72z'/%3E%3C/svg%3E"
                alt="Logo" class="w-8 h-8">
            <h1 class="text-lg font-bold sidebar-text text-hidden">EduManager</h1>
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
        <ul id="menu-container"></ul>
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
                        <li><a href="{{ route('admin.exams.index') }}"
                                class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300 capitalize">exams</a>
                        </li>
                        <li><a href="{{ route('admin.scores.index') }}"
                                class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300 capitalize">scores</a>
                        </li>
                        <li><a href="{{ route('admin.gradelevels.index') }}"
                                class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300 capitalize">gradelevels</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.subjects.index') }}"
                                class="flex items-center justify-between py-2 hover:text-indigo-300 dark:hover:text-indigo-300 capitalize">
                                <span>subjects</span>
                                <span
                                    class="bg-amber-500 text-white text-xs font-medium px-2 py-0.5 rounded-full">3</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.subjects.index') }}"
                                class="flex items-center justify-between py-2 hover:text-indigo-300 dark:hover:text-indigo-300 capitalize">
                                <span>Classes</span>
                                <span
                                    class="bg-amber-500 text-white text-xs font-medium px-2 py-0.5 rounded-full">3</span>
                            </a>
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
                                <span
                                    class="bg-amber-500 text-white text-xs font-medium px-2 py-0.5 rounded-full">3</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.students.index') }}"
                                class="flex items-center justify-between py-2 hover:text-indigo-300 dark:hover:text-indigo-300 capitalize">
                                <span class="ml-2">Students</span>
                                <span
                                    class="bg-amber-500 text-white text-xs font-medium px-2 py-0.5 rounded-full">3</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.guardians.index') }}"
                                class="flex items-center justify-between py-2 hover:text-indigo-300 dark:hover:text-indigo-300 capitalize">
                                <span class="ml-2">guardians</span>
                                <span
                                    class="bg-amber-500 text-white text-xs font-medium px-2 py-0.5 rounded-full">3</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.departments.index') }}"
                                class="flex items-center justify-between py-2 hover:text-indigo-300 dark:hover:text-indigo-300 capitalize">
                                <span class="ml-2">departments</span>
                                <span
                                    class="bg-violet-500 text-white text-xs font-medium px-2 py-0.5 rounded-full">3</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>

            <li class="separator border-b border-white/10 dark:border-gray-700/50 px-2 pb-2 my-2">
            </li>
            <!-- Library -->
            {{-- <li class="menu-item relative">
                <div
                    class="flex items-center justify-between px-4 py-3 hover:bg-indigo-700 dark:hover:bg-gray-700 rounded-lg mx-2 cursor-pointer
                             transition-all duration-200 js-submenu-toggle">
                    <div class="wr-icon flex items-center">
                        <i class="fas fa-book-open text-center"></i>
                        <span class="ml-3 sidebar-text text-hidden">Library</span>
                    </div>
                    <i class="fas fa-chevron-right menu-icon text-xs sidebar-text text-hidden"></i>
                    <span class="menu-tooltip">Library</span>
                </div>
                <div class="submenu">
                    <ul class="pl-2 pr-2">
                        <li>
                            <a href="{{ route('admin.bookcategory.index') }}"
                                class="flex items-center justify-between px-4 py-2 hover:bg-indigo-700
                   dark:hover:bg-gray-700 rounded-lg transition-all duration-200">
                                <div class="flex items-center">
                                    <i class="ri-book-fill text-lg"></i>
                                    <span class="ml-2">Books category</span>
                                </div>
                                <span class="menu-tooltip">Books category</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.books.index') }}"
                                class="flex items-center justify-between px-4 py-2 hover:bg-indigo-700
                                         dark:hover:bg-gray-700 rounded-lg transition-all duration-200">
                                <div class="flex items-center">
                                    <i class="ri-book-fill text-lg"></i>
                                    <span class="ml-2">Books</span>
                                </div>
                                <span class="menu-tooltip">Books</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.bookissues.index') }}"
                                class="flex items-center justify-between px-4 py-2 hover:bg-indigo-700
                                         dark:hover:bg-gray-700 rounded-md transition-all duration-200">
                                <div class="flex items-center">
                                    <i class="ri-book-2-fill text-lg"></i>
                                    <span class="ml-2">Issue Books</span>
                                </div>
                                <span class="menu-tooltip">Issue Books</span>
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="block px-4 py-2 hover:bg-indigo-700 dark:hover:bg-gray-700 rounded-md">
                                Books Inventory
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="block px-4 py-2 hover:bg-indigo-700 dark:hover:bg-gray-700 rounded-md">
                                Books Return
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="block px-4 py-2 hover:bg-indigo-700 dark:hover:bg-gray-700 rounded-md">
                                Overdue Books
                            </a>
                        </li>
                    </ul>
                </div>
            </li> --}}
            <!-- Finance -->

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
                                        <a href="#"class="flex items-center justify-between px-3 py-2 hover:bg-indigo-700
                                         dark:hover:bg-gray-700 rounded-lg transition-all duration-200">
                                            <div class="flex items-center">
                                                <span class="ml-2">Daily Collection</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"class="flex items-center justify-between px-3 py-2 hover:bg-indigo-700
                                         dark:hover:bg-gray-700 rounded-lg transition-all duration-200">
                                            <div class="flex items-center">
                                                <i class="ri-money-dollar-circle-fill text-lg"></i>
                                                <span class="ml-2">Monthly Reports</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"class="flex items-center justify-between px-3 py-2 hover:bg-indigo-700
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
                                        <a href="#"class="flex items-center justify-between px-3 py-2 hover:bg-indigo-700
                                         dark:hover:bg-gray-700 rounded-lg transition-all duration-200">
                                            <div class="flex items-center">
                                                <span class="ml-2">Daily Collection</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"class="flex items-center justify-between px-3 py-2 hover:bg-indigo-700
                                         dark:hover:bg-gray-700 rounded-lg transition-all duration-200">
                                            <div class="flex items-center">
                                                <i class="ri-money-dollar-circle-fill text-lg"></i>
                                                <span class="ml-2">Monthly Reports</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"class="flex items-center justify-between px-3 py-2 hover:bg-indigo-700
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
                        <li>
                            <a href="{{ route('admin.teachers.index') }}"
                                class="block px-3 py-2 hover:bg-indigo-700 dark:hover:bg-gray-700 rounded-md">
                                <span>Collection</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>

            <li class="separator border-b border-white/10 dark:border-gray-700/50 px-2 pb-2 my-2">
            </li>

            {{-- Admin --}}
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
                            <li><a href="{{ route('admin.permissions.index') }}"
                                    class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300 capitalize">Permission</a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif

            {{-- End --}}
        </ul>
    </nav>

    <!-- Sidebar footer with user profile -->
    <div class="sidebar-footer relative">
        <!-- Footer dropdown menu -->
        <div id="sidebar-footer-dropdown"
            class="sidebar-footer-dropdown bg-indigo-900 dark:bg-gray-900 border dark:border-gray-700 shadow-lg left-auto sm:left-[100%] py-2">
            <ul>
                <li>
                    <a href="#" class="flex items-center px-4 py-2 hover:bg-indigo-700 dark:hover:bg-gray-700">
                        <svg class="w-5 h-5 mr-3 text-indigo-300" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        My Profile
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center px-4 py-2 hover:bg-indigo-700 dark:hover:bg-gray-700">
                        <svg class="w-5 h-5 mr-3 text-indigo-300" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Account Settings
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center px-4 py-2 hover:bg-indigo-700 dark:hover:bg-gray-700">
                        <svg class="w-5 h-5 mr-3 text-indigo-300" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                            </path>
                        </svg>
                        Notifications
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center px-4 py-2 hover:bg-indigo-700 dark:hover:bg-gray-700">
                        <svg class="w-5 h-5 mr-3 text-indigo-300" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                        Help Center
                    </a>
                </li>
                <li class="border-t border-indigo-700 dark:border-gray-700 my-1"></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}"
                        class="block hover:bg-indigo-700 dark:hover:bg-gray-700">
                        @csrf
                        <button type="submit" class="flex items-center w-full px-4 py-2 text-red-400 cursor-pointer">
                            <svg class="w-5 h-5 mr-3 text-red-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg>
                            {{ __('Logout') }}
                        </button>
                    </form>
                </li>
            </ul>
        </div>

        <!-- User profile section -->
        <div id="sidebar-footer-profile" class="p-4 bg-indigo-900/50 dark:bg-gray-900/50 cursor-pointer">
            <div class="flex items-center">
                @if (auth()->user()->avatar)
                    <img src="{{ asset(auth()->user()->avatar) }}" alt="User"
                        class="w-10 h-10 rounded-full border-2 border-indigo-500 dark:border-white">
                @else
                    <img src="{{ asset('images/user.png') }}" alt="User"
                        class="w-10 h-10 rounded-full border-2 border-indigo-500 dark:border-white">
                @endif
                <div class="ml-3 sidebar-text text-hidden">
                    <p class="font-medium text-white">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-indigo-300 dark:text-gray-400">{{ auth()->user()->email }}</p>
                </div>
                <i class="fas fa-chevron-up ml-auto text-xs sidebar-text text-hidden"></i>
            </div>
        </div>

        <!-- Collapsed sidebar footer -->
        <div id="sidebar-footer-collapsed" class="p-4 bg-indigo-900/50 dark:bg-gray-900/50 cursor-pointer hidden ">
            <div class="flex justify-center">
                @if (auth()->user()->avatar)
                    <img src="{{ asset(auth()->user()->avatar) }}" alt="User"
                        class="size-8 rounded-full border-2 border-indigo-500">
                    <span class="footer-tooltip">{{ auth()->user()->name }}<br>{{ auth()->user()->email }}</span>
                @else
                    <img src="{{ asset('images/user.png') }}" alt="User"
                        class="size-8 rounded-full border-2 border-indigo-500">
                    <span class="footer-tooltip">{{ auth()->user()->name }}<br>{{ auth()->user()->email }}</span>
                @endif
            </div>
        </div>

    </div>
</aside>
