<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200">
    <!-- Backdrop for mobile sidebar -->
    <div id="sidebar-backdrop" class="sidebar-backdrop fixed inset-0 z-20 hidden opacity-0"></div>

    <!-- Main container -->
    <div class="flex h-screen">
        <!-- Sidebar - Default width w-72 -->
        <aside id="sidebar"
            class="sidebar bg-indigo-800 dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 text-white fixed h-full z-30 left-0 top-0 w-72 ">
            <!-- Sidebar header -->
            <div class="flex items-center justify-between p-4 border-b border-indigo-700 dark:border-gray-700">
                <div class="flex items-center space-x-2">
                    <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='white' width='24' height='24'%3E%3Cpath d='M12 3L1 9l4 2.18v6L12 21l7-3.82v-6l2-1.09V17h2V9L12 3zm6.82 6L12 12.72 5.18 9 12 5.28 18.82 9zM17 15.99l-5 2.73-5-2.73v-3.72L12 15l5-2.73v3.72z'/%3E%3C/svg%3E"
                        alt="Logo" class="w-8 h-8">
                    <h1 class="text-xl font-bold sidebar-text text-hidden">EduManager</h1>
                </div>
                <button id="close-sidebar" class="md:hidden text-white hover:text-gray-300">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <!-- Sidebar menu -->
            <nav class="pt-4 flex-grow overflow-y-auto">
                <ul id="menu-container"></ul>
                <ul>
                    <!-- Dashboard -->
                    <li class="menu-item relative">
                        <a href="{{ route('home') }}"
                            class="flex items-center justify-between px-4 py-3 hover:bg-indigo-700 dark:hover:bg-gray-700 rounded-lg mx-2 transition-all duration-200">
                            <div class="flex items-center">
                                <i class="fas fa-tachometer-alt w-6 text-center"></i>
                                <span class="ml-3 sidebar-text text-hidden">Dashboard</span>
                            </div>
                            <span class="menu-tooltip">Dashboard</span>
                        </a>
                    </li>
                    <li class="separator border-b border-white/10 dark:border-gray-700/50 px-2 pb-2 my-2">

                    </li>

                    <!-- Students -->
                    <li class="menu-item relative">
                        <div
                            class="flex items-center justify-between px-4 py-3 hover:bg-indigo-700 dark:hover:bg-gray-700 rounded-lg mx-2 cursor-pointer transition-all duration-200 js-submenu-toggle">
                            <div class="flex items-center">
                                <i class="fas fa-user-graduate w-6 text-center"></i>
                                <span class="ml-3 sidebar-text text-hidden">Students</span>
                            </div>
                            <i class="fas fa-chevron-right menu-icon text-xs sidebar-text text-hidden"></i>
                            <span class="menu-tooltip">Students</span>
                        </div>
                        <div class="submenu">
                            <ul class="pl-4 pr-4">
                                <li class="relative">
                                    <div
                                        class="px-4 flex items-center justify-between py-2 hover:text-indigo-300 dark:hover:text-gray-300 transition-all duration-200 js-submenu-toggle">
                                        <span>Student Records</span>
                                        <i class="fas fa-chevron-right menu-icon text-xs"></i>
                                    </div>
                                    <div class="submenu">
                                        <ul class="pl-4">
                                            <li><a href="#"
                                                    class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300">All
                                                    Students</a></li>
                                            <li><a href="#"
                                                    class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300">New
                                                    Admissions</a></li>
                                            <li><a href="#"
                                                    class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300">Promotions</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="relative">
                                    <div
                                        class="px-4 flex items-center justify-between py-2 hover:text-indigo-300 dark:hover:text-gray-300 transition-all duration-200 js-submenu-toggle">
                                        <span>Attendance</span>
                                        <i class="fas fa-chevron-right menu-icon text-xs"></i>
                                    </div>
                                    <div class="submenu">
                                        <ul class="pl-4">
                                            <li><a href="#"
                                                    class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300">Daily
                                                    Attendance</a></li>
                                            <li><a href="#"
                                                    class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300">Monthly
                                                    Reports</a></li>
                                            <li><a href="#"
                                                    class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300">Attendance
                                                    Settings</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li><a href="#"
                                        class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300">Student
                                        Fees</a></li>
                                <li><a href="#"
                                        class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300">ID
                                        Cards</a></li>
                            </ul>
                        </div>
                    </li>

                    <!-- Teachers -->
                    <li class="menu-item relative">
                        <div
                            class="flex items-center justify-between px-4 py-3 hover:bg-indigo-700 dark:hover:bg-gray-700 rounded-lg mx-2 cursor-pointer transition-all duration-200 js-submenu-toggle">
                            <div class="flex items-center">
                                <i class="fas fa-chalkboard-teacher w-6 text-center"></i>
                                <span class="ml-3 sidebar-text text-hidden">Teachers</span>
                            </div>
                            <i class="fas fa-chevron-right menu-icon text-xs sidebar-text text-hidden"></i>
                            <span class="menu-tooltip">Teachers</span>
                        </div>
                        <div class="submenu">
                            <ul class="pl-4 pr-4">
                                <li><a href="#"
                                        class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300">All
                                        Teachers</a></li>
                                <li><a href="#"
                                        class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300">Add
                                        Teacher</a></li>
                                <li class="relative">
                                    <div
                                        class="px-4 flex items-center justify-between py-2 hover:text-indigo-300 dark:hover:text-gray-300 transition-all duration-200 js-submenu-toggle">
                                        <span>Teacher Attendance</span>
                                        <i class="fas fa-chevron-right menu-icon text-xs"></i>
                                    </div>
                                    <div class="submenu">
                                        <ul class="pl-4">
                                            <li><a href="#"
                                                    class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300">Daily
                                                    Records</a></li>
                                            <li><a href="#"
                                                    class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300">Monthly
                                                    Reports</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li><a href="#"
                                        class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300">Payroll</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="menu-item relative">
                        <a href="{{ route('departments.index') }}"
                            class="flex items-center justify-between px-4 py-3 hover:bg-indigo-700 dark:hover:bg-gray-700 rounded-lg mx-2 transition-all duration-200">
                            <div class="flex items-center">
                                <i class="fas fa-tachometer-alt w-6 text-center"></i>
                                <span class="ml-3 sidebar-text text-hidden">Departments</span>
                            </div>
                            <span class="menu-tooltip">Departments</span>
                        </a>
                    </li>

                    <li class="separator border-b border-white/10 dark:border-gray-700/50 px-2 pb-2 my-2">
                        <span class="ml-5">Separator</span>
                    </li>
                    <!-- Academics -->
                    <li class="menu-item relative">
                        <div
                            class="flex items-center justify-between px-4 py-3 hover:bg-indigo-700 dark:hover:bg-gray-700 rounded-lg mx-2 cursor-pointer transition-all duration-200 js-submenu-toggle">
                            <div class="flex items-center">
                                <i class="fas fa-book w-6 text-center"></i>
                                <span class="ml-3 sidebar-text text-hidden">Academics</span>
                            </div>
                            <i class="fas fa-chevron-right menu-icon text-xs sidebar-text text-hidden"></i>
                            <span class="menu-tooltip">Academics</span>
                        </div>
                        <div class="submenu">
                            <ul class="pl-4 pr-4">
                                <li class="relative">
                                    <div
                                        class="px-4 flex items-center justify-between py-2 hover:text-indigo-300 dark:hover:text-gray-300 transition-all duration-200 js-submenu-toggle">
                                        <span>Classes</span>
                                        <i class="fas fa-chevron-right menu-icon text-xs"></i>
                                    </div>
                                    <div class="submenu">
                                        <ul class="pl-4">
                                            <li><a href="#"
                                                    class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300">All
                                                    Classes</a></li>
                                            <li><a href="#"
                                                    class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300">Class
                                                    Sections</a></li>
                                            <li><a href="#"
                                                    class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300">Class
                                                    Teachers</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="relative">
                                    <div
                                        class="px-4 flex items-center justify-between py-2 hover:text-indigo-300 dark:hover:text-gray-300 transition-all duration-200 js-submenu-toggle">
                                        <span>Subjects</span>
                                        <i class="fas fa-chevron-right menu-icon text-xs"></i>
                                    </div>
                                    <div class="submenu">
                                        <ul class="pl-4">
                                            <li><a href="#"
                                                    class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300">Subject
                                                    List</a></li>
                                            <li><a href="#"
                                                    class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300">Assign
                                                    Teachers</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="relative">
                                    <div
                                        class="px-4 flex items-center justify-between py-2 hover:text-indigo-300 dark:hover:text-gray-300 transition-all duration-200 js-submenu-toggle">
                                        <span>Timetable</span>
                                        <i class="fas fa-chevron-right menu-icon text-xs"></i>
                                    </div>
                                    <div class="submenu">
                                        <ul class="pl-4">
                                            <li><a href="#"
                                                    class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300">Class
                                                    Timetable</a></li>
                                            <li><a href="#"
                                                    class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300">Teacher
                                                    Timetable</a></li>
                                            <li><a href="#"
                                                    class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300">Generate
                                                    Timetable</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li><a href="#"
                                        class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300">Syllabus</a>
                                </li>
                                <li><a href="#"
                                        class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300">Examinations</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Finance -->
                    <li class="menu-item relative">
                        <div
                            class="flex items-center justify-between px-4 py-3 hover:bg-indigo-700 dark:hover:bg-gray-700 rounded-lg mx-2 cursor-pointer transition-all duration-200 js-submenu-toggle">
                            <div class="flex items-center">
                                <i class="fas fa-money-bill-wave w-6 text-center"></i>
                                <span class="ml-3 sidebar-text text-hidden">Finance</span>
                            </div>
                            <i class="fas fa-chevron-right menu-icon text-xs sidebar-text text-hidden"></i>
                            <span class="menu-tooltip">Finance</span>
                        </div>
                        <div class="submenu">
                            <ul class="pl-4 pr-4">
                                <li><a href="#"
                                        class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300">Fee
                                        Structure</a></li>
                                <li><a href="#"
                                        class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300">Fee
                                        Collection</a></li>
                                <li><a href="#"
                                        class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300">Expenses</a>
                                </li>
                                <li class="relative">
                                    <div
                                        class="px-4 flex items-center justify-between py-2 hover:text-indigo-300 dark:hover:text-gray-300 transition-all duration-200 js-submenu-toggle">
                                        <span>Reports</span>
                                        <i class="fas fa-chevron-right menu-icon text-xs"></i>
                                    </div>
                                    <div class="submenu">
                                        <ul class="pl-4">
                                            <li><a href="#"
                                                    class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300">Daily
                                                    Collection</a></li>
                                            <li><a href="#"
                                                    class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300">Monthly
                                                    Reports</a></li>
                                            <li><a href="#"
                                                    class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300">Annual
                                                    Reports</a></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!-- Library -->
                    <li class="menu-item relative">
                        <div
                            class="flex items-center justify-between px-4 py-3 hover:bg-indigo-700 dark:hover:bg-gray-700 rounded-lg mx-2 cursor-pointer transition-all duration-200 js-submenu-toggle">
                            <div class="flex items-center">
                                <i class="fas fa-book-open w-6 text-center"></i>
                                <span class="ml-3 sidebar-text text-hidden">Library</span>
                            </div>
                            <i class="fas fa-chevron-right menu-icon text-xs sidebar-text text-hidden"></i>
                            <span class="menu-tooltip">Library</span>
                        </div>
                        <div class="submenu">
                            <ul class="pl-4 pr-4">
                                <li><a href="#"
                                        class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300">Books
                                        Inventory</a></li>
                                <li><a href="#"
                                        class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300">Issue
                                        Books</a></li>
                                <li><a href="#"
                                        class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300">Return
                                        Books</a></li>
                                <li><a href="#"
                                        class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300">Overdue
                                        Books</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>

            <!-- Sidebar footer with user profile -->
            <div class="sidebar-footer relative">
                <!-- Footer dropdown menu -->
                <div id="sidebar-footer-dropdown"
                    class="sidebar-footer-dropdown bg-indigo-900 dark:bg-gray-900 shadow-lg left-auto sm:left-[100%] py-2">
                    <ul>
                        <li>
                            <a href="#"
                                class="flex items-center px-4 py-2 hover:bg-indigo-700 dark:hover:bg-gray-700">
                                <svg class="w-5 h-5 mr-3 text-indigo-300" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                My Profile
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center px-4 py-2 hover:bg-indigo-700 dark:hover:bg-gray-700">
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
                            <a href="#"
                                class="flex items-center px-4 py-2 hover:bg-indigo-700 dark:hover:bg-gray-700">
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
                            <a href="#"
                                class="flex items-center px-4 py-2 hover:bg-indigo-700 dark:hover:bg-gray-700">
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
                                <button type="submit" class="flex items-center w-full px-4 py-2 text-red-400">
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
                <div id="sidebar-footer-profile" class="p-4 bg-indigo-900/50 dark:bg-gray-900/50 cursor-pointer ">
                    <div class="flex items-center">
                        <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%236366f1'%3E%3Cpath d='M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z'/%3E%3C/svg%3E"
                            alt="User" class="w-10 h-10 rounded-full border-2 border-indigo-500 ">
                        <div class="ml-3 sidebar-text text-hidden">
                            <p class="font-medium text-white">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-indigo-300 dark:text-gray-400">{{ auth()->user()->email }}</p>
                        </div>
                        <i class="fas fa-chevron-up ml-auto text-xs sidebar-text text-hidden"></i>
                    </div>
                </div>

                <!-- Collapsed sidebar footer -->
                <div id="sidebar-footer-collapsed"
                    class="p-4 bg-indigo-900/50 dark:bg-gray-900/50 cursor-pointer hidden ">
                    <div class="flex justify-center">
                        <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%236366f1'%3E%3Cpath d='M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z'/%3E%3C/svg%3E"
                            alt="User" class="size-8 rounded-full border-2 border-indigo-500">
                        <span class="footer-tooltip">{{ auth()->user()->name }}<br>{{ auth()->user()->email }}</span>
                    </div>
                </div>
            </div>
        </aside>
        <!-- Main content -->
        <div class="flex-1 flex flex-col transition-all duration-300 md:ml-72" id="main-content">
            <!-- Header -->
            <header
                class="flex items-center justify-between px-6 py-3 bg-white dark:bg-gray-800  fixed w-[100%] md:sticky top-0 z-10 border-b border-gray-200 dark:border-gray-700">
                <!-- Left side - Toggle button -->
                <div class="flex items-center">
                    <button id="toggle-sidebar"
                        class="rounded-full cursor-pointer size-9 flex justify-center items-center text-gray-600 dark:text-gray-300 
                        hover:text-indigo-600 hover:bg-indigo-100 dark:hover:bg-indigo-900 dark:hover:text-indigo-400 focus:outline-none">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>

                <!-- Right side - User actions -->
                <div class="flex items-center space-x-4">
                    <!-- Search bar -->
                    <div class="ml-4 relative hidden md:block">
                        <input type="text" placeholder="Search..."
                            class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-lg pl-10 pr-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 w-64">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-500 dark:text-gray-400"></i>
                    </div>
                    <!-- Dark mode toggle -->
                    <button id="dark-mode-toggle"
                        class="rounded-full size-9 cursor-pointer flex justify-center items-center border border-indigo-100 dark:border-indigo-900 
                        dark:text-gray-300 text-indigo-600 hover:bg-indigo-50 dark:hover:bg-gray-700 focus:outline-none ">
                        <!-- Moon icon (shown in light mode) -->
                        <svg class="size-4 dark:hidden" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"
                            fill="currentColor">
                            <path
                                d="M223.5 32C100 32 0 132.3 0 256S100 480 223.5 480c60.6 0 115.5-24.2 155.8-63.4c5-4.9 6.3-12.5 3.1-18.7s-10.1-9.7-17-8.5c-9.8 1.7-19.8 2.6-30.1 2.6c-96.9 0-175.5-78.8-175.5-176c0-65.8 36-123.1 89.3-153.3c6.1-3.5 9.2-10.5 7.7-17.3s-7.3-11.9-14.3-12.5c-6.3-.5-12.6-.8-19-.8z" />
                        </svg>
                        <!-- Sun icon (shown in dark mode) -->
                        <svg id="sun-icon" class="size-5 hidden dark:block" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                    </button>

                    <!-- Notifications -->
                    <div class="relative">
                        <button
                            class="rounded-full size-9 cursor-pointer border border-indigo-100 text-indigo-600 dark:text-indigo-300 dark:border-indigo-900 dark:hover:bg-gray-700
                             hover:bg-indigo-50 dark:indigo-gray-300 focus:outline-none">
                            <i class="fas fa-bell text-xl"></i>
                            <span class="notification-dot absolute bg-red-500 rounded-full w-2 h-2"></span>
                        </button>
                    </div>

                    <!-- User profile -->
                    <div class="relative">
                        <button class="cursor-pointer flex items-center focus:outline-none" id="user-menu-button">
                            <img src="https://placehold.co/32x32/6366f1/ffffff?text=SJ" alt="User"
                                class="size-9 rounded-full border-2 border-indigo-500">
                        </button>
                        <!-- Dropdown menu with icons -->
                        <div id="user-dropdown"
                            class="absolute right-0 mt-2 w-56 bg-white dark:bg-gray-800 rounded-lg shadow-lg py-2 hidden animate-fadeIn z-20">
                            <a href="#"
                                class="flex items-center px-4 py-2 text-gray-800 dark:text-gray-200 hover:bg-indigo-100 dark:hover:bg-gray-700">
                                <svg class="w-5 h-5 mr-3 text-indigo-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Profile
                            </a>
                            <a href="#"
                                class="flex items-center px-4 py-2 text-gray-800 dark:text-gray-200 hover:bg-indigo-100 dark:hover:bg-gray-700">
                                <svg class="w-5 h-5 mr-3 text-indigo-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Account Settings
                            </a>
                            <div class="border-t border-gray-200 dark:border-gray-700 my-1"></div>

                            <form method="POST" action="{{ route('logout') }}"
                                class="block hover:bg-indigo-700 dark:hover:bg-gray-700">
                                @csrf
                                <button type="submit" class="flex items-center w-full pl-5 px-4 py-2 text-red-500">
                                    <svg class="w-5 h-5 mr-3 text-red-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                        </path>
                                    </svg>
                                    {{ __('Logout') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main content area -->
            <main class="flex-1 mt-15 md:mt-0 bg-violet-50 dark:bg-gray-900">
                <div
                    class="flex justify-between items-center border-b bg-white border-gray-200 dark:border-gray-700 px-4 py-2">
                    bradram
                </div>
                @yield('content')
            </main>
            <footer class="p-4 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-sm">
                <p class="mb-0 text-center">© {{ date('Y') }} School Management System. All rights reserved. Team
                    work</p>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    @stack('scripts')
</body>

</html>
