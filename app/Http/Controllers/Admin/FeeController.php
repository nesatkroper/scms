<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeeRequest;
use App\Models\Fee;
use App\Models\FeeType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FeeController extends Controller
{
  public function index(Request $request)
  {
    $search = $request->input('search');
    $feeTypeId = $request->input('fee_type_id');
    $status = $request->input('status');
    $perPage = $request->input('per_page', 6);

    $fees = Fee::query()
      ->with(['student:id,name,email', 'feeType:id,name'])
      ->when($feeTypeId, fn($q) => $q->where('fee_type_id', $feeTypeId))
      ->when($status, fn($q) => $q->where('status', $status))
      ->when($search, function ($query) use ($search) {
        $query->where(function ($q) use ($search) {
          $q->where('remarks', 'like', "%{$search}%")
            ->orWhere('amount', 'like', "%{$search}%")
            ->orWhereHas('student', fn($q2) => $q2->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%"))
            ->orWhereHas('feeType', fn($q2) => $q2->where('name', 'like', "%{$search}%"));
        });
      })
      ->orderBy('due_date', 'desc')
      ->orderBy('created_at', 'desc')
      ->paginate($perPage)
      ->appends($request->query());

    $feeTypes = FeeType::orderBy('name')->get(['id', 'name']);
    $selectedFeeType = $feeTypeId ? $feeTypes->firstWhere('id', $feeTypeId) : null;
    $statuses = ['unpaid', 'partially_paid', 'paid'];

    return view('admin.fees.index', compact(
      'fees',
      'feeTypes',
      'feeTypeId',
      'selectedFeeType',
      'statuses',
      'status'
    ));
  }

  public function create(Request $request)
  {
    $students = User::where('role', 'student')->get(['id', 'name']);
    $feeTypes = FeeType::orderBy('name')->get(['id', 'name']);
    $selectedFeeType = $request->input('fee_type_id') ? FeeType::find($request->input('fee_type_id')) : null;

    return view('admin.fees.create', compact('students', 'feeTypes', 'selectedFeeType', 'feeTypeId'));
  }

  public function store(FeeRequest $request)
  {
    try {
      $data = $request->validated();
      $data['created_by'] = Auth::id();

      Fee::create($data);

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
    $students = User::where('role', 'student')->get(['id', 'name']);
    $feeTypes = FeeType::orderBy('name')->get(['id', 'name']);
    $selectedFeeType = FeeType::find($fee->fee_type_id);
    $feeTypeId = $fee->fee_type_id;

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
