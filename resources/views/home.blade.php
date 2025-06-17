<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School MS - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">

</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200">
    <!-- Backdrop for mobile sidebar -->
    <div id="sidebar-backdrop" class="sidebar-backdrop fixed inset-0 z-20 hidden opacity-0"></div>

    <!-- Main container -->
    <div class="flex h-screen">
        <!-- Sidebar - Default width w-72 -->
        <aside id="sidebar"
            class="sidebar bg-indigo-800 dark:bg-gray-800 border-r dark:border-gray-700 text-white fixed h-full z-30 left-0 top-0 w-72">
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
            <nav class="pt-4 flex-grow">
                <ul>
                    <!-- Dashboard -->

                    <li class="menu-item relative">
                        <a href="#"
                            class="flex items-center justify-between px-4 py-3 hover:bg-indigo-700 dark:hover:bg-gray-700 rounded-lg mx-2 transition-all duration-200">
                            <div class="flex items-center">
                                <i class="fas fa-tachometer-alt w-6 text-center"></i>
                                <span class="ml-3 sidebar-text text-hidden">Dashboard</span>
                            </div>
                            <span class="menu-tooltip">Dashboard</span>
                        </a>
                    </li>

                    <li class="separator border-b border-white/10 dark:border-gray-700/50 px-2 pb-2 my-2"></li>

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
                            <ul class="pl-8 pr-4">
                                <li><a href="#"
                                        class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300 transition-all duration-200">All
                                        Students</a></li>
                                <li><a href="#"
                                        class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300 transition-all duration-200">Add
                                        Student</a></li>
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
                            <i class="fas fa-chevron-right menu-icon text-xs sidebar-text"></i>
                            <span class="menu-tooltip">Teachers</span>
                        </div>
                        <div class="submenu">
                            <ul class="pl-8 pr-4">
                                <li><a href="#"
                                        class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300">All
                                        Teachers</a></li>
                                <li><a href="#"
                                        class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300">Add
                                        Teacher</a></li>
                                <li><a href="#"
                                        class="block py-2 hover:text-indigo-300 dark:hover:text-gray-300">Payroll</a>
                                </li>
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
                        <i class="fas fa-chevron-up ml-auto text-xs sidebar-text"></i>
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
                class="bg-white dark:bg-gray-800 shadow-md py-3 px-4 flex items-center justify-between sticky top-0 z-10">
                <!-- Left side - Toggle button -->
                <div class="flex items-center">
                    <button id="toggle-sidebar"
                        class="text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 focus:outline-none">
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
                        class="rounded-full size-10 text-gray-600 dark:text-gray-300 hover:text-indigo-600 hover:bg-indigo-50 dark:hover:text-indigo-400 focus:outline-none border">
                        <i class="fas fa-moon dark:hidden"></i>
                        <i class="fas fa-sun hidden dark:block"></i>
                    </button>

                    <!-- Notifications -->
                    <div class="relative">
                        <button
                            class="rounded-full size-10 border text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 focus:outline-none">
                            <i class="fas fa-bell text-xl"></i>
                            <span class="notification-dot absolute bg-red-500 rounded-full w-2 h-2"></span>
                        </button>
                    </div>

                    <!-- User profile -->
                    <div class="relative">
                        <button class="flex items-center focus:outline-none" id="user-menu-button">
                            <img src="https://placehold.co/32x32/6366f1/ffffff?text=SJ" alt="User"
                                class="w-8 h-8 rounded-full border-2 border-indigo-500">
                        </button>
                        <!-- Dropdown menu with icons -->
                        <div id="user-dropdown"
                            class="absolute right-0 mt-2 w-56 bg-white dark:bg-gray-800 rounded-lg shadow-lg py-2 hidden animate-fadeIn z-20">
                            <a href="#"
                                class="flex items-center px-4 py-2 text-gray-800 dark:text-gray-200 hover:bg-indigo-100 dark:hover:bg-gray-700">
                                <svg class="w-5 h-5 mr-3 text-gray-500 dark:text-gray-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Profile
                            </a>
                            <a href="#"
                                class="flex items-center px-4 py-2 text-gray-800 dark:text-gray-200 hover:bg-indigo-100 dark:hover:bg-gray-700">
                                <svg class="w-5 h-5 mr-3 text-gray-500 dark:text-gray-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Account Settings
                            </a>
                            <div class="border-t border-gray-200 dark:border-gray-700 my-1"></div>
                            <a href="#"
                                class="flex items-center px-4 py-2 text-red-500 hover:bg-indigo-100 dark:hover:bg-gray-700">
                                <svg class="w-5 h-5 mr-3 text-red-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                    </path>
                                </svg>
                                Logout
                            </a>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main content area -->
            <main class="flex-1 bg-gray-100 dark:bg-gray-900 p-4">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Dashboard Overview</h1>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                    <!-- Total Students -->
                    <div
                        class="bg-white dark:bg-gray-800 rounded-xl p-5 border border-gray-200 dark:border-gray-700 shadow-sm">
                        <div class="flex justify-between">
                            <div>
                                <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Total Students</p>
                                <h3 class="text-2xl font-bold text-gray-800 dark:text-white mt-1">1,248</h3>
                            </div>
                            <div
                                class="h-12 w-12 rounded-lg bg-blue-500 bg-opacity-20 flex items-center justify-center">
                                <i class="fas fa-user-graduate text-blue-500 dark:text-blue-400 text-xl"></i>
                            </div>
                        </div>
                        <div class="flex items-center mt-4">
                            <span class="text-green-500 dark:text-green-400 text-sm flex items-center">
                                <i class="fas fa-arrow-up mr-1"></i> 12.5%
                            </span>
                            <span class="text-gray-500 dark:text-gray-400 text-sm ml-2">vs last month</span>
                        </div>
                    </div>

                    <!-- Total Teachers -->
                    <div
                        class="bg-white dark:bg-gray-800 rounded-xl p-5 border border-gray-200 dark:border-gray-700 shadow-sm">
                        <div class="flex justify-between">
                            <div>
                                <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Total Teachers</p>
                                <h3 class="text-2xl font-bold text-gray-800 dark:text-white mt-1">64</h3>
                            </div>
                            <div
                                class="h-12 w-12 rounded-lg bg-purple-500 bg-opacity-20 flex items-center justify-center">
                                <i class="fas fa-chalkboard-teacher text-purple-500 dark:text-purple-400 text-xl"></i>
                            </div>
                        </div>
                        <div class="flex items-center mt-4">
                            <span class="text-green-500 dark:text-green-400 text-sm flex items-center">
                                <i class="fas fa-arrow-up mr-1"></i> 5.2%
                            </span>
                            <span class="text-gray-500 dark:text-gray-400 text-sm ml-2">vs last month</span>
                        </div>
                    </div>

                    <!-- Active Classes -->
                    <div
                        class="bg-white dark:bg-gray-800 rounded-xl p-5 border border-gray-200 dark:border-gray-700 shadow-sm">
                        <div class="flex justify-between">
                            <div>
                                <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Active Classes</p>
                                <h3 class="text-2xl font-bold text-gray-800 dark:text-white mt-1">32</h3>
                            </div>
                            <div
                                class="h-12 w-12 rounded-lg bg-green-500 bg-opacity-20 flex items-center justify-center">
                                <i class="fas fa-book text-green-500 dark:text-green-400 text-xl"></i>
                            </div>
                        </div>
                        <div class="flex items-center mt-4">
                            <span class="text-green-500 dark:text-green-400 text-sm flex items-center">
                                <i class="fas fa-arrow-up mr-1"></i> 3.1%
                            </span>
                            <span class="text-gray-500 dark:text-gray-400 text-sm ml-2">vs last month</span>
                        </div>
                    </div>

                    <!-- Fees Collected -->
                    <div
                        class="bg-white dark:bg-gray-800 rounded-xl p-5 border border-gray-200 dark:border-gray-700 shadow-sm">
                        <div class="flex justify-between">
                            <div>
                                <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Fees Collected</p>
                                <h3 class="text-2xl font-bold text-gray-800 dark:text-white mt-1">$48,750</h3>
                            </div>
                            <div
                                class="h-12 w-12 rounded-lg bg-amber-500 bg-opacity-20 flex items-center justify-center">
                                <i class="fas fa-dollar-sign text-amber-500 dark:text-amber-400 text-xl"></i>
                            </div>
                        </div>
                        <div class="flex items-center mt-4">
                            <span class="text-red-500 dark:text-red-400 text-sm flex items-center">
                                <i class="fas fa-arrow-down mr-1"></i> 2.8%
                            </span>
                            <span class="text-gray-500 dark:text-gray-400 text-sm ml-2">vs last month</span>
                        </div>
                    </div>
                </div>

                <!-- Charts and Activity Section -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-6">
                    <!-- Attendance Chart -->
                    <div
                        class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-xl p-5 border border-gray-200 dark:border-gray-700 shadow-sm">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Attendance Overview</h3>
                            <div class="flex bg-gray-200 dark:bg-gray-700 rounded-lg overflow-hidden">
                                <button
                                    class="attendance-btn px-3 py-1 text-sm text-white bg-indigo-600">Daily</button>
                                <button
                                    class="attendance-btn px-3 py-1 text-sm text-gray-600 dark:text-gray-400 hover:bg-gray-300 dark:hover:bg-gray-600">Weekly</button>
                                <button
                                    class="attendance-btn px-3 py-1 text-sm text-gray-600 dark:text-gray-400 hover:bg-gray-300 dark:hover:bg-gray-600">Monthly</button>
                            </div>
                        </div>
                        <div class="chart-container h-72">
                            <canvas id="attendanceChart"></canvas>
                        </div>
                    </div>

                    <!-- Recent Activities -->
                    <div
                        class="bg-white dark:bg-gray-800 rounded-xl p-5 border border-gray-200 dark:border-gray-700 shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Recent Activities</h3>
                        <div class="space-y-4">
                            <!-- Activity Item -->
                            <div class="flex items-start">
                                <div
                                    class="h-9 w-9 rounded-full bg-green-500 bg-opacity-20 flex items-center justify-center mr-3 mt-1 flex-shrink-0">
                                    <i class="fas fa-user-plus text-green-500 dark:text-green-400"></i>
                                </div>
                                <div>
                                    <p class="text-gray-800 dark:text-white font-medium text-sm">New student enrolled
                                    </p>
                                    <p class="text-gray-500 dark:text-gray-400 text-sm">Sarah Johnson joined Grade 10
                                    </p>
                                    <p class="text-gray-400 dark:text-gray-500 text-xs mt-1">2 hours ago</p>
                                </div>
                            </div>
                            <!-- Activity Item -->
                            <div class="flex items-start">
                                <div
                                    class="h-9 w-9 rounded-full bg-blue-500 bg-opacity-20 flex items-center justify-center mr-3 mt-1 flex-shrink-0">
                                    <i class="fas fa-money-bill-wave text-blue-500 dark:text-blue-400"></i>
                                </div>
                                <div>
                                    <p class="text-gray-800 dark:text-white font-medium text-sm">Fee payment received
                                    </p>
                                    <p class="text-gray-500 dark:text-gray-400 text-sm">$350 from Michael Brown</p>
                                    <p class="text-gray-400 dark:text-gray-500 text-xs mt-1">5 hours ago</p>
                                </div>
                            </div>
                            <!-- Activity Item -->
                            <div class="flex items-start">
                                <div
                                    class="h-9 w-9 rounded-full bg-purple-500 bg-opacity-20 flex items-center justify-center mr-3 mt-1 flex-shrink-0">
                                    <i class="fas fa-calendar-alt text-purple-500 dark:text-purple-400"></i>
                                </div>
                                <div>
                                    <p class="text-gray-800 dark:text-white font-medium text-sm">Class schedule updated
                                    </p>
                                    <p class="text-gray-500 dark:text-gray-400 text-sm">Chemistry lab moved to Room 205
                                    </p>
                                    <p class="text-gray-400 dark:text-gray-500 text-xs mt-1">Yesterday</p>
                                </div>
                            </div>
                            <!-- Activity Item -->
                            <div class="flex items-start">
                                <div
                                    class="h-9 w-9 rounded-full bg-red-500 bg-opacity-20 flex items-center justify-center mr-3 mt-1 flex-shrink-0">
                                    <i class="fas fa-exclamation-triangle text-red-500 dark:text-red-400"></i>
                                </div>
                                <div>
                                    <p class="text-gray-800 dark:text-white font-medium text-sm">Attendance alert</p>
                                    <p class="text-gray-500 dark:text-gray-400 text-sm">15 students absent in Grade
                                        11-B</p>
                                    <p class="text-gray-400 dark:text-gray-500 text-xs mt-1">Yesterday</p>
                                </div>
                            </div>
                        </div>
                        <button
                            class="w-full mt-4 py-2 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 rounded-lg text-sm transition-colors">
                            View All Activities
                        </button>
                    </div>
                </div>

                <!-- Recently Enrolled Students Table -->
                <div
                    class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
                    <div
                        class="p-4 md:flex justify-between items-center border-b border-gray-200 dark:border-gray-700">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-3 md:mb-0">Recently Enrolled
                            Students</h2>
                        <div class="flex items-center gap-2">
                            <div class="relative">
                                <input type="text" placeholder="Search students..."
                                    class="bg-gray-100 dark:bg-gray-700 text-sm rounded-lg pl-8 pr-2 py-1.5 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <i class="fas fa-search absolute left-2.5 top-2.5 text-gray-400 text-xs"></i>
                            </div>
                            <button
                                class="p-2 h-8 w-8 flex items-center justify-center bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 rounded-lg transition-colors">
                                <i class="fas fa-redo text-gray-600 dark:text-gray-300 text-sm"></i>
                            </button>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead
                                class="bg-gray-50 dark:bg-gray-700/50 text-xs text-gray-700 dark:text-gray-400 uppercase">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Student</th>
                                    <th scope="col" class="px-6 py-3">Grade</th>
                                    <th scope="col" class="px-6 py-3">Status</th>
                                    <th scope="col" class="px-6 py-3">Join Date</th>
                                    <th scope="col" class="px-6 py-3"><span class="sr-only">Actions</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b border-gray-200 dark:border-gray-700">
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                        <div class="flex items-center">
                                            <img class="w-9 h-9 rounded-full"
                                                src="https://placehold.co/40x40/FFC107/000000?text=JD"
                                                alt="Jese image">
                                            <div class="pl-3">
                                                <div class="text-base font-semibold">John Doe</div>
                                                <div class="font-normal text-gray-500">john.doe@example.com</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">10</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">Active</span>
                                    </td>
                                    <td class="px-6 py-4">2024-08-15</td>
                                    <td class="px-6 py-4 text-right">
                                        <button
                                            class="font-medium text-indigo-600 dark:text-indigo-500 hover:underline">Details</button>
                                    </td>
                                </tr>
                                <tr class="border-b border-gray-200 dark:border-gray-700">
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                        <div class="flex items-center">
                                            <img class="w-9 h-9 rounded-full"
                                                src="https://placehold.co/40x40/E91E63/FFFFFF?text=JW"
                                                alt="Jane image">
                                            <div class="pl-3">
                                                <div class="text-base font-semibold">Jane Wilson</div>
                                                <div class="font-normal text-gray-500">jane.wilson@example.com</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">9</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">Active</span>
                                    </td>
                                    <td class="px-6 py-4">2024-08-14</td>
                                    <td class="px-6 py-4 text-right">
                                        <button
                                            class="font-medium text-indigo-600 dark:text-indigo-500 hover:underline">Details</button>
                                    </td>
                                </tr>
                                <tr class="border-b border-gray-200 dark:border-gray-700">
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                        <div class="flex items-center">
                                            <img class="w-9 h-9 rounded-full"
                                                src="https://placehold.co/40x40/4CAF50/FFFFFF?text=MS"
                                                alt="Mike image">
                                            <div class="pl-3">
                                                <div class="text-base font-semibold">Mike Smith</div>
                                                <div class="font-normal text-gray-500">mike.smith@example.com</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">11</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300">Pending</span>
                                    </td>
                                    <td class="px-6 py-4">2024-08-12</td>
                                    <td class="px-6 py-4 text-right">
                                        <button
                                            class="font-medium text-indigo-600 dark:text-indigo-500 hover:underline">Details</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
            <footer>
                <p class="mb-0">© {{ date('Y') }} School Management System. All rights reserved.</p>
            </footer>
        </div>
    </div>
    <script src="{{asset('assets/js/main.js')}}"></script>
</body>

</html>
