@extends('layouts.admin')
@section('content')
  <div class="p-4 sm:p-0">
    <div class="box grid sm:grid-cols-2 grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
      <!-- Total Students -->
      <div
        class="bg-white dark:hover:bg-blue-950 dark:bg-gray-800 rounded-xl p-5 border border-gray-200 dark:border-gray-700 shadow-sm relative"
        id="student-card">
        <div class="flex justify-between">
          <div>
            <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Total Students</p>
            <h3 class="text-2xl font-bold text-gray-800 dark:text-white mt-1">{{ $totalStudents }}</h3>
          </div>
          <div class="h-12 w-12 rounded-full bg-blue-500 bg-opacity-20 flex items-center justify-center">
            <i class="fas fa-user-graduate text-blue-100 dark:text-blue-200 text-xl"></i>
          </div>
        </div>
        <div class="flex items-center justify-between mt-4">
          <div>
            <span class="text-green-500 dark:text-green-400 text-sm flex items-center">
              <i class="fas fa-arrow-up mr-1"></i> 12.5%
            </span>
            <span class="text-gray-500 dark:text-gray-400 text-sm">vs last month</span>
          </div>

          <!-- Dropdown button -->
          <div class="relative inline-block text-left">
            <div>
              <button type="button"
                class="btn-toggle-dropdown inline-flex items-center justify-center rounded-full size-8 cursor-pointer text-gray-400 hover:bg-blue-100 dark:hover:bg-gray-900 hover:text-blue-500 transition-colors"
                aria-expanded="false">
                <i class="fas fa-ellipsis-v"></i>
              </button>
            </div>

            <!-- Dropdown menu -->
            <div
              class="dropdown-menu hidden absolute right-0 z-10 mt-2 w-56 origin-top-right divide-y divide-gray-100 dark:divide-gray-700 rounded-md bg-white dark:bg-gray-800 shadow-lg ring-1 ring-black/5 dark:ring-gray-700 focus:outline-none"
              role="menu">
              <div class="py-1" role="none">
                <a href="#"
                  class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700"
                  role="menuitem">
                  <i class="fas fa-eye mr-3 text-indigo-500 w-4 text-center"></i>
                  View Details
                </a>
                <a href="#"
                  class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700"
                  role="menuitem">
                  <i class="fas fa-file-export mr-3 text-indigo-500 w-4 text-center"></i>
                  Export Data
                </a>
              </div>
              <div class="py-1" role="none">
                <a href="#"
                  class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700"
                  role="menuitem">
                  <i class="fas fa-cog mr-3 text-indigo-500 w-4 text-center"></i>
                  Settings
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Total Teachers -->
      <div
        class="bg-white dark:bg-gray-800 dark:hover:bg-blue-950 rounded-xl p-5 border border-gray-200
             dark:border-gray-700 shadow-sm relative">
        <div class="flex justify-between">
          <div>
            <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Total Teachers</p>
            <h3 class="text-2xl font-bold text-gray-800 dark:text-white mt-1">{{ $totalTeachers }}</h3>
          </div>
          <div class="h-12 w-12 rounded-full bg-purple-500 bg-opacity-20 flex items-center justify-center">
            <i class="fas fa-chalkboard-teacher text-purple-100 dark:text-purple-200 text-xl"></i>
          </div>
        </div>
        <div class="flex items-center justify-between mt-4">
          <div>
            <span class="text-green-500 dark:text-green-400 text-sm flex items-center">
              <i class="fas fa-arrow-up mr-1"></i> 5.2%
            </span>
            <span class="text-gray-500 dark:text-gray-400 text-sm ml-2">vs last month</span>
          </div>

          <!-- Dropdown button -->
          <div class="relative inline-block text-left">
            <div>
              <button type="button"
                class="btn-toggle-dropdown inline-flex items-center justify-center rounded-full size-8 cursor-pointer text-gray-400 hover:bg-purple-100 dark:hover:bg-gray-900 hover:text-purple-500 transition-colors"
                aria-expanded="true" aria-haspopup="true">
                <i class="fas fa-ellipsis-v"></i>
              </button>
            </div>

            <!-- Dropdown menu -->
            <div
              class="dropdown-menu hidden absolute right-0 z-10 mt-2 w-56 origin-top-right divide-y divide-gray-100 dark:divide-gray-700 rounded-md bg-white dark:bg-gray-800 shadow-lg ring-1 ring-black/5 dark:ring-gray-700 focus:outline-none"
              role="menu">
              <div class="py-1" role="none">
                <a href="#"
                  class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700"
                  role="menuitem">
                  <i class="fas fa-eye mr-3 text-indigo-500 w-4 text-center"></i>
                  View Details
                </a>
                <a href="#"
                  class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700"
                  role="menuitem">
                  <i class="fas fa-file-export mr-3 text-indigo-500 w-4 text-center"></i>
                  Export Data
                </a>
              </div>
              <div class="py-1" role="none">
                <a href="#"
                  class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700"
                  role="menuitem">
                  <i class="fas fa-cog mr-3 text-indigo-500 w-4 text-center"></i>
                  Settings
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Active Classes -->
      <div
        class="bg-white dark:bg-gray-800 dark:hover:bg-green-950 rounded-xl p-5 border border-gray-200
             dark:border-gray-700 shadow-sm relative">
        <div class="flex justify-between">
          <div>
            <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Active Classes</p>
            <h3 class="text-2xl font-bold text-gray-800 dark:text-white mt-1">{{ $activeClasses }}</h3>
          </div>
          <div class="h-12 w-12 rounded-full bg-green-500 bg-opacity-20 flex items-center justify-center">
            <i class="fas fa-book text-green-100 dark:text-green-200 text-xl"></i>
          </div>
        </div>
        <div class="flex items-center justify-between mt-4">
          <div>
            <span class="text-green-500 dark:text-green-400 text-sm flex items-center">
              <i class="fas fa-arrow-up mr-1"></i> 3.1%
            </span>
            <span class="text-gray-500 dark:text-gray-400 text-sm ml-2">vs last month</span>
          </div>

          <!-- Dropdown button -->
          <div class="relative inline-block text-left">
            <div>
              <button
                class="btn-toggle-dropdown inline-flex items-center justify-center rounded-full size-8 cursor-pointer text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 hover:text-green-500 transition-colors"
                aria-expanded="true" aria-haspopup="true">
                <i class="fas fa-ellipsis-v"></i>
              </button>
            </div>

            <!-- Dropdown menu -->
            <div
              class="dropdown-menu hidden absolute right-0 z-10 mt-2 w-56 origin-top-right divide-y divide-gray-100 dark:divide-gray-700 rounded-md bg-white dark:bg-gray-800 shadow-lg ring-1 ring-black/5 dark:ring-gray-700 focus:outline-none"
              role="menu" aria-orientation="vertical" tabindex="-1">
              <div class="py-1" role="none">
                <a href="#"
                  class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700"
                  role="menuitem">
                  <i class="fas fa-eye mr-3 text-indigo-500 w-4 text-center"></i>
                  View Details
                </a>
                <a href="#"
                  class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700"
                  role="menuitem">
                  <i class="fas fa-file-export mr-3 text-indigo-500 w-4 text-center"></i>
                  Export Data
                </a>
              </div>
              <div class="py-1" role="none">
                <a href="#"
                  class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700"
                  role="menuitem">
                  <i class="fas fa-cog mr-3 text-indigo-500 w-4 text-center"></i>
                  Settings
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Fees Collected -->
      <div
        class="bg-white dark:bg-gray-800 dark:hover:bg-amber-950 rounded-xl p-5 border border-gray-200
             dark:border-gray-700 shadow-sm relative">
        <div class="flex justify-between">
          <div>
            <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Fees Collected</p>
            <h3 class="text-2xl font-bold text-gray-800 dark:text-white mt-1">
              ${{ number_format($feesCollected, 2) }}</h3>
          </div>
          <div class="h-12 w-12 rounded-full bg-amber-500 bg-opacity-20 flex items-center justify-center">
            <i class="fas fa-dollar-sign text-amber-100 dark:text-amber-200 text-xl"></i>
          </div>
        </div>
        <div class="flex items-center justify-between mt-4">
          <div>
            <span class="text-red-500 dark:text-red-400 text-sm flex items-center">
              <i class="fas fa-arrow-down mr-1"></i> 2.8%
            </span>
            <span class="text-gray-500 dark:text-gray-400 text-sm ml-2">vs last month</span>
          </div>

          <!-- Dropdown button -->
          <div class="relative inline-block text-left">
            <div>
              <button
                class="btn-toggle-dropdown inline-flex items-center justify-center rounded-full size-8 cursor-pointer text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 hover:text-amber-500 transition-colors"
                aria-expanded="true" aria-haspopup="true">
                <i class="fas fa-ellipsis-v"></i>
              </button>
            </div>

            <!-- Dropdown menu -->
            <div
              class="dropdown-menu hidden absolute right-0 z-10 mt-2 w-56 origin-top-right divide-y divide-gray-100 dark:divide-gray-700 rounded-md bg-white dark:bg-gray-800 shadow-lg ring-1 ring-black/5 dark:ring-gray-700 focus:outline-none"
              role="menu" aria-orientation="vertical" tabindex="-1">
              <div class="py-1" role="none">
                <a href="#"
                  class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700"
                  role="menuitem">
                  <i class="fas fa-eye mr-3 text-indigo-500 w-4 text-center"></i>
                  View Details
                </a>
                <a href="#"
                  class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700"
                  role="menuitem">
                  <i class="fas fa-file-export mr-3 text-indigo-500 w-4 text-center"></i>
                  Export Data
                </a>
              </div>
              <div class="py-1" role="none">
                <a href="#"
                  class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700"
                  role="menuitem">
                  <i class="fas fa-cog mr-3 text-indigo-500 w-4 text-center"></i>
                  Settings
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Charts and Activity Section -->
    <div class="box grid grid-cols-1 lg:grid-cols-3 gap-4">
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

          @foreach ($recentActivities as $activity)
            <div class="flex items-start">
              <div
                class="h-9 w-9 rounded-full bg-{{ $activity['color'] }}-500 text-white bg-opacity-20 flex items-center justify-center mr-3 mt-1 flex-shrink-0">
                <i class="fas fa-{{ $activity['icon'] }} text-{{ $activity['color'] }}-200"></i>
              </div>
              <div>
                <p class="text-gray-800 dark:text-white font-medium text-sm">{{ $activity['title'] }}</p>
                <p class="text-gray-500 dark:text-gray-400 text-sm">{{ $activity['description'] }}</p>
                <p class="text-gray-400 dark:text-gray-500 text-xs mt-1">
                  {{ $activity['time']->diffForHumans() }}</p>
              </div>
            </div>
          @endforeach
        </div>
        <button
          class="w-full mt-4 py-2 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 rounded-lg text-sm transition-colors">
          View All Activities
        </button>
      </div>
    </div>

    <!-- Recently Enrolled Students Table -->
    <div
      class="box bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
      <div class="p-4 md:flex justify-between items-center border-b border-gray-200 dark:border-gray-700">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-3 md:mb-0">Recently Enrolled
          Students
        </h2>
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
      <div class="table-respone overflow-x-auto">
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

            @if (count($recentStudents) > 0)
              <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <tbody>
                  @foreach ($recentStudents as $student)
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                      <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                        <div class="flex items-center">
                          <img class="w-9 h-9 rounded-full"
                            src="{{ $student['user']['profile_photo_path'] ? asset('storage/' . $student['user']['profile_photo_path']) : 'https://placehold.co/40x40/FFC107/000000?text=' . substr($student['user']['name'], 0, 2) }}"
                            alt="{{ $student['user']['name'] }} image">
                          <div class="pl-3">
                            <div class="text-base font-semibold">
                              {{ $student['user']['name'] }}
                            </div>
                            <div class="font-normal text-gray-500">
                              {{ $student['user']['email'] }}
                            </div>
                          </div>
                        </div>
                      </td>
                      <td class="px-6 py-4">{{ $student['class_id'] }}</td>
                      <td class="px-6 py-4">
                        <span
                          class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">Active</span>
                      </td>
                      <td class="px-6 py-4">
                        {{ \Carbon\Carbon::parse($student['created_at'])->format('Y-m-d') }}</td>
                      <td class="px-6 py-4 text-right">
                        <button class="font-medium text-indigo-600 dark:text-indigo-500 hover:underline">Details</button>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            @else
              <div class="p-4 text-center text-red-500 dark:text-gray-400">
                No recent students found.
              </div>
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
