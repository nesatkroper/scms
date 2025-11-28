<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\CourseOffering;
use App\Models\Payment;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;

class HomeController extends Controller
{


  public function index()
  {
    $teachers = User::role('Teacher')->count();
    $students = User::role('Student')->count();
    $course = CourseOffering::count();
    $fee = Payment::sum('amount');

    $recentEnrollments = Enrollment::latest()
      ->with(['student', 'courseOffering', 'fee'])
      ->take(5)
      ->get();


    $data = [
      'totalStudents' => $students,
      'totalTeachers' => $teachers,
      'activeCourse' => $course,
      'feesCollected' => $fee,
      'recentStudents' => $recentEnrollments,
      'recentActivities' => [
        [
          'type' => 'enrollment',
          'title' => 'New student enrolled',
          'description' => 'Emma Wilson joined Grade 8',
          'time' => now()->subHours(2),
          'icon' => 'user-plus',
          'color' => 'green'
        ],
        [
          'type' => 'payment',
          'title' => 'Fee payment received',
          'description' => '$1,250 from Michael Brown',
          'time' => now()->subHours(5),
          'icon' => 'money-bill-wave',
          'color' => 'blue'
        ],
        [
          'type' => 'assignment',
          'title' => 'New assignment posted',
          'description' => 'Math homework for Grade 7',
          'time' => now()->subHours(8),
          'icon' => 'book',
          'color' => 'purple'
        ],
        [
          'type' => 'attendance',
          'title' => 'Attendance marked',
          'description' => 'Grade 10 morning session',
          'time' => now()->subHours(12),
          'icon' => 'clipboard-check',
          'color' => 'orange'
        ],
        [
          'type' => 'attendance',
          'title'  => 'Attendance alert',
          'description' => '15 students absent in Grade 11-B',
          'time'  => now()->subDay(),
          'icon' => 'exclamation-triangle',
          'color' => 'red'
        ]
      ]
    ];

    return view('admin.dashboard.index', $data);
  }

  protected function getRecentActivities()
  {
    return [
      [
        'type' => 'enrollment',
        'title' => 'New student enrolled',
        'description' => 'Sarah Johnson joined Grade 10',
        'time' => now()->subHours(2),
        'icon' => 'user-plus',
        'color' => 'green'
      ],
      [
        'type' => 'payment',
        'title' => 'Fee payment received',
        'description' => '$350 from Michael Brown',
        'time' => now()->subHours(5),
        'icon' => 'money-bill-wave',
        'color' => 'blue'
      ],
    ];
  }
}
