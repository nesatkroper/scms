<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGuardianRequest;
use App\Http\Requests\UpdateGuardianRequest;
use App\Models\Guardian;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class GuardianController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);
        $viewType = $request->input('view', 'table');
        $users = User::all();

        $guardians = Guardian::with('students')
            ->when($search, function ($query) use ($search) {
                return $query->where('user_id', 'like', "%{$search}%")
                    ->orWhere('occupation', 'like', "%{$search}%")
                    ->orWhere('company', 'like', "%{$search}%")
                    ->orWhere('relation', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage)
            ->appends([
                'search' => $search,
                'per_page' => $perPage,
                'view' => $viewType
            ]);

        if ($request->ajax()) {
            $html = [
                'table' => view('guardians.partials.table', compact('guardians'))->render(),
                'cards' => view('guardians.partials.cardlist', compact('guardians'))->render(),
                'pagination' => $guardians->links()->toHtml()
            ];

            return response()->json([
                'success' => true,
                'html' => $html,
                'view' => $viewType
            ]);
        }

        return view('guardians.index', compact('guardians', 'users'));
    }


    public function create()
    {
        return view('guardians.create');
    }

    public function store(StoreGuardianRequest $request)
    {
        $guardian = Guardian::create($request->validated());
        $guardian->load('students');
        return redirect()->route('guardians.index')->with('success', 'Guardian added successfully!');
    }

    public function show(Guardian $guardian)
    {
        $guardian->load('students');
        return view('guardians.show', compact('guardian'));
    }

    public function edit(Guardian $guardian)
    {
        $guardian->load('students');
        return view('guardians.edit', compact('guardian'));
    }

    public function update(UpdateGuardianRequest $request, Guardian $guardian)
    {
        $guardian->update($request->validated());
        $guardian->load('students');
        return redirect()->route('guardians.show', $guardian)->with('success', 'Guardian updated successfully!');
    }

    public function destroy(Guardian $guardian)
    {
        $guardian->delete();
        return redirect()->route('guardians.index')->with('success', 'Guardian deleted successfully!');
    }
}
