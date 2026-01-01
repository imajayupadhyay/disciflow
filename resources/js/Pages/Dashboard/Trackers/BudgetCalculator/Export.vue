<template>
  <Head title="Export Reports - Budget Calculator" />

  <div class="min-h-screen bg-white dark:bg-gray-900 transition-colors duration-200">
    <Header />
    <Sidebar />

    <main :class="['pt-16 transition-all duration-300', sidebarCollapsed ? 'md:pl-16' : 'md:pl-64']">
      <div class="container mx-auto px-4 py-8 max-w-5xl">
        <!-- Page Header -->
        <div class="mb-8">
          <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Export Reports</h1>
          <p class="text-gray-600 dark:text-gray-400">Generate and download transaction reports in Excel or PDF format</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
          <!-- Filters Card -->
          <div class="bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 p-6 h-fit">
            <div class="flex items-center space-x-2 mb-6">
              <svg class="w-6 h-6 text-amber-600 dark:text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
              </svg>
              <h2 class="text-xl font-bold text-gray-900 dark:text-white">Filter Options</h2>
            </div>

            <div class="space-y-5">
              <!-- Type Filter -->
              <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                  Transaction Type
                </label>
                <div class="inline-flex w-full bg-zinc-100 dark:bg-zinc-900 rounded-lg p-1">
                  <button
                    @click="activeType = 'all'"
                    :class="[
                      'flex-1 px-4 py-2.5 rounded-md text-sm font-medium transition-all',
                      activeType === 'all'
                        ? 'bg-white dark:bg-zinc-800 text-amber-600 dark:text-amber-400 shadow-md'
                        : 'text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-zinc-200'
                    ]"
                  >
                    All
                  </button>
                  <button
                    @click="activeType = 'income'"
                    :class="[
                      'flex-1 px-4 py-2.5 rounded-md text-sm font-medium transition-all',
                      activeType === 'income'
                        ? 'bg-white dark:bg-zinc-800 text-green-600 dark:text-green-400 shadow-md'
                        : 'text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-zinc-200'
                    ]"
                  >
                    Income
                  </button>
                  <button
                    @click="activeType = 'expense'"
                    :class="[
                      'flex-1 px-4 py-2.5 rounded-md text-sm font-medium transition-all',
                      activeType === 'expense'
                        ? 'bg-white dark:bg-zinc-800 text-red-600 dark:text-red-400 shadow-md'
                        : 'text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-zinc-200'
                    ]"
                  >
                    Expenses
                  </button>
                </div>
              </div>

              <!-- Category Filter -->
              <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                  Category
                </label>
                <select
                  v-model="categoryFilter"
                  class="w-full px-4 py-2.5 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 transition-all"
                >
                  <option value="">All Categories</option>
                  <option
                    v-for="category in categories"
                    :key="category.id"
                    :value="category.id"
                  >
                    {{ category.name }}
                  </option>
                </select>
              </div>

              <!-- Payment Method Filter -->
              <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                  Payment Method
                </label>
                <select
                  v-model="paymentMethodFilter"
                  class="w-full px-4 py-2.5 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 transition-all"
                >
                  <option value="">All Methods</option>
                  <option
                    v-for="method in paymentMethods"
                    :key="method"
                    :value="method"
                  >
                    {{ method }}
                  </option>
                </select>
              </div>

              <!-- Date Range -->
              <div class="grid grid-cols-2 gap-4">
                <div>
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Start Date
                  </label>
                  <input
                    v-model="startDate"
                    type="date"
                    class="w-full px-4 py-2.5 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 transition-all"
                  />
                </div>
                <div>
                  <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    End Date
                  </label>
                  <input
                    v-model="endDate"
                    type="date"
                    class="w-full px-4 py-2.5 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 transition-all"
                  />
                </div>
              </div>

              <!-- Clear Filters Button -->
              <button
                @click="clearFilters"
                class="w-full px-4 py-2.5 text-sm bg-zinc-100 dark:bg-zinc-900 text-gray-700 dark:text-gray-300 hover:bg-zinc-200 dark:hover:bg-zinc-800 rounded-lg transition-colors font-medium border border-zinc-200 dark:border-zinc-700"
              >
                Clear All Filters
              </button>
            </div>
          </div>

          <!-- Export Options Card -->
          <div class="bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 p-6 h-fit">
            <div class="flex items-center space-x-2 mb-6">
              <svg class="w-6 h-6 text-amber-600 dark:text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
              </svg>
              <h2 class="text-xl font-bold text-gray-900 dark:text-white">Export Format</h2>
            </div>

            <div class="space-y-4">
              <!-- Export Summary -->
              <div class="bg-zinc-50 dark:bg-zinc-900 rounded-lg p-4 border border-zinc-200 dark:border-zinc-700">
                <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Report Summary</h3>
                <div class="space-y-2 text-sm">
                  <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">Type:</span>
                    <span class="font-medium text-gray-900 dark:text-white capitalize">{{ activeType }}</span>
                  </div>
                  <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">Category:</span>
                    <span class="font-medium text-gray-900 dark:text-white">{{ getCategoryName() }}</span>
                  </div>
                  <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">Payment:</span>
                    <span class="font-medium text-gray-900 dark:text-white">{{ paymentMethodFilter || 'All' }}</span>
                  </div>
                  <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-400">Date Range:</span>
                    <span class="font-medium text-gray-900 dark:text-white">
                      {{ startDate || 'Any' }} - {{ endDate || 'Any' }}
                    </span>
                  </div>
                </div>
              </div>

              <!-- Excel Export -->
              <button
                @click="exportToExcel"
                class="w-full px-6 py-4 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-all flex items-center justify-center space-x-3 font-semibold shadow-lg hover:shadow-xl group"
              >
                <svg class="w-6 h-6 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <span>Export to Excel</span>
              </button>

              <!-- PDF Export -->
              <button
                @click="exportToPdf"
                class="w-full px-6 py-4 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-all flex items-center justify-center space-x-3 font-semibold shadow-lg hover:shadow-xl group"
              >
                <svg class="w-6 h-6 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                </svg>
                <span>Export to PDF</span>
              </button>

              <!-- Info Text -->
              <div class="flex items-start space-x-2 p-3 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg">
                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-sm text-blue-800 dark:text-blue-300">
                  Reports will be generated based on the filters you've selected above. Downloads will start automatically.
                </p>
              </div>
            </div>
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

const { isCollapsed: sidebarCollapsed } = useSidebar();

const activeType = ref('all');
const categoryFilter = ref('');
const paymentMethodFilter = ref('');
const startDate = ref('');
const endDate = ref('');

const categories = ref([]);
const transactions = ref([]);

const paymentMethods = computed(() => {
  const methods = transactions.value
    .map(t => t.payment_method)
    .filter(method => method && method.trim() !== '');
  return [...new Set(methods)].sort();
});

const getCategoryName = () => {
  if (!categoryFilter.value) return 'All';
  const category = categories.value.find(cat => cat.id === categoryFilter.value);
  return category ? category.name : 'All';
};

const fetchCategories = async () => {
  try {
    const response = await axios.get('/api/budget/categories');
    categories.value = response.data.categories || [];
  } catch (error) {
    console.error('Error fetching categories:', error);
  }
};

const fetchTransactions = async () => {
  try {
    const response = await axios.get('/api/budget/transactions');
    transactions.value = response.data.transactions || [];
  } catch (error) {
    console.error('Error fetching transactions:', error);
  }
};

const clearFilters = () => {
  activeType.value = 'all';
  categoryFilter.value = '';
  paymentMethodFilter.value = '';
  startDate.value = '';
  endDate.value = '';
};

const exportToExcel = () => {
  const params = new URLSearchParams();

  if (activeType.value !== 'all') {
    params.append('type', activeType.value);
  }

  if (categoryFilter.value) {
    params.append('category_id', categoryFilter.value);
  }

  if (paymentMethodFilter.value) {
    params.append('payment_method', paymentMethodFilter.value);
  }

  if (startDate.value) {
    params.append('start_date', startDate.value);
  }

  if (endDate.value) {
    params.append('end_date', endDate.value);
  }

  window.location.href = `/api/budget/transactions/export/excel?${params.toString()}`;
};

const exportToPdf = () => {
  const params = new URLSearchParams();

  if (activeType.value !== 'all') {
    params.append('type', activeType.value);
  }

  if (categoryFilter.value) {
    params.append('category_id', categoryFilter.value);
  }

  if (paymentMethodFilter.value) {
    params.append('payment_method', paymentMethodFilter.value);
  }

  if (startDate.value) {
    params.append('start_date', startDate.value);
  }

  if (endDate.value) {
    params.append('end_date', endDate.value);
  }

  window.location.href = `/api/budget/transactions/export/pdf?${params.toString()}`;
};

onMounted(() => {
  fetchCategories();
  fetchTransactions();
});
</script>
