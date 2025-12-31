<template>
  <Head title="Dashboard - Budget Tracker" />

  <div class="min-h-screen bg-white dark:bg-gray-900 transition-colors duration-200">
    <Header />
    <Sidebar />

    <main :class="['pt-16 transition-all duration-300', sidebarCollapsed ? 'md:pl-16' : 'md:pl-64']">
      <div class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Page Header -->
        <div class="mb-8">
          <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-2">
            Budget Tracker
          </h1>
          <div class="w-20 h-1 bg-gradient-to-r from-amber-600 to-amber-800 dark:from-amber-500 dark:to-amber-700 rounded-full"></div>
        </div>

        <!-- Welcome Message -->
        <div class="mb-8 bg-gradient-to-r from-amber-50 to-orange-50 dark:from-amber-900/20 dark:to-orange-900/20 rounded-xl p-6 border border-amber-200 dark:border-amber-800">
          <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
            Welcome back, {{ user?.name || 'Customer' }}! 👋
          </h2>
          <p class="text-gray-600 dark:text-gray-400">
            Here's your financial overview at a glance
          </p>
        </div>

        <!-- Metrics Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
          <!-- Total Income -->
          <div class="bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 p-6 hover:shadow-lg hover:shadow-green-500/10 transition-all duration-200">
            <div class="flex items-center justify-between mb-4">
              <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-lg flex items-center justify-center shadow-lg shadow-green-500/30">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                </svg>
              </div>
            </div>
            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Total Income</h3>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">${{ formatNumber(metrics.totalIncome) }}</p>
            <p class="text-xs text-green-600 dark:text-green-400 mt-2">This month</p>
          </div>

          <!-- Total Expenses -->
          <div class="bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 p-6 hover:shadow-lg hover:shadow-red-500/10 transition-all duration-200">
            <div class="flex items-center justify-between mb-4">
              <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-rose-600 rounded-lg flex items-center justify-center shadow-lg shadow-red-500/30">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                </svg>
              </div>
            </div>
            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Total Expenses</h3>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">${{ formatNumber(metrics.totalExpenses) }}</p>
            <p class="text-xs text-red-600 dark:text-red-400 mt-2">This month</p>
          </div>

          <!-- Net Balance -->
          <div class="bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 p-6 hover:shadow-lg hover:shadow-blue-500/10 transition-all duration-200">
            <div class="flex items-center justify-between mb-4">
              <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center shadow-lg shadow-blue-500/30">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
              </div>
            </div>
            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Net Balance</h3>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">${{ formatNumber(metrics.balance) }}</p>
            <p :class="['text-xs mt-2', metrics.balance >= 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400']">
              {{ metrics.balance >= 0 ? 'Positive' : 'Negative' }}
            </p>
          </div>

          <!-- Categories -->
          <div class="bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 p-6 hover:shadow-lg hover:shadow-amber-500/10 transition-all duration-200">
            <div class="flex items-center justify-between mb-4">
              <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-orange-600 rounded-lg flex items-center justify-center shadow-lg shadow-amber-500/30">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
              </div>
            </div>
            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Categories</h3>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ metrics.categoriesCount }}</p>
            <p class="text-xs text-gray-600 dark:text-gray-400 mt-2">Active categories</p>
          </div>
        </div>

        <!-- Additional Metrics Row -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
          <!-- Active Budgets -->
          <div class="bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 p-6">
            <div class="flex items-center justify-between mb-3">
              <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Active Budgets</h3>
              <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                </svg>
              </div>
            </div>
            <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ metrics.budgetsCount }}</p>
          </div>

          <!-- Transactions This Month -->
          <div class="bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 p-6">
            <div class="flex items-center justify-between mb-3">
              <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Transactions</h3>
              <div class="w-10 h-10 bg-cyan-100 dark:bg-cyan-900/30 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-cyan-600 dark:text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
              </div>
            </div>
            <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ metrics.transactionsCount }}</p>
          </div>

          <!-- Savings Rate -->
          <div class="bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 p-6">
            <div class="flex items-center justify-between mb-3">
              <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Savings Rate</h3>
              <div class="w-10 h-10 bg-teal-100 dark:bg-teal-900/30 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                </svg>
              </div>
            </div>
            <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ metrics.savingsRate }}%</p>
          </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 p-6">
          <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Quick Actions</h3>
          <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a
              href="/trackers/budget-calculator/transactions"
              class="flex flex-col items-center justify-center p-4 rounded-lg border-2 border-dashed border-zinc-300 dark:border-zinc-600 hover:border-amber-500 dark:hover:border-amber-500 hover:bg-amber-50 dark:hover:bg-amber-900/10 transition-all group"
            >
              <svg class="w-8 h-8 text-zinc-400 group-hover:text-amber-600 dark:group-hover:text-amber-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
              </svg>
              <span class="text-sm font-medium text-zinc-600 dark:text-zinc-400 group-hover:text-amber-600 dark:group-hover:text-amber-400">Add Transaction</span>
            </a>

            <a
              href="/trackers/budget-calculator/categories"
              class="flex flex-col items-center justify-center p-4 rounded-lg border-2 border-dashed border-zinc-300 dark:border-zinc-600 hover:border-amber-500 dark:hover:border-amber-500 hover:bg-amber-50 dark:hover:bg-amber-900/10 transition-all group"
            >
              <svg class="w-8 h-8 text-zinc-400 group-hover:text-amber-600 dark:group-hover:text-amber-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
              </svg>
              <span class="text-sm font-medium text-zinc-600 dark:text-zinc-400 group-hover:text-amber-600 dark:group-hover:text-amber-400">Manage Categories</span>
            </a>

            <a
              href="/trackers/budget-calculator/budget"
              class="flex flex-col items-center justify-center p-4 rounded-lg border-2 border-dashed border-zinc-300 dark:border-zinc-600 hover:border-amber-500 dark:hover:border-amber-500 hover:bg-amber-50 dark:hover:bg-amber-900/10 transition-all group"
            >
              <svg class="w-8 h-8 text-zinc-400 group-hover:text-amber-600 dark:group-hover:text-amber-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
              <span class="text-sm font-medium text-zinc-600 dark:text-zinc-400 group-hover:text-amber-600 dark:group-hover:text-amber-400">Set Budget</span>
            </a>

            <a
              href="/profile"
              class="flex flex-col items-center justify-center p-4 rounded-lg border-2 border-dashed border-zinc-300 dark:border-zinc-600 hover:border-amber-500 dark:hover:border-amber-500 hover:bg-amber-50 dark:hover:bg-amber-900/10 transition-all group"
            >
              <svg class="w-8 h-8 text-zinc-400 group-hover:text-amber-600 dark:group-hover:text-amber-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
              </svg>
              <span class="text-sm font-medium text-zinc-600 dark:text-zinc-400 group-hover:text-amber-600 dark:group-hover:text-amber-400">View Profile</span>
            </a>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { Head } from '@inertiajs/vue3';
import Header from '@/Components/Layout/Header.vue';
import Sidebar from './Components/Sidebar.vue';
import { useAuth } from '@/composables/useAuth';
import { useSidebar } from '@/composables/useSidebar';
import axios from 'axios';

const { user } = useAuth();
const { isCollapsed: sidebarCollapsed } = useSidebar();

const metrics = ref({
  totalIncome: 0,
  totalExpenses: 0,
  balance: 0,
  categoriesCount: 0,
  budgetsCount: 0,
  transactionsCount: 0,
  savingsRate: 0
});

const formatNumber = (num) => {
  return parseFloat(num || 0).toFixed(2);
};

const fetchMetrics = async () => {
  try {
    // Fetch categories
    const categoriesResponse = await axios.get('/api/budget/categories');
    const categories = categoriesResponse.data.categories || [];
    metrics.value.categoriesCount = categories.length;

    // Fetch budgets
    const budgetsResponse = await axios.get('/api/budget/budgets');
    const budgets = budgetsResponse.data.budgets || [];
    metrics.value.budgetsCount = budgets.length;

    // Fetch transactions
    const transactionsResponse = await axios.get('/api/budget/transactions');
    const transactions = transactionsResponse.data.transactions || [];

    // Calculate current month transactions
    const now = new Date();
    const currentMonth = `${now.getFullYear()}-${String(now.getMonth() + 1).padStart(2, '0')}`;

    const currentMonthTransactions = transactions.filter(t => {
      return t.transaction_date.startsWith(currentMonth);
    });

    metrics.value.transactionsCount = currentMonthTransactions.length;

    // Calculate totals for current month
    const totalIncome = currentMonthTransactions
      .filter(t => t.type === 'income')
      .reduce((sum, t) => sum + parseFloat(t.amount), 0);

    const totalExpenses = currentMonthTransactions
      .filter(t => t.type === 'expense')
      .reduce((sum, t) => sum + parseFloat(t.amount), 0);

    metrics.value.totalIncome = totalIncome;
    metrics.value.totalExpenses = totalExpenses;
    metrics.value.balance = totalIncome - totalExpenses;

    // Calculate savings rate
    if (totalIncome > 0) {
      metrics.value.savingsRate = ((totalIncome - totalExpenses) / totalIncome * 100).toFixed(1);
    } else {
      metrics.value.savingsRate = 0;
    }
  } catch (error) {
    console.error('Error fetching metrics:', error);
  }
};

onMounted(() => {
  fetchMetrics();
});
</script>
