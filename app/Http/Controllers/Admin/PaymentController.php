<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Models\Fee;
use App\Models\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
  public function store(PaymentRequest $request): RedirectResponse
  {
    $fee = Fee::findOrFail($request->fee_id);

    try {
      $payment = new Payment($request->validated());

      $payment->received_by = $request->received_by ?? Auth::id();

      $fee->payments()->save($payment);


      return redirect()->route('admin.fees.show', $fee->id)
        ->with('success', 'Payment for Fee #' . $fee->id . ' added successfully.');
    } catch (\Exception $e) {
      return back()->withInput()
        ->with('error', 'Failed to add payment. Error: ' . $e->getMessage());
    }
  }

  public function update(PaymentRequest $request, Payment $payment): RedirectResponse
  {
    if ($request->fee_id != $payment->fee_id) {
      return back()->with('error', 'Cannot change the associated fee for this payment.');
    }

    try {
      $payment->fill($request->validated());

      $payment->received_by = $request->received_by ?? $payment->received_by;

      $payment->save();

      $fee = $payment->fee;

      return redirect()->route('admin.fees.show', $fee->id)
        ->with('success', 'Payment #' . $payment->id . ' updated successfully.');
    } catch (\Exception $e) {
      return back()->withInput()
        ->with('error', 'Failed to update payment. Error: ' . $e->getMessage());
    }
  }
}
