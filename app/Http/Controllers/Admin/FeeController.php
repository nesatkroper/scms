<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fee;
use App\Http\Requests\StoreFeeRequest;
use App\Http\Requests\UpdateFeeRequest;

class FeeController extends Controller
{
    public function index()
    {
        $fees = Fee::all();
        return view('admin.fees.index', compact('fees'));
    }

    public function create()
    {
        return view('admin.fees.create');
    }

    public function store(StoreFeeRequest $request)
    {
        Fee::create($request->validated());
        return redirect()->route('admin.fees.index')->with('success', 'Fee created successfully');
    }

    public function edit($id)
    {
        $fee = Fee::findOrFail($id);
        return view('admin.fees.edit', compact('fee'));
    }

    public function update(UpdateFeeRequest $request, $id)
    {
        $fee = Fee::findOrFail($id);
        $($request->validated());
        return redirect()->route('admin.fees.index')->with('success', 'Fee updated successfully');
    }

    public function destroy($id)
    {
        $fee = Fee::findOrFail($id);
        $();
        return redirect()->route('admin.fees.index')->with('success', 'Fee deleted successfully');
    }
}