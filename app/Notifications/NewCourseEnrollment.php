<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;
use App\Models\StudentCourse;

class NewCourseEnrollment extends Notification
{
  use Queueable;

  public StudentCourse $enrollment;

  public function __construct(StudentCourse $enrollment)
  {
    $this->enrollment = $enrollment;
  }

  public function via(object $notifiable): array
  {
    return ['database'];
  }

  public function toDatabase(object $notifiable): array
  {
    $this->enrollment->load('student', 'courseOffering.subject');

    $studentName = $this->enrollment->student->name ?? 'Unknown Student';
    $courseName = $this->enrollment->courseOffering->subject->name ?? 'Unknown Course';

    return [
      'title' => "New Enrollment: {$studentName} in {$courseName}",
      'body' => "{$studentName} has successfully enrolled in the course '{$courseName}'. The fee is \${$this->enrollment->courseOffering->fee}.",
      'link' => route('admin.student_courses.show', $this->enrollment->id),
      'date' => $this->enrollment->created_at?->format('M d, Y H:i A'),
    ];
  }
}
