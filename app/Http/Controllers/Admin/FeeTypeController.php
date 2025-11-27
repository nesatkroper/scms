<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeeType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class FeeTypeController extends BaseController
{
  public function __construct()
  {
    parent::__construct();
    $this->applyPermissions();
  }

  protected function ModelPermissionName(): string
  {
    return 'Fee-Type';
  }

  public function index(Request $request)
  {
    $search = $request->input('search');
    $perPage = $request->input('per_page', 10);

    $feeTypes = FeeType::when($search, function ($query) use ($search) {
      return $query->where('name', 'like', "%{$search}%")
        ->orWhere('description', 'like', "%{$search}%");
    })
      ->withCount('fees')
      ->orderBy('created_at', 'desc')
      ->paginate($perPage)
      ->appends([
        'search' => $search,
        'per_page' => $perPage,
      ]);

    return view('admin.fee_types.index', compact('feeTypes'));
  }

  public function create()
  {
    return view('admin.fee_types.create');
  }

  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'name' => 'required|string|max:255|unique:fee_types,name',
      'description' => 'nullable|string|max:1000',
    ]);

    try {
      FeeType::create($validatedData);
      return redirect()->route('admin.fee_types.index')->with('success', 'Fee Type created successfully!');
    } catch (\Exception $e) {
      Log::error('Error creating fee type: ' . $e->getMessage());
      return redirect()->route('admin.fee_types.create')->with('error', 'Error creating fee type.')->withInput();
    }
  }

  public function show(FeeType $feeType)
  {
    $feeType->load(['fees' => function ($query) {
      $query->with(['student', 'payments']);
    }]);

    return view('admin.fee_types.show', compact('feeType'));
  }

  public function edit(FeeType $feeType)
  {
    return view('admin.fee_types.edit', compact('feeType'));
  }

  public function update(Request $request, FeeType $feeType)
  {
    $validatedData = $request->validate([
      'name' => 'required|string|max:255|unique:fee_types,name,' . $feeType->id,
      'description' => 'nullable|string|max:1000',
    ]);

    try {
      $feeType->update($validatedData);
      return redirect()->route('admin.fee_types.index')->with('success', 'Fee Type updated successfully');
    } catch (\Exception $e) {
      Log::error('Error updating fee type: ' . $e->getMessage());
      return redirect()->route('admin.fee_types.edit', $feeType)->with('error', 'Error updating fee type.')->withInput();
    }
  }

  public function destroy(FeeType $feeType)
  {
    try {
      $feeType->delete();
      return redirect()->route('admin.fee_types.index')->with('success', 'Fee Type deleted successfully');
    } catch (\Exception $e) {
      Log::error('Error deleting fee type: ' . $e->getMessage());
      return redirect()->back()->with('error', 'Error deleting fee type: ' . $e->getMessage());
    }
  }
}
