<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
  public function login(Request $request)
  {
    try {
      $request->validate([
        'email'    => 'required|email',
        'password' => 'required|min:6',
      ]);

      if (!Auth::attempt($request->only('email', 'password'))) {
        return response()->json([
          'status'  => false,
          'message' => 'Invalid email or password',
        ], 401);
      }

      $user = Auth::user();


      $token = $user->createToken('api-token')->plainTextToken;

      return response()->json([
        'status'  => true,
        'message' => 'Login successful',
        'token'   => $token,
        'user'    => [
          'id'          => $user->id,
          'name'        => $user->name,
          'email'       => $user->email,
          'phone'       => $user->phone,
          'avatar_url'  => $user->avatar_url,
        ]
      ], 200);
    } catch (ValidationException $e) {
      return response()->json([
        'status'  => false,
        'message' => 'Validation failed',
        'errors'  => $e->errors(),
      ], 422);
    } catch (\Exception $e) {
      return response()->json([
        'status'  => false,
        'message' => 'Something went wrong while trying to login',
        'error'   => $e->getMessage(),
      ], 500);
    }
  }


  public function logout(Request $request)
  {
    try {
      $request->user()->currentAccessToken()->delete();

      return response()->json([
        'status'  => true,
        'message' => 'Logged out successfully'
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'status'  => false,
        'message' => 'Something went wrong while logging out',
        'error'   => $e->getMessage(),
      ], 500);
    }
  }

  public function profile(Request $request)
  {
    try {
      $user = $request->user()->load([
        'fees',
        'attendances',
        'scores',
        'approvedExpenses',
        'teachingCourses',
        'enrollments.courseOffering',
        'courseOfferings'
      ]);

      return response()->json([
        'status' => true,
        'user'   => $user
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'status'  => false,
        'message' => 'Failed to load user profile',
        'error'   => $e->getMessage(),
      ], 500);
    }
  }
}
