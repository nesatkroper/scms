<?php

use Illuminate\Support\Facades\Route;

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


