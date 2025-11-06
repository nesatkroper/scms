<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGuardianRequest;
use App\Http\Requests\UpdateGuardianRequest;
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
        $guardians = User::role('guardian')
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%")
                    ->orWhere('occupation', 'like', "%{$search}%")
                    ->orWhere('company', 'like', "%{$search}%");
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
            
            // Create uploads directory if it doesn't exist
            $uploadPath = public_path('uploads/guardians');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            // Handle avatar upload
            if ($request->hasFile('avatar')) {
                $avatar = $request->file('avatar');
                $avatarName = time() . '-' . date('d-m-Y') . '_add_avatar.' . $avatar->getClientOriginalExtension();
                $avatar->move($uploadPath, $avatarName);
                $validated['avatar'] = 'uploads/guardians/' . $avatarName;
            }

            // Add password and create user
            $validated['password'] = bcrypt('password123'); // Default password

            $guardian = User::create($validated);
            
            // Assign guardian role
            $guardian->assignRole('guardian');

            return response()->json([
                'success' => true,
                'message' => 'Guardian created successfully!',
                'data' => $guardian
            ]);
        } catch (\Exception $e) {
            Log::error('Error creating guardian: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error creating guardian: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show(User $guardian)
    {
        // $guardian->load('students');
        return response()->json([
            'success' => true,
            'data' => $guardian
        ]);
    }

    public function update(UpdateGuardianRequest $request, User $guardian)
    {
        try {
            $data = $request->validated();
            // Handle photo upload
            if ($request->hasFile('avatar')) {
                // Delete old photo if exists
                if ($guardian->avatar && file_exists(public_path($guardian->avatar))) {
                    unlink(public_path($guardian->avatar));
                }
                $avatar = $request->file('avatar');
                $photoName = time()  . '-' . date('d-m-Y') . '_ed_photo.' . $avatar->getClientOriginalExtension();
                $photoPath = public_path('uploads/guardians');
                $avatar->move($photoPath, $photoName);
                $data['avatar'] = 'uploads/guardians/' . $photoName;
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

    public function destroy(User $guardian)
    {
        try {
            // Delete avatar if exists
            if ($guardian->avatar && file_exists(public_path($guardian->avatar))) {
                unlink(public_path($guardian->avatar));
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
