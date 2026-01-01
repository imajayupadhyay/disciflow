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

// Protected customer routes (shows 404 if not authenticated)
Route::middleware('customer.auth')->group(function () {
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
        Route::get('/dashboard', function () {
            return Inertia::render('Dashboard/Trackers/BudgetCalculator/Dashboard');
        })->name('trackers.budget.dashboard');

        Route::get('/categories', function () {
            return Inertia::render('Dashboard/Trackers/BudgetCalculator/Categories');
        })->name('trackers.budget.categories');

        Route::get('/budget', function () {
            return Inertia::render('Dashboard/Trackers/BudgetCalculator/Budget');
        })->name('trackers.budget.budget');

        Route::get('/transactions', function () {
            return Inertia::render('Dashboard/Trackers/BudgetCalculator/Transactions');
        })->name('trackers.budget.transactions');

        Route::get('/export', function () {
            return Inertia::render('Dashboard/Trackers/BudgetCalculator/Export');
        })->name('trackers.budget.export');

        Route::get('/alerts', function () {
            return Inertia::render('Dashboard/Trackers/BudgetCalculator/Alerts');
        })->name('trackers.budget.alerts');

        Route::get('/payment-methods', function () {
            return Inertia::render('Dashboard/Trackers/BudgetCalculator/PaymentMethods');
        })->name('trackers.budget.payment-methods');
    });

    // Budget Calculator API Routes
    Route::prefix('api/budget')->group(function () {
        // Dashboard
        Route::get('/dashboard', [BudgetController::class, 'getDashboardData']);

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

        // Exports
        Route::get('/transactions/export/excel', [BudgetController::class, 'exportExcel']);
        Route::get('/transactions/export/pdf', [BudgetController::class, 'exportPdf']);

        // Alerts
        Route::get('/alerts', [BudgetController::class, 'getAlerts']);
        Route::post('/alerts', [BudgetController::class, 'storeAlert']);
        Route::put('/alerts/{id}', [BudgetController::class, 'updateAlert']);
        Route::patch('/alerts/{id}/toggle', [BudgetController::class, 'toggleAlert']);
        Route::delete('/alerts/{id}', [BudgetController::class, 'deleteAlert']);

        // Payment Methods
        Route::get('/payment-methods', [BudgetController::class, 'getPaymentMethods']);
        Route::post('/payment-methods', [BudgetController::class, 'storePaymentMethod']);
        Route::put('/payment-methods/{id}', [BudgetController::class, 'updatePaymentMethod']);
        Route::delete('/payment-methods/{id}', [BudgetController::class, 'deletePaymentMethod']);
    });
});
