@extends('layouts.app')
@section('content')
    <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Dashboard Overview</h1>
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <!-- Total Students -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-5 border border-gray-200 dark:border-gray-700 shadow-sm">
            <div class="flex justify-between">
                <div>
                    <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Total Students</p>
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-white mt-1">1,248</h3>
                </div>
                <div class="h-12 w-12 rounded-lg bg-blue-500 bg-opacity-20 flex items-center justify-center">
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
        <div class="bg-white dark:bg-gray-800 rounded-xl p-5 border border-gray-200 dark:border-gray-700 shadow-sm">
            <div class="flex justify-between">
                <div>
                    <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Total Teachers</p>
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-white mt-1">64</h3>
                </div>
                <div class="h-12 w-12 rounded-lg bg-purple-500 bg-opacity-20 flex items-center justify-center">
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
        <div class="bg-white dark:bg-gray-800 rounded-xl p-5 border border-gray-200 dark:border-gray-700 shadow-sm">
            <div class="flex justify-between">
                <div>
                    <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Active Classes</p>
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-white mt-1">32</h3>
                </div>
                <div class="h-12 w-12 rounded-lg bg-green-500 bg-opacity-20 flex items-center justify-center">
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
        <div class="bg-white dark:bg-gray-800 rounded-xl p-5 border border-gray-200 dark:border-gray-700 shadow-sm">
            <div class="flex justify-between">
                <div>
                    <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Fees Collected</p>
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-white mt-1">$48,750</h3>
                </div>
                <div class="h-12 w-12 rounded-lg bg-amber-500 bg-opacity-20 flex items-center justify-center">
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
                    <button class="attendance-btn px-3 py-1 text-sm text-white bg-indigo-600">Daily</button>
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
        <div class="bg-white dark:bg-gray-800 rounded-xl p-5 border border-gray-200 dark:border-gray-700 shadow-sm">
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
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
        <div class="p-4 md:flex justify-between items-center border-b border-gray-200 dark:border-gray-700">
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
                <thead class="bg-gray-50 dark:bg-gray-700/50 text-xs text-gray-700 dark:text-gray-400 uppercase">
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
                                <img class="w-9 h-9 rounded-full" src="https://placehold.co/40x40/FFC107/000000?text=JD"
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
                                <img class="w-9 h-9 rounded-full" src="https://placehold.co/40x40/E91E63/FFFFFF?text=JW"
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
                                <img class="w-9 h-9 rounded-full" src="https://placehold.co/40x40/4CAF50/FFFFFF?text=MS"
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
@endsection
