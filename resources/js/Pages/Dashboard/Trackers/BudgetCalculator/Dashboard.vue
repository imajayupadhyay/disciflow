<template>
  <Head title="Dashboard - Budget Calculator" />

  <div class="min-h-screen bg-white dark:bg-gray-900 transition-colors duration-200">
    <Header />
    <Sidebar />

    <main :class="['pt-16 transition-all duration-300', sidebarCollapsed ? 'md:pl-16' : 'md:pl-64']">
      <div class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
          <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Budget Overview</h1>
            <p class="text-gray-600 dark:text-gray-400">Your complete financial snapshot at a glance</p>
          </div>
          <div class="mt-4 md:mt-0">
            <button
              @click="showCustomizeModal = true"
              class="px-5 py-2.5 bg-gradient-to-r from-purple-600 to-indigo-600 dark:from-purple-500 dark:to-indigo-500 text-white font-semibold rounded-lg hover:shadow-lg hover:shadow-purple-500/30 transition-all duration-200 flex items-center space-x-2"
            >
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
              </svg>
              <span>Customize Dashboard</span>
            </button>
          </div>
        </div>

        <!-- Customize Dashboard Modal -->
        <div
          v-if="showCustomizeModal"
          class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4"
          @click.self="showCustomizeModal = false"
        >
          <div class="bg-white dark:bg-zinc-800 rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-hidden">
            <!-- Modal Header -->
            <div class="p-6 border-b border-zinc-200 dark:border-zinc-700">
              <div class="flex items-center justify-between">
                <div>
                  <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Customize Dashboard</h3>
                  <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Choose which widgets to display on your dashboard</p>
                </div>
                <button
                  @click="showCustomizeModal = false"
                  class="p-2 hover:bg-zinc-100 dark:hover:bg-zinc-700 rounded-lg transition-colors"
                >
                  <svg class="w-6 h-6 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                  </svg>
                </button>
              </div>
            </div>

            <!-- Modal Body -->
            <div class="p-6 overflow-y-auto max-h-[calc(90vh-180px)]">
              <div class="space-y-4">
                <!-- Widget Toggle Item -->
                <div
                  v-for="(widget, key) in widgetConfig"
                  :key="key"
                  class="flex items-center justify-between p-4 bg-zinc-50 dark:bg-zinc-900 rounded-xl border border-zinc-200 dark:border-zinc-700 hover:border-purple-300 dark:hover:border-purple-600 transition-all"
                >
                  <div class="flex items-center space-x-4">
                    <div
                      :class="[
                        'w-10 h-10 rounded-lg flex items-center justify-center',
                        widgetVisibility[key] ? 'bg-purple-500' : 'bg-gray-400'
                      ]"
                    >
                      <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" v-html="widget.icon"></svg>
                    </div>
                    <div>
                      <p class="font-semibold text-gray-900 dark:text-white">{{ widget.label }}</p>
                      <p class="text-sm text-gray-600 dark:text-gray-400">{{ widget.description }}</p>
                    </div>
                  </div>
                  <label class="relative inline-flex items-center cursor-pointer">
                    <input
                      type="checkbox"
                      v-model="widgetVisibility[key]"
                      @change="saveWidgetPreferences"
                      class="sr-only peer"
                    />
                    <div class="w-14 h-7 bg-gray-200 dark:bg-gray-700 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 dark:peer-focus:ring-purple-800 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-purple-600"></div>
                  </label>
                </div>
              </div>
            </div>

            <!-- Modal Footer -->
            <div class="p-6 border-t border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-900/50">
              <div class="flex items-center justify-between">
                <button
                  @click="resetToDefault"
                  class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-white dark:hover:bg-zinc-800 rounded-lg border border-zinc-300 dark:border-zinc-600 transition-colors"
                >
                  Reset to Default
                </button>
                <button
                  @click="showCustomizeModal = false"
                  class="px-6 py-2 bg-gradient-to-r from-purple-600 to-indigo-600 dark:from-purple-500 dark:to-indigo-500 text-white font-semibold rounded-lg hover:shadow-lg transition-all"
                >
                  Done
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Summary Cards -->
        <div v-if="widgetVisibility.summaryCards" class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
          <!-- Total Expenses -->
          <div class="bg-gradient-to-br from-red-50 to-rose-50 dark:from-red-900/20 dark:to-rose-900/20 rounded-xl p-6 border border-red-200 dark:border-red-800">
            <div class="flex items-center justify-between mb-2">
              <span class="text-sm font-medium text-red-700 dark:text-red-400">Total Expenses</span>
              <div class="w-10 h-10 bg-red-500 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                </svg>
              </div>
            </div>
            <p class="text-3xl font-bold text-red-700 dark:text-red-400">${{ formatNumber(dashboardData.summary.totalExpenses) }}</p>
            <p class="text-xs text-red-600 dark:text-red-500 mt-2">Last 6 months</p>
          </div>

          <!-- Total Income -->
          <div class="bg-gradient-to-br from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 rounded-xl p-6 border border-green-200 dark:border-green-800">
            <div class="flex items-center justify-between mb-2">
              <span class="text-sm font-medium text-green-700 dark:text-green-400">Total Income</span>
              <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                </svg>
              </div>
            </div>
            <p class="text-3xl font-bold text-green-700 dark:text-green-400">${{ formatNumber(dashboardData.summary.totalIncome) }}</p>
            <p class="text-xs text-green-600 dark:text-green-500 mt-2">Last 6 months</p>
          </div>

          <!-- Net Balance -->
          <div class="bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-xl p-6 border border-blue-200 dark:border-blue-800">
            <div class="flex items-center justify-between mb-2">
              <span class="text-sm font-medium text-blue-700 dark:text-blue-400">Net Balance</span>
              <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
              </div>
            </div>
            <p class="text-3xl font-bold text-blue-700 dark:text-blue-400">${{ formatNumber(dashboardData.summary.balance) }}</p>
            <p class="text-xs text-blue-600 dark:text-blue-500 mt-2">Income - Expenses</p>
          </div>
        </div>

        <!-- Charts Row 1 -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
          <!-- Income vs Expenses Chart -->
          <div v-if="widgetVisibility.incomeVsExpenses" class="bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Income vs Expenses</h3>
            <apexchart
              v-if="monthlyChartOptions"
              type="bar"
              height="300"
              :options="monthlyChartOptions"
              :series="monthlyChartSeries"
            ></apexchart>
          </div>

          <!-- Expenses by Category (Pie Chart) -->
          <div v-if="widgetVisibility.expensesByCategory" class="bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Expenses by Category</h3>
            <apexchart
              v-if="expensesPieOptions && dashboardData.expensesByCategory.length > 0"
              type="donut"
              height="300"
              :options="expensesPieOptions"
              :series="expensesPieSeries"
            ></apexchart>
            <div v-else class="flex items-center justify-center h-[300px] text-gray-500 dark:text-gray-400">
              No expense data available
            </div>
          </div>
        </div>

        <!-- Charts Row 2 -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
          <!-- Income by Category (Pie Chart) -->
          <div v-if="widgetVisibility.incomeByCategory" class="bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Income by Category</h3>
            <apexchart
              v-if="incomePieOptions && dashboardData.incomeByCategory.length > 0"
              type="donut"
              height="300"
              :options="incomePieOptions"
              :series="incomePieSeries"
            ></apexchart>
            <div v-else class="flex items-center justify-center h-[300px] text-gray-500 dark:text-gray-400">
              No income data available
            </div>
          </div>

          <!-- Spending by Payment Method -->
          <div v-if="widgetVisibility.spendingByPaymentMethod" class="bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Spending by Payment Method</h3>
            <apexchart
              v-if="paymentMethodOptions && dashboardData.spendingByPaymentMethod.length > 0"
              type="pie"
              height="300"
              :options="paymentMethodOptions"
              :series="paymentMethodSeries"
            ></apexchart>
            <div v-else class="flex items-center justify-center h-[300px] text-gray-500 dark:text-gray-400">
              No payment method data available
            </div>
          </div>
        </div>

        <!-- Budget Progress -->
        <div v-if="widgetVisibility.budgetProgress" class="bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 p-6 mb-6">
          <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Budget Progress</h3>
          <div v-if="dashboardData.budgets.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div
              v-for="budget in dashboardData.budgets"
              :key="budget.id"
              class="p-4 bg-zinc-50 dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-700"
            >
              <div class="flex items-center justify-between mb-3">
                <div class="flex items-center space-x-2">
                  <div
                    :style="{ backgroundColor: budget.color }"
                    class="w-8 h-8 rounded-lg flex items-center justify-center text-white text-xs"
                  >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                  </div>
                  <div>
                    <p class="font-semibold text-gray-900 dark:text-white text-sm">{{ budget.category }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 capitalize">{{ budget.period }}</p>
                  </div>
                </div>
              </div>
              <div class="mb-2">
                <div class="flex items-baseline justify-between mb-1">
                  <span class="text-lg font-bold text-gray-900 dark:text-white">${{ formatNumber(budget.spent) }}</span>
                  <span class="text-xs text-gray-500 dark:text-gray-400">of ${{ formatNumber(budget.amount) }}</span>
                </div>
                <div class="w-full bg-zinc-200 dark:bg-zinc-700 rounded-full h-2 overflow-hidden">
                  <div
                    :class="[
                      'h-full rounded-full transition-all duration-500',
                      getProgressColor(budget.percentage)
                    ]"
                    :style="{ width: Math.min(budget.percentage, 100) + '%' }"
                  ></div>
                </div>
              </div>
              <div class="flex items-center justify-between text-xs">
                <span
                  :class="[
                    'font-medium',
                    budget.percentage > 100
                      ? 'text-red-600 dark:text-red-400'
                      : budget.percentage > 80
                      ? 'text-orange-600 dark:text-orange-400'
                      : 'text-green-600 dark:text-green-400'
                  ]"
                >
                  {{ budget.percentage.toFixed(0) }}% Used
                </span>
                <span class="text-gray-500 dark:text-gray-400">
                  ${{ formatNumber(budget.remaining) }} left
                </span>
              </div>
            </div>
          </div>
          <div v-else class="text-center py-8 text-gray-500 dark:text-gray-400">
            No active budgets found. Set up budgets to track your spending.
          </div>
        </div>

        <!-- Recent Transactions -->
        <div v-if="widgetVisibility.recentTransactions" class="bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 p-6">
          <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Recent Transactions</h3>
            <a
              href="/trackers/budget-calculator/transactions"
              class="text-sm text-amber-600 dark:text-amber-400 hover:underline"
            >
              View All
            </a>
          </div>
          <div class="overflow-x-auto">
            <table class="w-full">
              <thead class="bg-zinc-50 dark:bg-zinc-900">
                <tr>
                  <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Date</th>
                  <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Category</th>
                  <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Description</th>
                  <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Amount</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                <tr
                  v-for="transaction in dashboardData.recentTransactions"
                  :key="transaction.id"
                  class="hover:bg-zinc-50 dark:hover:bg-zinc-900/50"
                >
                  <td class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                    {{ formatDate(transaction.transaction_date) }}
                  </td>
                  <td class="px-4 py-3">
                    <div class="flex items-center space-x-2">
                      <div
                        :style="{ backgroundColor: transaction.category.color }"
                        class="w-6 h-6 rounded flex items-center justify-center text-white"
                      >
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                      </div>
                      <span class="text-sm text-gray-900 dark:text-white">{{ transaction.category.name }}</span>
                    </div>
                  </td>
                  <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-400">
                    {{ transaction.description || 'No description' }}
                  </td>
                  <td class="px-4 py-3 text-right">
                    <span
                      :class="[
                        'text-sm font-semibold',
                        transaction.type === 'income'
                          ? 'text-green-600 dark:text-green-400'
                          : 'text-red-600 dark:text-red-400'
                      ]"
                    >
                      {{ transaction.type === 'income' ? '+' : '-' }}${{ formatNumber(transaction.amount) }}
                    </span>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import { Head } from '@inertiajs/vue3';
import Header from '@/Components/Layout/Header.vue';
import Sidebar from './Components/Sidebar.vue';
import { useSidebar } from '@/composables/useSidebar';
import axios from 'axios';
import VueApexCharts from 'vue3-apexcharts';

const apexchart = VueApexCharts;

const { isCollapsed: sidebarCollapsed } = useSidebar();

// Customize Dashboard Modal State
const showCustomizeModal = ref(false);

// Widget Visibility State
const widgetVisibility = ref({
  summaryCards: true,
  incomeVsExpenses: true,
  expensesByCategory: true,
  incomeByCategory: true,
  spendingByPaymentMethod: true,
  budgetProgress: true,
  recentTransactions: true
});

// Widget Configuration for Modal
const widgetConfig = {
  summaryCards: {
    label: 'Summary Cards',
    description: 'Total Expenses, Income, and Net Balance',
    icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>'
  },
  incomeVsExpenses: {
    label: 'Income vs Expenses Chart',
    description: 'Monthly comparison bar chart',
    icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>'
  },
  expensesByCategory: {
    label: 'Expenses by Category',
    description: 'Donut chart showing expense breakdown',
    icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>'
  },
  incomeByCategory: {
    label: 'Income by Category',
    description: 'Donut chart showing income breakdown',
    icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>'
  },
  spendingByPaymentMethod: {
    label: 'Spending by Payment Method',
    description: 'Pie chart of payment method usage',
    icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>'
  },
  budgetProgress: {
    label: 'Budget Progress',
    description: 'Track spending against budgets',
    icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>'
  },
  recentTransactions: {
    label: 'Recent Transactions',
    description: 'Latest transaction history',
    icon: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>'
  }
};

// Load Widget Preferences from localStorage
const loadWidgetPreferences = () => {
  try {
    const savedPreferences = localStorage.getItem('budgetDashboardWidgets');
    if (savedPreferences) {
      widgetVisibility.value = JSON.parse(savedPreferences);
    }
  } catch (error) {
    console.error('Error loading widget preferences:', error);
  }
};

// Save Widget Preferences to localStorage
const saveWidgetPreferences = () => {
  try {
    localStorage.setItem('budgetDashboardWidgets', JSON.stringify(widgetVisibility.value));
  } catch (error) {
    console.error('Error saving widget preferences:', error);
  }
};

// Reset to Default Widget Visibility
const resetToDefault = () => {
  widgetVisibility.value = {
    summaryCards: true,
    incomeVsExpenses: true,
    expensesByCategory: true,
    incomeByCategory: true,
    spendingByPaymentMethod: true,
    budgetProgress: true,
    recentTransactions: true
  };
  saveWidgetPreferences();
};

const dashboardData = ref({
  summary: {
    totalIncome: 0,
    totalExpenses: 0,
    balance: 0
  },
  expensesByCategory: [],
  incomeByCategory: [],
  monthlyData: [],
  budgets: [],
  recentTransactions: [],
  spendingByPaymentMethod: []
});

const formatNumber = (num) => {
  return parseFloat(num || 0).toFixed(2);
};

const formatDate = (date) => {
  if (!date) return 'N/A';
  return new Date(date).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
};

const getProgressColor = (percentage) => {
  if (percentage > 100) return 'bg-red-500';
  if (percentage > 80) return 'bg-orange-500';
  return 'bg-green-500';
};

// Monthly Chart (Income vs Expenses)
const monthlyChartSeries = computed(() => {
  return [
    {
      name: 'Income',
      data: dashboardData.value.monthlyData.map(d => d.income)
    },
    {
      name: 'Expenses',
      data: dashboardData.value.monthlyData.map(d => d.expense)
    }
  ];
});

const monthlyChartOptions = computed(() => {
  return {
    chart: {
      type: 'bar',
      toolbar: { show: false },
      background: 'transparent'
    },
    colors: ['#10b981', '#ef4444'],
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: '55%',
        borderRadius: 4
      }
    },
    dataLabels: { enabled: false },
    stroke: {
      show: true,
      width: 2,
      colors: ['transparent']
    },
    xaxis: {
      categories: dashboardData.value.monthlyData.map(d => d.month),
      labels: {
        style: {
          colors: '#9ca3af'
        }
      }
    },
    yaxis: {
      labels: {
        style: {
          colors: '#9ca3af'
        },
        formatter: (val) => '$' + val.toFixed(0)
      }
    },
    fill: { opacity: 1 },
    tooltip: {
      theme: 'dark',
      y: {
        formatter: (val) => '$' + val.toFixed(2)
      }
    },
    legend: {
      labels: {
        colors: '#9ca3af'
      }
    },
    grid: {
      borderColor: '#374151'
    }
  };
});

// Expenses Pie Chart
const expensesPieSeries = computed(() => {
  return dashboardData.value.expensesByCategory.map(item => item.amount);
});

const expensesPieOptions = computed(() => {
  return {
    chart: {
      type: 'donut',
      background: 'transparent'
    },
    labels: dashboardData.value.expensesByCategory.map(item => item.category),
    colors: dashboardData.value.expensesByCategory.map(item => item.color),
    legend: {
      position: 'bottom',
      labels: {
        colors: '#9ca3af'
      }
    },
    tooltip: {
      theme: 'dark',
      y: {
        formatter: (val) => '$' + val.toFixed(2)
      }
    },
    plotOptions: {
      pie: {
        donut: {
          labels: {
            show: true,
            total: {
              show: true,
              label: 'Total',
              color: '#9ca3af',
              formatter: () => '$' + dashboardData.value.summary.totalExpenses.toFixed(2)
            }
          }
        }
      }
    }
  };
});

// Income Pie Chart
const incomePieSeries = computed(() => {
  return dashboardData.value.incomeByCategory.map(item => item.amount);
});

const incomePieOptions = computed(() => {
  return {
    chart: {
      type: 'donut',
      background: 'transparent'
    },
    labels: dashboardData.value.incomeByCategory.map(item => item.category),
    colors: dashboardData.value.incomeByCategory.map(item => item.color),
    legend: {
      position: 'bottom',
      labels: {
        colors: '#9ca3af'
      }
    },
    tooltip: {
      theme: 'dark',
      y: {
        formatter: (val) => '$' + val.toFixed(2)
      }
    },
    plotOptions: {
      pie: {
        donut: {
          labels: {
            show: true,
            total: {
              show: true,
              label: 'Total',
              color: '#9ca3af',
              formatter: () => '$' + dashboardData.value.summary.totalIncome.toFixed(2)
            }
          }
        }
      }
    }
  };
});

// Payment Method Chart
const paymentMethodSeries = computed(() => {
  return dashboardData.value.spendingByPaymentMethod.map(item => item.amount);
});

const paymentMethodOptions = computed(() => {
  return {
    chart: {
      type: 'pie',
      background: 'transparent'
    },
    labels: dashboardData.value.spendingByPaymentMethod.map(item => item.method),
    colors: ['#3b82f6', '#8b5cf6', '#ec4899', '#f59e0b', '#10b981'],
    legend: {
      position: 'bottom',
      labels: {
        colors: '#9ca3af'
      }
    },
    tooltip: {
      theme: 'dark',
      y: {
        formatter: (val) => '$' + val.toFixed(2)
      }
    }
  };
});

const fetchDashboardData = async () => {
  try {
    const response = await axios.get('/api/budget/dashboard');
    if (response.data.success) {
      dashboardData.value = response.data.data;
    }
  } catch (error) {
    console.error('Error fetching dashboard data:', error);
  }
};

onMounted(() => {
  loadWidgetPreferences();
  fetchDashboardData();
});
</script>
