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

Route::get('/pricing', function () {
    return Inertia::render('Pricing/Index');
})->name('pricing.index');

Route::get('/coming-soon/{tracker?}', function ($tracker = null) {
    return Inertia::render('ComingSoon', [
        'tracker' => $tracker ? ucfirst($tracker) : null
    ]);
})->name('coming-soon');

// Authentication routes
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/logout', [AuthController::class, 'logout']);
Route::get('/auth/user', [AuthController::class, 'user']);

// Protected customer routes
Route::middleware('auth:customer')->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard/Index');
    })->name('dashboard');

    Route::get('/profile', function () {
        return Inertia::render('Dashboard/Profile');
    })->name('profile');

    Route::put('/profile/update', [AuthController::class, 'updateProfile']);
    Route::put('/profile/password', [AuthController::class, 'updatePassword']);
});
