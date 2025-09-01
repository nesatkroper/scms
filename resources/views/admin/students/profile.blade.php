@extends('layouts.admin')
@section('title', "Students {$student->name} Profile")
@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Header Section -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
            <div class="md:flex">
                <div class="md:flex-shrink-0 p-6">
                    <div class="h-32 w-32 rounded-full border-4 border-white shadow-lg overflow-hidden mx-auto md:mx-0">
                        <img class="h-full w-full object-cover"
                            src="{{ $student->user?->avatar ? asset($student->user?->avatar) : 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=774&q=80' }}"
                            alt="Student photo">
                    </div>
                </div>
                <div class="p-6 flex-1">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">{{ $student?->name }}</h2>
                            <p class="text-secondary mt-1">{{ $student->gradeLevel?->name }}</p>
                            <div class="flex flex-wrap mt-2">
                                <span
                                    class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Student
                                    ID: {{ $student->id }}</span>
                                <span
                                    class="bg-purple-100 text-purple-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Age:
                                    {{ $student->age }} years</span>
                                @if ($student->blood_group)
                                    <span
                                        class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded">Blood
                                        Group: {{ $student->blood_group }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mt-4 md:mt-0">
                            <a href="{{ route('admin.students.edit', $student) }}"
                                class="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-lg flex items-center">
                                <i class="fas fa-edit mr-2"></i> Edit Profile
                            </a>
                        </div>
                    </div>
                    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="flex items-center">
                            <div class="bg-blue-100 p-3 rounded-full mr-3">
                                <i class="fas fa-envelope text-blue-600"></i>
                            </div>
                            <div>
                                <p class="text-sm text-secondary">Email</p>
                                <p class="font-medium">{{ $student->user->email }}</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="bg-green-100 p-3 rounded-full mr-3">
                                <i class="fas fa-phone text-green-600"></i>
                            </div>
                            <div>
                                <p class="text-sm text-secondary">Phone</p>
                                <p class="font-medium">{{ $student->phone ?? $student->user->phone }}</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="bg-purple-100 p-3 rounded-full mr-3">
                                <i class="fas fa-calendar-day text-purple-600"></i>
                            </div>
                            <div>
                                <p class="text-sm text-secondary">Admission Date</p>
                                <p class="font-medium">{{ $student->admission_date->format('F j, Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tab -->
        <div class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 mb-6">
            <button class="tab-link inline-block p-4 border-b-2 rounded-t-lg active text-primary border-primary"
                data-tab="overview">
                <i class="fas fa-user-circle mr-2"></i> Overview
            </button>
            <button
                class="tab-link inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 border-transparent"
                data-tab="academics">
                <i class="fas fa-graduation-cap mr-2"></i> Academics
            </button>
            <button
                class="tab-link inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 border-transparent"
                data-tab="attendance">
                <i class="fas fa-calendar-check mr-2"></i> Attendance
            </button>
            <button
                class="tab-link inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 border-transparent"
                data-tab="fees">
                <i class="fas fa-money-bill-wave mr-2"></i> Fees
            </button>
            <button
                class="tab-link inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 border-transparent"
                data-tab="guardians">
                <i class="fas fa-users mr-2"></i> Guardians
            </button>
        </div>
        <!-- Tab Contents -->
        <div class="tab-content active" id="overview-tab">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Personal Info Card -->
                <div class="info-card col-span-1 bg-white rounded-xl shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-info-circle text-primary mr-2"></i> Personal Information
                    </h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-secondary">Date of Birth</span>
                            <span class="font-medium">May 10, 2007</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-secondary">Gender</span>
                            <span class="font-medium">Male</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-secondary">Nationality</span>
                            <span class="font-medium">American</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-secondary">Religion</span>
                            <span class="font-medium">Christian</span>
                        </div>
                    </div>
                </div>

                <!-- Contact Info Card -->
                <div class="info-card col-span-1 bg-white rounded-xl shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-address-book text-primary mr-2"></i> Contact Information
                    </h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-secondary">Address</span>
                            <span class="font-medium text-right">123 Main St, Anytown, USA</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-secondary">Emergency Contact</span>
                            <span class="font-medium">+1 (555) 987-6543</span>
                        </div>
                    </div>
                </div>

                <!-- Academic Summary Card -->
                <!-- Academic Summary Card -->
                <div class="info-card col-span-1 bg-white rounded-xl shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-book-open text-primary mr-2"></i> Academic Summary
                    </h3>
                    <div class="space-y-4">
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-secondary">Overall GPA</span>
                                <span class="font-medium">{{ $academicStats['gpa'] }}/4.0</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div class="bg-success h-2.5 rounded-full progress-bar"
                                    style="width: {{ $academicStats['gpa_percentage'] }}%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-secondary">Attendance Rate</span>
                                <span class="font-medium">{{ $academicStats['attendance_rate'] }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div class="bg-info h-2.5 rounded-full progress-bar"
                                    style="width: {{ $academicStats['attendance_rate'] }}%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-secondary">Fees Paid</span>
                                <span class="font-medium">{{ $academicStats['fee_progress'] }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div class="bg-warning h-2.5 rounded-full progress-bar"
                                    style="width: {{ $academicStats['fee_progress'] }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activities -->
            <div class="info-card bg-white rounded-xl shadow-md p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-history text-primary mr-2"></i> Recent Activities
                </h3>
                <div class="relative">
                    <div class="absolute border-l-2 border-gray-200 h-full left-4"></div>
                    <ul class="space-y-4">
                        <li class="flex items-center">
                            <div class="bg-primary rounded-full h-8 w-8 flex items-center justify-center mr-4">
                                <i class="fas fa-book text-white text-sm"></i>
                            </div>
                            <div class="flex-1 py-2 border-b border-gray-200">
                                <p class="text-gray-800">Book issued: "Advanced Mathematics"</p>
                                <p class="text-sm text-secondary">2 days ago</p>
                            </div>
                        </li>
                        <li class="flex items-center">
                            <div class="bg-success rounded-full h-8 w-8 flex items-center justify-center mr-4">
                                <i class="fas fa-check text-white text-sm"></i>
                            </div>
                            <div class="flex-1 py-2 border-b border-gray-200">
                                <p class="text-gray-800">Submitted Science project</p>
                                <p class="text-sm text-secondary">5 days ago</p>
                            </div>
                        </li>
                        <li class="flex items-center">
                            <div class="bg-info rounded-full h-8 w-8 flex items-center justify-center mr-4">
                                <i class="fas fa-money-bill text-white text-sm"></i>
                            </div>
                            <div class="flex-1 py-2 border-b border-gray-200">
                                <p class="text-gray-800">Paid tuition fee for October</p>
                                <p class="text-sm text-secondary">1 week ago</p>
                            </div>
                        </li>
                        <li class="flex items-center">
                            <div class="bg-warning rounded-full h-8 w-8 flex items-center justify-center mr-4">
                                <i class="fas fa-user-check text-white text-sm"></i>
                            </div>
                            <div class="flex-1 py-2">
                                <p class="text-gray-800">Parent-Teacher meeting attended</p>
                                <p class="text-sm text-secondary">2 weeks ago</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Academics Tab -->
        <div class="tab-content hidden" id="academics-tab">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Course Grades Card -->
                <div class="info-card col-span-2 bg-white rounded-xl shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-chart-line text-primary mr-2"></i> Course Grades
                    </h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-4 py-3">Course</th>
                                    <th scope="col" class="px-4 py-3">Teacher</th>
                                    <th scope="col" class="px-4 py-3">Final Grade</th>
                                    <th scope="col" class="px-4 py-3">Progress</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-4 py-3 font-medium text-gray-900">Mathematics</td>
                                    <td class="px-4 py-3">Dr. Smith</td>
                                    <td class="px-4 py-3">
                                        <span
                                            class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">A</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="bg-green-600 h-2.5 rounded-full" style="width: 95%"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-4 py-3 font-medium text-gray-900">Physics</td>
                                    <td class="px-4 py-3">Prof. Johnson</td>
                                    <td class="px-4 py-3">
                                        <span
                                            class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">B+</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: 87%"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-4 py-3 font-medium text-gray-900">Chemistry</td>
                                    <td class="px-4 py-3">Dr. Williams</td>
                                    <td class="px-4 py-3">
                                        <span
                                            class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded">B</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="bg-yellow-400 h-2.5 rounded-full" style="width: 82%"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-4 py-3 font-medium text-gray-900">English Literature</td>
                                    <td class="px-4 py-3">Ms. Davis</td>
                                    <td class="px-4 py-3">
                                        <span
                                            class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">A-</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="bg-green-500 h-2.5 rounded-full" style="width: 90%"></div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Book Issues Card -->
                <div class="info-card col-span-1 bg-white rounded-xl shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-book text-primary mr-2"></i> Book Issues
                    </h3>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="bg-blue-100 p-2 rounded-lg mr-3">
                                <i class="fas fa-book text-blue-600"></i>
                            </div>
                            <div>
                                <p class="font-medium">Advanced Mathematics</p>
                                <p class="text-sm text-secondary">Issued: Oct 15, 2023</p>
                                <p class="text-sm text-secondary">Due: Nov 15, 2023</p>
                                <span
                                    class="bg-green-100 text-green-800 text-xs font-medium px-2 py-0.5 rounded mt-1 inline-block">Active</span>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="bg-purple-100 p-2 rounded-lg mr-3">
                                <i class="fas fa-book text-purple-600"></i>
                            </div>
                            <div>
                                <p class="font-medium">Physics Concepts</p>
                                <p class="text-sm text-secondary">Issued: Sep 10, 2023</p>
                                <p class="text-sm text-secondary">Returned: Oct 10, 2023</p>
                                <span
                                    class="bg-gray-100 text-gray-800 text-xs font-medium px-2 py-0.5 rounded mt-1 inline-block">Returned</span>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="bg-red-100 p-2 rounded-lg mr-3">
                                <i class="fas fa-book text-red-600"></i>
                            </div>
                            <div>
                                <p class="font-medium">Chemistry Fundamentals</p>
                                <p class="text-sm text-secondary">Issued: Aug 20, 2023</p>
                                <p class="text-sm text-secondary">Due: Sep 20, 2023</p>
                                <span
                                    class="bg-red-100 text-red-800 text-xs font-medium px-2 py-0.5 rounded mt-1 inline-block">Overdue</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Attendance Tab -->
        <div class="tab-content hidden" id="attendance-tab">
            <div class="info-card bg-white rounded-xl shadow-md p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-calendar-alt text-primary mr-2"></i> Monthly Attendance Summary
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                    <div class="bg-green-50 p-4 rounded-lg text-center">
                        <p class="text-2xl font-bold text-green-700">92%</p>
                        <p class="text-sm text-green-600">Attendance Rate</p>
                    </div>
                    <div class="bg-blue-50 p-4 rounded-lg text-center">
                        <p class="text-2xl font-bold text-blue-700">23</p>
                        <p class="text-sm text-blue-600">Days Present</p>
                    </div>
                    <div class="bg-red-50 p-4 rounded-lg text-center">
                        <p class="text-2xl font-bold text-red-700">2</p>
                        <p class="text-sm text-red-600">Days Absent</p>
                    </div>
                    <div class="bg-yellow-50 p-4 rounded-lg text-center">
                        <p class="text-2xl font-bold text-yellow-700">0</p>
                        <p class="text-sm text-yellow-600">Late Arrivals</p>
                    </div>
                </div>

                <h4 class="text-md font-semibold text-gray-800 mb-4">Recent Attendance Records</h4>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 py-3">Date</th>
                                <th scope="col" class="px-4 py-3">Day</th>
                                <th scope="col" class="px-4 py-3">Status</th>
                                <th scope="col" class="px-4 py-3">Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-4 py-3 font-medium text-gray-900">Oct 30, 2023</td>
                                <td class="px-4 py-3">Monday</td>
                                <td class="px-4 py-3">
                                    <span
                                        class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">Present</span>
                                </td>
                                <td class="px-4 py-3">-</td>
                            </tr>
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-4 py-3 font-medium text-gray-900">Oct 29, 2023</td>
                                <td class="px-4 py-3">Sunday</td>
                                <td class="px-4 py-3">
                                    <span
                                        class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded">Weekend</span>
                                </td>
                                <td class="px-4 py-3">-</td>
                            </tr>
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-4 py-3 font-medium text-gray-900">Oct 28, 2023</td>
                                <td class="px-4 py-3">Saturday</td>
                                <td class="px-4 py-3">
                                    <span
                                        class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded">Weekend</span>
                                </td>
                                <td class="px-4 py-3">-</td>
                            </tr>
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-4 py-3 font-medium text-gray-900">Oct 27, 2023</td>
                                <td class="px-4 py-3">Friday</td>
                                <td class="px-4 py-3">
                                    <span
                                        class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">Present</span>
                                </td>
                                <td class="px-4 py-3">-</td>
                            </tr>
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-4 py-3 font-medium text-gray-900">Oct 26, 2023</td>
                                <td class="px-4 py-3">Thursday</td>
                                <td class="px-4 py-3">
                                    <span
                                        class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded">Absent</span>
                                </td>
                                <td class="px-4 py-3">Medical leave</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Fees Tab -->
        <div class="tab-content hidden" id="fees-tab">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Fee Summary Card -->
                <div class="info-card col-span-1 bg-white rounded-xl shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-chart-pie text-primary mr-2"></i> Fee Summary
                    </h3>
                    <div class="space-y-4">
                        <div>
                            <p class="text-secondary">Total Fees</p>
                            <p class="text-xl font-bold">$1,250.00</p>
                        </div>
                        <div>
                            <p class="text-secondary">Paid Amount</p>
                            <p class="text-xl font-bold text-green-600">$1,062.50</p>
                        </div>
                        <div>
                            <p class="text-secondary">Due Amount</p>
                            <p class="text-xl font-bold text-red-600">$187.50</p>
                        </div>
                        <div>
                            <p class="text-secondary">Payment Progress</p>
                            <div class="w-full bg-gray-200 rounded-full h-2.5 mt-2">
                                <div class="bg-green-600 h-2.5 rounded-full" style="width: 85%"></div>
                            </div>
                            <p class="text-right text-sm text-secondary">85%</p>
                        </div>
                    </div>
                </div>

                <!-- Recent Payments Card -->
                <div class="info-card col-span-2 bg-white rounded-xl shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-receipt text-primary mr-2"></i> Recent Payments
                    </h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-4 py-3">Date</th>
                                    <th scope="col" class="px-4 py-3">Fee Type</th>
                                    <th scope="col" class="px-4 py-3">Amount</th>
                                    <th scope="col" class="px-4 py-3">Status</th>
                                    <th scope="col" class="px-4 py-3">Receipt</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-4 py-3 font-medium text-gray-900">Oct 15, 2023</td>
                                    <td class="px-4 py-3">Tuition Fee</td>
                                    <td class="px-4 py-3">$250.00</td>
                                    <td class="px-4 py-3">
                                        <span
                                            class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">Paid</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <button class="text-primary hover:underline">Download</button>
                                    </td>
                                </tr>
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-4 py-3 font-medium text-gray-900">Sep 15, 2023</td>
                                    <td class="px-4 py-3">Tuition Fee</td>
                                    <td class="px-4 py-3">$250.00</td>
                                    <td class="px-4 py-3">
                                        <span
                                            class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">Paid</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <button class="text-primary hover:underline">Download</button>
                                    </td>
                                </tr>
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-4 py-3 font-medium text-gray-900">Aug 15, 2023</td>
                                    <td class="px-4 py-3">Tuition Fee</td>
                                    <td class="px-4 py-3">$250.00</td>
                                    <td class="px-4 py-3">
                                        <span
                                            class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">Paid</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <button class="text-primary hover:underline">Download</button>
                                    </td>
                                </tr>
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-4 py-3 font-medium text-gray-900">Jul 20, 2023</td>
                                    <td class="px-4 py-3">Lab Fee</td>
                                    <td class="px-4 py-3">$100.00</td>
                                    <td class="px-4 py-3">
                                        <span
                                            class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">Paid</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <button class="text-primary hover:underline">Download</button>
                                    </td>
                                </tr>
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-4 py-3 font-medium text-gray-900">Jul 15, 2023</td>
                                    <td class="px-4 py-3">Tuition Fee</td>
                                    <td class="px-4 py-3">$212.50</td>
                                    <td class="px-4 py-3">
                                        <span
                                            class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">Paid</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <button class="text-primary hover:underline">Download</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Guardians Tab -->
        <div class="tab-content hidden" id="guardians-tab">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Guardian 1 Card -->
                <div class="info-card bg-white rounded-xl shadow-md p-6">
                    <div class="flex items-start">
                        <div class="h-16 w-16 rounded-full overflow-hidden mr-4">
                            <img class="h-full w-full object-cover"
                                src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=774&q=80"
                                alt="Guardian photo">
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-gray-800">Robert Doe</h3>
                            <p class="text-secondary">Father</p>
                            <div class="mt-4 space-y-2">
                                <div class="flex items-center">
                                    <i class="fas fa-phone text-secondary mr-2 w-5"></i>
                                    <span>+1 (555) 123-4567</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-envelope text-secondary mr-2 w-5"></i>
                                    <span>robert.doe@example.com</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-briefcase text-secondary mr-2 w-5"></i>
                                    <span>Software Engineer</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-home text-secondary mr-2 w-5"></i>
                                    <span>123 Main St, Anytown, USA</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Guardian 2 Card -->
                <div class="info-card bg-white rounded-xl shadow-md p-6">
                    <div class="flex items-start">
                        <div class="h-16 w-16 rounded-full overflow-hidden mr-4">
                            <img class="h-full w-full object-cover"
                                src="https://images.unsplash.com/photo-1552058544-f2b08422138a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=798&q=80"
                                alt="Guardian photo">
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-gray-800">Jennifer Doe</h3>
                            <p class="text-secondary">Mother</p>
                            <div class="mt-4 space-y-2">
                                <div class="flex items-center">
                                    <i class="fas fa-phone text-secondary mr-2 w-5"></i>
                                    <span>+1 (555) 987-6543</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-envelope text-secondary mr-2 w-5"></i>
                                    <span>jennifer.doe@example.com</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-briefcase text-secondary mr-2 w-5"></i>
                                    <span>Architect</span>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-home text-secondary mr-2 w-5"></i>
                                    <span>123 Main St, Anytown, USA</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tabLinks = document.querySelectorAll(".tab-link");
            const tabContents = document.querySelectorAll(".tab-content");

            tabLinks.forEach(link => {
                link.addEventListener("click", function() {
                    const target = this.dataset.tab + "-tab";

                    // Remove active state from all buttons
                    tabLinks.forEach(btn => {
                        btn.classList.remove("active", "text-primary", "border-primary");
                        btn.classList.add("hover:text-gray-600", "hover:border-gray-300",
                            "border-transparent");
                    });

                    // Hide all tab contents
                    tabContents.forEach(content => {
                        content.classList.add("hidden");
                        content.classList.remove("active");
                    });

                    // Add active state to clicked button
                    this.classList.add("active", "text-primary", "border-primary");
                    this.classList.remove("hover:text-gray-600", "hover:border-gray-300",
                        "border-transparent");

                    // Show target tab
                    const activeTab = document.getElementById(target);
                    if (activeTab) {
                        activeTab.classList.remove("hidden");
                        activeTab.classList.add("active");
                    }
                });
            });
        });
    </script>
@endpush
