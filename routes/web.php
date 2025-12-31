<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BudgetController;
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

    // Budget Calculator Tracker Routes
    Route::prefix('trackers/budget-calculator')->group(function () {
        Route::get('/categories', function () {
            return Inertia::render('Dashboard/Trackers/BudgetCalculator/Categories');
        })->name('trackers.budget.categories');

        Route::get('/budget', function () {
            return Inertia::render('Dashboard/Trackers/BudgetCalculator/Budget');
        })->name('trackers.budget.budget');

        Route::get('/transactions', function () {
            return Inertia::render('Dashboard/Trackers/BudgetCalculator/Transactions');
        })->name('trackers.budget.transactions');
    });

    // Budget Calculator API Routes
    Route::prefix('api/budget')->group(function () {
        // Categories
        Route::get('/categories', [BudgetController::class, 'getCategories']);
        Route::post('/categories', [BudgetController::class, 'storeCategory']);
        Route::put('/categories/{id}', [BudgetController::class, 'updateCategory']);
        Route::delete('/categories/{id}', [BudgetController::class, 'deleteCategory']);

        // Budgets
        Route::get('/budgets', [BudgetController::class, 'getBudgets']);
        Route::post('/budgets', [BudgetController::class, 'storeBudget']);
        Route::put('/budgets/{id}', [BudgetController::class, 'updateBudget']);
        Route::delete('/budgets/{id}', [BudgetController::class, 'deleteBudget']);

        // Transactions
        Route::get('/transactions', [BudgetController::class, 'getTransactions']);
        Route::post('/transactions', [BudgetController::class, 'storeTransaction']);
        Route::put('/transactions/{id}', [BudgetController::class, 'updateTransaction']);
        Route::delete('/transactions/{id}', [BudgetController::class, 'deleteTransaction']);
    });
});
