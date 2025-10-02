<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
  public function show(Request $request)
  {
    $user = Auth::user();

    if (!$user) {
      return redirect('/login');
    }

    return view('admin.profile.show', [
      'user' => $user,
    ]);
  }
}
