<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\NotificationController;

Route::post('/v1/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
  Route::get('/v1/profile', [AuthController::class, 'profile']);
  Route::post('/v1/logout', [AuthController::class, 'logout']);
  Route::post('/v1/change_password', [AuthController::class, 'changePassword']);
  Route::post('/v1/change_avatar', [AuthController::class, 'changeAvatar']);
  Route::post('/v1/send_notification', [NotificationController::class, 'sendToStaff']);
});
