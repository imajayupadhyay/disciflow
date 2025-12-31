<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\BudgetCategory;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
