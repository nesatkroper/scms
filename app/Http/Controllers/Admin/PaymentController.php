<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Models\Fee;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use App\Notifications\FeePaidNotification;

class PaymentController extends Controller
{
  public function store(Fee $fee, PaymentRequest $request): RedirectResponse
  {
    try {
      $data = $request->validated();
      $data['received_by'] = $data['received_by'] ?? Auth::id();
      $fee->update($data);
      $notifiableUsers = User::role(['admin', 'staff'])->get();
      Notification::send($notifiableUsers, new FeePaidNotification($fee));

      return redirect()
        ->route('admin.fees.show', $fee->id)
        ->with('success', 'Fee marked as paid successfully.');
    } catch (\Exception $e) {
      return back()
        ->withInput()
        ->with('error', 'Failed to process payment. Error: ' . $e->getMessage());
    }
  }
}
