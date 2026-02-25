<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CourseOffering;
use Illuminate\Http\Request;

class CourseOfferingController extends Controller
{
  // public function index()
  // {
  //   $offerings = CourseOffering::with([
  //     'subject',
  //     'teacher',
  //     'classroom'
  //   ])->latest()->get();

  //   return response()->json($offerings);
  // }

  public function index()
  {
    try {
      $offerings = CourseOffering::with([
        'subject',
        'teacher',
        'classroom'
      ])
        ->where('end_time', '>', now())
        ->latest()
        ->get();

      return response()->json([
        'success' => true,
        'data' => $offerings
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'success' => false,
        'message' => 'Failed to fetch course offerings',
        'error' => $e->getMessage()
      ], 500);
    }
  }
}
