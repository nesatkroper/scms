<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExamRequest;
use App\Models\Exam;
use App\Models\CourseOffering;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class NotificationController extends Controller
{
  public function index()
  {
    // Get all notifications for the authenticated user
    $notifications = Auth::user()->notifications()->paginate(15);

    return view('admin.notifications.index', compact('notifications'));
  }

  public function markAllAsRead()
  {
    Auth::user()->unreadNotifications->markAsRead();

    return back()->with('success', 'All notifications marked as read.');
  }

  public function markAsRead(string $id)
  {
    $notification = Auth::user()->unreadNotifications()->find($id);

    if ($notification) {
      $notification->markAsRead();
      return back()->with('status', 'Notification marked as read.');
    }

    return back();
  }
}
