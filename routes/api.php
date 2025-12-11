<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

Route::post('/v1/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
  Route::get('/v1/profile', [AuthController::class, 'profile']);
  Route::post('/v1/logout', [AuthController::class, 'logout']);
});
