<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\SettingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route as r;

r::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


r::apiResources([
    'setting' => SettingController::class,
    'class' => ClassroomController::class
]);
