<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\BudgetCategory;
use App\Models\Transaction;
use App\Exports\TransactionsExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class BudgetController extends Controller
{
    // ==================== CATEGORIES ====================

    public function getCategories()
    {
        $customer = Auth::guard('customer')->user();

        $categories = BudgetCategory::where('customer_id', $customer->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'categories' => $categories
        ]);
    }

    public function storeCategory(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:income,expense',
            'color' => 'required|string',
            'icon' => 'nullable|string'
        ]);

        $category = BudgetCategory::create([
            'customer_id' => $customer->id,
            'name' => $validated['name'],
            'type' => $validated['type'],
            'color' => $validated['color'],
            'icon' => $validated['icon'] ?? 'default'
        ]);

        return response()->json([
            'success' => true,
            'category' => $category
        ], 201);
    }

    public function updateCategory(Request $request, $id)
    {
        $customer = Auth::guard('customer')->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:income,expense',
            'color' => 'required|string',
            'icon' => 'nullable|string'
        ]);

        $category = BudgetCategory::where('customer_id', $customer->id)
            ->findOrFail($id);

        $category->update($validated);

        return response()->json([
            'success' => true,
            'category' => $category
        ]);
    }

    public function deleteCategory($id)
    {
        $customer = Auth::guard('customer')->user();

        $category = BudgetCategory::where('customer_id', $customer->id)
            ->findOrFail($id);

        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully'
        ]);
    }

    // ==================== BUDGETS ====================

    public function getBudgets()
    {
        $customer = Auth::guard('customer')->user();

        $budgets = Budget::with('category')
            ->where('customer_id', $customer->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'budgets' => $budgets
        ]);
    }

    public function storeBudget(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        $validated = $request->validate([
            'category_id' => 'required|exists:budget_categories,id',
            'amount' => 'required|numeric|min:0',
            'period' => 'required|in:daily,weekly,monthly,yearly',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date'
        ]);

        $budget = Budget::create([
            'customer_id' => $customer->id,
            'category_id' => $validated['category_id'],
            'amount' => $validated['amount'],
            'period' => $validated['period'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'] ?? null
        ]);

        $budget->load('category');

        return response()->json([
            'success' => true,
            'budget' => $budget
        ], 201);
    }

    public function updateBudget(Request $request, $id)
    {
        $customer = Auth::guard('customer')->user();

        $validated = $request->validate([
            'category_id' => 'required|exists:budget_categories,id',
            'amount' => 'required|numeric|min:0',
            'period' => 'required|in:daily,weekly,monthly,yearly',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date'
        ]);

        $budget = Budget::where('customer_id', $customer->id)
            ->findOrFail($id);

        $budget->update($validated);
        $budget->load('category');

        return response()->json([
            'success' => true,
            'budget' => $budget
        ]);
    }

    public function deleteBudget($id)
    {
        $customer = Auth::guard('customer')->user();

        $budget = Budget::where('customer_id', $customer->id)
            ->findOrFail($id);

        $budget->delete();

        return response()->json([
            'success' => true,
            'message' => 'Budget deleted successfully'
        ]);
    }

    // ==================== TRANSACTIONS ====================

    public function getTransactions()
    {
        $customer = Auth::guard('customer')->user();

        $transactions = Transaction::with('category')
            ->where('customer_id', $customer->id)
            ->orderBy('transaction_date', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'transactions' => $transactions
        ]);
    }

    public function storeTransaction(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        $validated = $request->validate([
            'category_id' => 'required|exists:budget_categories,id',
            'type' => 'required|in:income,expense',
            'amount' => 'required|numeric|min:0',
            'transaction_date' => 'required|date',
            'description' => 'nullable|string',
            'payment_method' => 'nullable|string'
        ]);

        $transaction = Transaction::create([
            'customer_id' => $customer->id,
            'category_id' => $validated['category_id'],
            'type' => $validated['type'],
            'amount' => $validated['amount'],
            'transaction_date' => $validated['transaction_date'],
            'description' => $validated['description'] ?? null,
            'payment_method' => $validated['payment_method'] ?? null
        ]);

        $transaction->load('category');

        return response()->json([
            'success' => true,
            'transaction' => $transaction
        ], 201);
    }

    public function updateTransaction(Request $request, $id)
    {
        $customer = Auth::guard('customer')->user();

        $validated = $request->validate([
            'category_id' => 'required|exists:budget_categories,id',
            'type' => 'required|in:income,expense',
            'amount' => 'required|numeric|min:0',
            'transaction_date' => 'required|date',
            'description' => 'nullable|string',
            'payment_method' => 'nullable|string'
        ]);

        $transaction = Transaction::where('customer_id', $customer->id)
            ->findOrFail($id);

        $transaction->update($validated);
        $transaction->load('category');

        return response()->json([
            'success' => true,
            'transaction' => $transaction
        ]);
    }

    public function deleteTransaction($id)
    {
        $customer = Auth::guard('customer')->user();

        $transaction = Transaction::where('customer_id', $customer->id)
            ->findOrFail($id);

        $transaction->delete();

        return response()->json([
            'success' => true,
            'message' => 'Transaction deleted successfully'
        ]);
    }

    // ==================== DASHBOARD ====================

    public function getDashboardData()
    {
        $customer = Auth::guard('customer')->user();

        // Get date range (last 6 months)
        $startDate = now()->subMonths(6)->startOfMonth();
        $endDate = now()->endOfMonth();

        // Summary statistics
        $totalIncome = Transaction::where('customer_id', $customer->id)
            ->where('type', 'income')
            ->whereBetween('transaction_date', [$startDate, $endDate])
            ->sum('amount');

        $totalExpenses = Transaction::where('customer_id', $customer->id)
            ->where('type', 'expense')
            ->whereBetween('transaction_date', [$startDate, $endDate])
            ->sum('amount');

        $balance = $totalIncome - $totalExpenses;

        // Expenses by category
        $expensesByCategory = Transaction::with('category')
            ->where('customer_id', $customer->id)
            ->where('type', 'expense')
            ->whereBetween('transaction_date', [$startDate, $endDate])
            ->selectRaw('category_id, SUM(amount) as total')
            ->groupBy('category_id')
            ->get()
            ->map(function ($item) {
                return [
                    'category' => $item->category->name,
                    'amount' => floatval($item->total),
                    'color' => $item->category->color
                ];
            });

        // Income by category
        $incomeByCategory = Transaction::with('category')
            ->where('customer_id', $customer->id)
            ->where('type', 'income')
            ->whereBetween('transaction_date', [$startDate, $endDate])
            ->selectRaw('category_id, SUM(amount) as total')
            ->groupBy('category_id')
            ->get()
            ->map(function ($item) {
                return [
                    'category' => $item->category->name,
                    'amount' => floatval($item->total),
                    'color' => $item->category->color
                ];
            });

        // Monthly income vs expenses (last 6 months)
        $monthlyData = [];
        for ($i = 5; $i >= 0; $i--) {
            $monthStart = now()->subMonths($i)->startOfMonth();
            $monthEnd = now()->subMonths($i)->endOfMonth();

            $monthIncome = Transaction::where('customer_id', $customer->id)
                ->where('type', 'income')
                ->whereBetween('transaction_date', [$monthStart, $monthEnd])
                ->sum('amount');

            $monthExpense = Transaction::where('customer_id', $customer->id)
                ->where('type', 'expense')
                ->whereBetween('transaction_date', [$monthStart, $monthEnd])
                ->sum('amount');

            $monthlyData[] = [
                'month' => $monthStart->format('M Y'),
                'income' => floatval($monthIncome),
                'expense' => floatval($monthExpense)
            ];
        }

        // Budget progress
        $budgets = Budget::with('category')
            ->where('customer_id', $customer->id)
            ->where(function ($query) {
                $query->whereNull('end_date')
                    ->orWhere('end_date', '>=', now());
            })
            ->get()
            ->map(function ($budget) {
                return [
                    'id' => $budget->id,
                    'category' => $budget->category->name,
                    'color' => $budget->category->color,
                    'amount' => floatval($budget->amount),
                    'spent' => floatval($budget->spent),
                    'remaining' => floatval($budget->remaining),
                    'percentage' => floatval($budget->percentage),
                    'period' => $budget->period
                ];
            });

        // Recent transactions (last 10)
        $recentTransactions = Transaction::with('category')
            ->where('customer_id', $customer->id)
            ->orderBy('transaction_date', 'desc')
            ->limit(10)
            ->get();

        // Spending trends by payment method
        $spendingByPaymentMethod = Transaction::where('customer_id', $customer->id)
            ->where('type', 'expense')
            ->whereBetween('transaction_date', [$startDate, $endDate])
            ->whereNotNull('payment_method')
            ->selectRaw('payment_method, SUM(amount) as total')
            ->groupBy('payment_method')
            ->get()
            ->map(function ($item) {
                return [
                    'method' => $item->payment_method,
                    'amount' => floatval($item->total)
                ];
            });

        return response()->json([
            'success' => true,
            'data' => [
                'summary' => [
                    'totalIncome' => $totalIncome,
                    'totalExpenses' => $totalExpenses,
                    'balance' => $balance
                ],
                'expensesByCategory' => $expensesByCategory,
                'incomeByCategory' => $incomeByCategory,
                'monthlyData' => $monthlyData,
                'budgets' => $budgets,
                'recentTransactions' => $recentTransactions,
                'spendingByPaymentMethod' => $spendingByPaymentMethod
            ]
        ]);
    }

    // ==================== EXPORTS ====================

    public function exportExcel(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        $query = Transaction::with('category')
            ->where('customer_id', $customer->id);

        // Apply filters
        if ($request->filled('type') && $request->type !== 'all') {
            $query->where('type', $request->type);
        }

        if ($request->filled('date_filter')) {
            $query->whereRaw('DATE_FORMAT(transaction_date, "%Y-%m") = ?', [$request->date_filter]);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('payment_method')) {
            $query->where('payment_method', $request->payment_method);
        }

        if ($request->filled('start_date')) {
            $query->where('transaction_date', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->where('transaction_date', '<=', $request->end_date);
        }

        $transactions = $query->orderBy('transaction_date', 'desc')->get();

        return Excel::download(
            new TransactionsExport($transactions),
            'transactions_' . date('Y-m-d') . '.xlsx'
        );
    }

    public function exportPdf(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        $query = Transaction::with('category')
            ->where('customer_id', $customer->id);

        // Apply filters
        if ($request->filled('type') && $request->type !== 'all') {
            $query->where('type', $request->type);
        }

        if ($request->filled('date_filter')) {
            $query->whereRaw('DATE_FORMAT(transaction_date, "%Y-%m") = ?', [$request->date_filter]);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('payment_method')) {
            $query->where('payment_method', $request->payment_method);
        }

        if ($request->filled('start_date')) {
            $query->where('transaction_date', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->where('transaction_date', '<=', $request->end_date);
        }

        $transactions = $query->orderBy('transaction_date', 'desc')->get();

        // Calculate summary
        $totalIncome = $transactions->where('type', 'income')->sum('amount');
        $totalExpenses = $transactions->where('type', 'expense')->sum('amount');
        $balance = $totalIncome - $totalExpenses;

        $pdf = Pdf::loadView('pdf.transactions', [
            'transactions' => $transactions,
            'customer' => $customer,
            'totalIncome' => $totalIncome,
            'totalExpenses' => $totalExpenses,
            'balance' => $balance,
            'generatedDate' => date('F d, Y')
        ]);

        return $pdf->download('transactions_' . date('Y-m-d') . '.pdf');
    }
}
