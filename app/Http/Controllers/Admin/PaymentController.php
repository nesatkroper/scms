<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Fee;
use App\Models\Payment;
use App\Models\StudentFee;
use App\Models\User;
use App\Notifications\PaymentConfirmed;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PaymentController extends BaseController
{
  public function __construct()
  {
    parent::__construct();
    $this->applyPermissions();
  }

  protected function ModelPermissionName(): string
  {
    return 'Payment';
  }

  public function index()
  {
    $payments = Payment::with(['studentFee', 'receiver'])->paginate(10);
    return view('payments.index', compact('payments'));
  }

  public function create()
  {
    $studentFees = Fee::all();
    $receivers = User::all();
    return view('payments.create', compact('studentFees', 'receivers'));
  }

  public function store(PaymentRequest $request)
  {
    try {
      $data = $request->validated();
      $data['received_by'] = Auth::id();
      if (empty($data['transaction_id'])) {
        $data['transaction_id'] = strtoupper(uniqid('PAY'));
      }

      $payment = Payment::create($data);

      if ($payment->fee_id) {
        $fee = Fee::find($payment->fee_id);
        if ($fee && $payment->amount >= $fee->amount) {
          $fee->update(['status' => 'paid', 'paid_date' => $payment->payment_date ?? now()]);
        }
      }

      $payment->student->notify(new PaymentConfirmed($payment));


      return redirect()->route('admin.payments.index')->with('success', 'Payment recorded and student notified!');
    } catch (\Exception $e) {
      Log::error('Error creating Payment: ' . $e->getMessage());
      return back()->with('error', 'Error recording payment.')->withInput();
    }
  }

  public function show(Payment $payment)
  {
    $payment->load(['studentFee', 'receiver']);
    return view('payments.show', compact('payment'));
  }

  public function edit(Payment $payment)
  {
    $payment->load(['studentFee', 'receiver']);
    $studentFees = Fee::all();
    $receivers = User::all();
    return view('payments.edit', compact('payment', 'studentFees', 'receivers'));
  }

  public function update(PaymentRequest $request, Payment $payment)
  {
    $payment->update($request->validated());
    return redirect()->route('payments.show', $payment)->with('success', 'Payment updated successfully!');
  }

  public function destroy(Payment $payment)
  {
    $payment->delete();
    return redirect()->route('payments.index')->with('success', 'Payment deleted successfully!');
  }
}
