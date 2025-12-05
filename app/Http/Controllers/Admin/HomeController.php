<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseOffering;
use App\Models\Enrollment;
use App\Models\Expense;
use App\Models\Fee;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends BaseController
{

  public function __construct()
  {
    parent::__construct();
    $this->applyPermissions();
  }

  protected function ModelPermissionName(): string
  {
    return 'Dashboard';
  }


  public function index()
  {
    $students = User::role('student')->count();
    $teachers = User::role('teacher')->count();
    $course = CourseOffering::count();
    $totalPaid = Fee::whereNotNull('payment_date')->sum('amount');
    $totalUnpaid = Fee::whereNull('payment_date')->sum('amount');
    $totalExpense = Expense::whereNotNull('approved_by')->sum('amount');
    $pendingExpense = Expense::whereNull('approved_by')->sum('amount');

    $recentEnrollments = Enrollment::latest()
      ->with(['student', 'courseOffering', 'fee'])
      ->take(5)
      ->get();

    $data = [
      'totalStudents' => $students,
      'totalTeachers' => $teachers,
      'totalExpense' => $totalExpense,
      'pendingExpense' => $pendingExpense,
      'activeCourse' => $course,
      'feesCollected' => $totalPaid,
      'feesUnpaid' => $totalUnpaid,
      'recentStudents' => $recentEnrollments,
      'recentActivities' =>  Auth::user()->notifications()
        ->take(5)
        ->get()
        ->map(function ($n) {
          return [
            'id'          => $n->id,
            'title'       => $n->data['title'] ?? 'Notification',
            'description' => $n->data['description'] ?? '',
            'icon'        => $n->data['icon'] ?? 'info-circle',
            'color'       => $n->data['color'] ?? 'blue',
            'time'        => $n->created_at,
          ];
        })


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
