<template>
  <Head title="Dashboard - Budget Calculator" />

  <div class="min-h-screen bg-white dark:bg-gray-900 transition-colors duration-200">
    <Header />
    <Sidebar />

    <main :class="['pt-16 transition-all duration-300', sidebarCollapsed ? 'md:pl-16' : 'md:pl-64']">
      <div class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Page Header -->
        <div class="mb-8">
          <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Budget Overview</h1>
          <p class="text-gray-600 dark:text-gray-400">Your complete financial snapshot at a glance</p>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
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
          <div class="bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 p-6">
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
          <div class="bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 p-6">
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
          <div class="bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 p-6">
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
          <div class="bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 p-6">
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
        <div class="bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 p-6 mb-6">
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
        <div class="bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 p-6">
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
  fetchDashboardData();
});
</script>
