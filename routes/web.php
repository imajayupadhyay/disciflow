<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home/Index');
});

Route::get('/trackers', function () {
    return Inertia::render('Trackers/Index');
})->name('trackers.index');

Route::get('/support', function () {
    return Inertia::render('Support/Index');
})->name('support.index');

// Authentication routes
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/logout', [AuthController::class, 'logout']);
Route::get('/auth/user', [AuthController::class, 'user']);
