<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Section;
use App\Models\Payment;
use App\Models\Attendance;
use App\Models\Notice;
use Carbon\Carbon;

class HomeController extends Controller
{
  public function index()
  {
    $teachers = Teacher::count();
    $students = Student::count();
    $data = [
      'totalStudents' => $students,
      'totalTeachers' => $teachers,
      'activeClasses' => 12,
      'feesCollected' => 87550.00,
      'recentStudents' => [
        [
          'id' => 138,
          'user_id' => 315,
          'admission_number' => 'STU2023142',
          'class_id' => 8,
          'section_id' => 3,
          'created_at' => '2023-11-15 08:45:00',
          'user' => [
            'id' => 315,
            'name' => 'Emma Wilson',
            'email' => 'emma.w@example.com',
            'profile_photo_path' => null
          ]
        ],
        [
          'id' => 137,
          'user_id' => 314,
          'admission_number' => 'STU2023141',
          'class_id' => 5,
          'section_id' => 2,
          'created_at' => '2023-11-14 14:20:00',
          'user' => [
            'id' => 314,
            'name' => 'Raj Patel',
            'email' => 'raj.p@example.com',
            'profile_photo_path' => null
          ]
        ],
        [
          'id' => 136,
          'user_id' => 313,
          'admission_number' => 'STU2023140',
          'class_id' => 7,
          'section_id' => 1,
          'created_at' => '2023-11-12 10:15:00',
          'user' => [
            'id' => 313,
            'name' => 'Sophia Chen',
            'email' => 'sophia.c@example.com',
            'profile_photo_path' => null
          ]
        ],
        [
          'id' => 135,
          'user_id' => 312,
          'admission_number' => 'STU2023139',
          'class_id' => 6,
          'section_id' => 4,
          'created_at' => '2023-11-10 16:30:00',
          'user' => [
            'id' => 312,
            'name' => 'Michael Brown',
            'email' => 'michael.b@example.com',
            'profile_photo_path' => null
          ]
        ],
        [
          'id' => 134,
          'user_id' => 311,
          'admission_number' => 'STU2023138',
          'class_id' => 8,
          'section_id' => 3,
          'created_at' => '2023-11-08 09:00:00',
          'user' => [
            'id' => 311,
            'name' => 'Olivia Garcia',
            'email' => 'olivia.g@example.com',
            'profile_photo_path' => null
          ]
        ]
      ],
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
