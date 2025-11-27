<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeeRequest;
use App\Models\Fee;
use App\Models\FeeType;
use App\Models\Payment;
use App\Models\User;
use App\Notifications\FeeAssigned;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class FeeController extends BaseController
{
  public function __construct()
  {
    parent::__construct();
    $this->applyPermissions();
  }

  protected function ModelPermissionName(): string
  {
    return 'Fee';
  }

  // public function index(Request $request)
  // {
  //   $search = $request->input('search');
  //   $feeTypeId = $request->input('fee_type_id');
  //   $status = $request->input('status');
  //   $perPage = $request->input('per_page', 8);

  //   $fees = Fee::query()
  //     ->with(['student:id,name,email', 'feeType:id,name'])
  //     ->when($feeTypeId, fn($q) => $q->where('fee_type_id', $feeTypeId))
  //     ->when($status, fn($q) => $q->where('status', $status))
  //     ->when($search, function ($query) use ($search) {
  //       $query->where(function ($q) use ($search) {
  //         $q->where('remarks', 'like', "%{$search}%")
  //           ->orWhere('amount', 'like', "%{$search}%")
  //           ->orWhereHas('student', fn($q2) => $q2->where('name', 'like', "%{$search}%")
  //             ->orWhere('email', 'like', "%{$search}%"))
  //           ->orWhereHas('feeType', fn($q2) => $q2->where('name', 'like', "%{$search}%"));
  //       });
  //     })
  //     ->orderBy('due_date', 'desc')
  //     ->orderBy('created_at', 'desc')
  //     ->paginate($perPage)
  //     ->appends($request->query());

  //   $feeTypes = FeeType::orderBy('name')->get(['id', 'name']);
  //   $selectedFeeType = $feeTypeId ? $feeTypes->firstWhere('id', $feeTypeId) : null;
  //   $statuses = ['unpaid', 'partially_paid', 'paid'];

  //   return view('admin.fees.index', compact(
  //     'fees',
  //     'feeTypes',
  //     'feeTypeId',
  //     'selectedFeeType',
  //     'statuses',
  //     'status'
  //   ));
  // }

  private function generateTransactionId()
  {
    do {
      $id = 'SCMS-' .
        strtoupper(Str::random(3)) . '-' .
        strtoupper(Str::random(3)) . '-' .
        strtoupper(Str::random(3));
    } while (Payment::where('transaction_id', $id)->exists());

    return $id;
  }


  public function index(Request $request)
  {
    $search     = $request->input('search');
    $feeTypeId  = $request->input('fee_type_id');
    $status     = $request->input('status');
    $perPage    = $request->input('per_page', 8);
    $transaction_id = $this->GenerateTransactionId();

    $fees = Fee::query()
      ->with(['student:id,name,email', 'feeType:id,name'])
      ->withSum('payments as paid_total', 'amount')
      ->when($feeTypeId, fn($q) => $q->where('fee_type_id', $feeTypeId))
      ->when($status, fn($q) => $q->status($status))
      ->when($search, function ($query) use ($search) {
        $query->where(function ($q) use ($search) {
          $q->where('remarks', 'like', "%{$search}%")
            ->orWhere('amount', 'like', "%{$search}%")
            ->orWhereHas('student', fn($s) =>
            $s->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%"))
            ->orWhereHas('feeType', fn($ft) =>
            $ft->where('name', 'like', "%{$search}%"));
        });
      })

      ->orderBy('due_date', 'desc')
      ->orderBy('created_at', 'desc')

      ->paginate($perPage)
      ->appends($request->query());

    $feeTypes = FeeType::orderBy('name')->get(['id', 'name']);
    $selectedFeeType = $feeTypeId ? $feeTypes->firstWhere('id', $feeTypeId) : null;

    $statuses = ['unpaid', 'partially_paid', 'paid', 'overpaid'];

    return view('admin.fees.index', compact(
      'fees',
      'feeTypes',
      'feeTypeId',
      'selectedFeeType',
      'statuses',
      'status',
      'transaction_id'
    ));
  }


  public function markPaid(Fee $fee)
  {
    if ($fee->status === 'paid') {
      return back()->with('error', 'This fee is already marked as paid.');
    }

    $fee->update([
      'status' => 'paid',
      'paid_date' => now(),
    ]);



    return back()->with('success', 'Fee successfully marked as paid.');
  }

  public function create(Request $request)
  {
    $students = User::role('student')->get(['id', 'name']);
    $feeTypes = FeeType::orderBy('name')->get(['id', 'name']);
    $feeTypeId = $request->input('fee_type_id'); // define this variable
    $selectedFeeType = $feeTypeId ? FeeType::find($feeTypeId) : null;

    if ($students->isEmpty()) {
      return redirect()->route('admin.students.create')
        ->with('error', 'No students found. Please create a student first.');
    }

    return view('admin.fees.create', compact('students', 'feeTypes', 'selectedFeeType', 'feeTypeId'));
  }


  public function store(FeeRequest $request)
  {
    try {
      $data = $request->validated();
      $data['created_by'] = Auth::id();

      if (!isset($data['status'])) {
        $data['status'] = 'pending';
      }

      $fee = Fee::create($data);
      $fee->student->notify(new FeeAssigned($fee));

      return redirect()
        ->route('admin.fees.index', ['fee_type_id' => $data['fee_type_id']])
        ->with('success', 'Fee record created successfully!');
    } catch (\Exception $e) {
      Log::error('Error creating Fee: ' . $e->getMessage());
      return back()->with('error', 'Error creating fee record.')->withInput();
    }
  }

  public function show(Fee $fee)
  {
    $fee->load(['student', 'feeType', 'payments', 'creator']);
    return view('admin.fees.show', compact('fee'));
  }

  public function edit(Fee $fee)
  {

    $students = User::role('student')->get(['id', 'name']);
    $feeTypes = FeeType::orderBy('name')->get(['id', 'name']);
    $selectedFeeType = FeeType::find($fee->fee_type_id);
    $feeTypeId = $fee->fee_type_id;

    if ($students->isEmpty()) {
      return redirect()->route('admin.students.create')
        ->with('error', 'No students found. Please create a student first.');
    }

    return view('admin.fees.edit', compact('fee', 'students', 'feeTypes', 'selectedFeeType', 'feeTypeId'));
  }

  public function update(FeeRequest $request, Fee $fee)
  {
    try {
      $data = $request->validated();
      $fee->update($data);

      return redirect()
        ->route('admin.fees.index', ['fee_type_id' => $data['fee_type_id']])
        ->with('success', 'Fee record updated successfully');
    } catch (\Exception $e) {
      Log::error('Error updating Fee: ' . $e->getMessage());
      return back()->with('error', 'Error updating fee record.')->withInput();
    }
  }

  public function destroy(Fee $fee)
  {
    $feeTypeId = $fee->fee_type_id;

    try {
      $fee->delete();
      return redirect()
        ->route('admin.fees.index', ['fee_type_id' => $feeTypeId])
        ->with('success', 'Fee record deleted successfully');
    } catch (\Exception $e) {
      Log::error('Error deleting Fee: ' . $e->getMessage());
      return back()->with('error', 'Error deleting fee record.');
    }
  }
}
