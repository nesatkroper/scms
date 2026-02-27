<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
  public function index()
  {
    try {
      $classrooms = Classroom::all();
      return response()->json([
        'success' => true,
        'data' => $classrooms
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'success' => false,
        'message' => 'Failed to fetch classrooms',
        'error' => $e->getMessage()
      ], 500);
    }
  }
}