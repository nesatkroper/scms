<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;
use App\Models\Payment;

class PaymentConfirmed extends Notification
{
  use Queueable;

  public Payment $payment;

  public function __construct(Payment $payment)
  {
    $this->payment = $payment;
  }

  public function via(object $notifiable): array
  {
    return ['database'];
  }

  public function toDatabase(object $notifiable): array
  {
    $paymentFor = $this->getPaymentType();

    return [
      'title' => "Payment Confirmed: \${$this->payment->amount}",
      'body' => "Your payment of \${$this->payment->amount} for {$paymentFor} has been successfully processed via {$this->payment->payment_method}. Transaction ID: {$this->payment->transaction_id}",
      'link' => route('admin.payments.show', $this->payment->id),
      'date' => $this->payment->payment_date?->format('M d, Y'),
    ];
  }

  protected function getPaymentType(): string
  {
    if ($this->payment->fee_id) {
      return $this->payment->fee->feeType?->name ?? 'a Fee';
    }
    if ($this->payment->course_offering_id) {
      return $this->payment->courseOffering->subject?->name ?? 'Course Enrollment';
    }
    return 'a service';
  }
}
