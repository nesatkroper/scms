<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeeType;
use App\Http\Requests\StoreFeeTypeRequest;
use App\Http\Requests\UpdateFeeTypeRequest;

class FeeTypeController extends Controller
{
    public function index()
    {
        $feeTypes = FeeType::all();
        return view('admin.fee-types.index', compact('feeTypes'));
    }

    public function create()
    {
        return view('admin.fee-types.create');
    }

    public function store(StoreFeeTypeRequest $request)
    {
        FeeType::create($request->validated());
        return redirect()->route('admin.fee-types.index')->with('success', 'FeeType created successfully');
    }

    public function edit($id)
    {
        $feeType = FeeType::findOrFail($id);
        return view('admin.fee-types.edit', compact('feeType'));
    }

    public function update(UpdateFeeTypeRequest $request, $id)
    {
        $feeType = FeeType::findOrFail($id);
        $($request->validated());
        return redirect()->route('admin.fee-types.index')->with('success', 'FeeType updated successfully');
    }

    public function destroy($id)
    {
        $feeType = FeeType::findOrFail($id);
        $();
        return redirect()->route('admin.fee-types.index')->with('success', 'FeeType deleted successfully');
    }
}