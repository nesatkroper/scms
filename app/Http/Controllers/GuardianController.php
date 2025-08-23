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
        $guardians = Guardian::with('students')
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%")
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
                'table' => view('admin.guardians.partials.table', compact('guardians'))->render(),
                'cards' => view('admin.guardians.partials.cardlist', compact('guardians'))->render(),
                'pagination' => $guardians->links()->toHtml()
            ];

            return response()->json([
                'success' => true,
                'html' => $html,
                'view' => $viewType
            ]);
        }

        return view('admin.guardians.index', compact('guardians'));
    }

    public function store(StoreGuardianRequest $request)
    {
        try {
            $validated = $request->validated();
            $studentPhotoPath = public_path('photos/guardians');

            if (!file_exists($studentPhotoPath)) {
                mkdir($studentPhotoPath, 0755, true);
            }

            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');
                $photoName = time() . '-' . date('d-m-Y') . '_add' . $photo->getClientOriginalName();
                $photo->move($studentPhotoPath, $photoName);
                $validated['photo'] = 'photos/guardians/' . $photoName;
            }

            $guardian = Guardian::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Guardian created successfully!',
                'data' => $guardian
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating guardian: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show(Guardian $guardian)
    {
        $guardian->load('students');
        return response()->json([
            'success' => true,
            'data' => $guardian
        ]);
    }

    public function update(UpdateGuardianRequest $request, Guardian $guardian)
    {
        try {
            $data = $request->validated();
            // Handle photo upload
            if ($request->hasFile('photo')) {
                // Delete old photo if exists
                if ($guardian->photo && file_exists(public_path($guardian->photo))) {
                    unlink(public_path($guardian->photo));
                }
                $photo = $request->file('photo');
                $photoName = time()  . '-' . date('d-m-Y') . '_ed' . $photo->getClientOriginalName();
                $photoPath = public_path('photos/guardians');
                $photo->move($photoPath, $photoName);
                $data['photo'] = 'photos/guardians/' . $photoName;
            }

            $guardian->update($data);
            return response()->json([
                'success' => true,
                'message' => 'Guardian updated successfully',
                'data' => $guardian->fresh('students')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating teacher: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Guardian $guardian)
    {
        try {
            // Delete avatar if exists
            if ($guardian->photo && file_exists(public_path($guardian->photo))) {
                unlink(public_path($guardian->photo));
            }
            $guardian->delete();
            return response()->json([
                'success' => true,
                'message' => 'Guardian deleted successfully!'
            ]);
        } catch (\Exception $e) {
            Log::error('Error deleting Guardian: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error deleting Guardian: ' . $e->getMessage()
            ], 500);
        }
    }
}
