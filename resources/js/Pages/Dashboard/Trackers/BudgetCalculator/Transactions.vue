<template>
  <Head title="Transactions - Budget Calculator" />

  <div class="min-h-screen bg-white dark:bg-gray-900 transition-colors duration-200">
    <Header />
    <Sidebar />

    <main :class="['pt-16 transition-all duration-300', sidebarCollapsed ? 'md:pl-16' : 'md:pl-64']">
      <div class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
          <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Transactions</h1>
            <p class="text-gray-600 dark:text-gray-400">Track your income and expenses</p>
          </div>
          <div class="flex items-center space-x-3 mt-4 md:mt-0">
            <button
              @click="openAddModal()"
              class="px-6 py-3 bg-gradient-to-r from-amber-600 to-amber-800 dark:from-amber-500 dark:to-amber-700 text-white font-semibold rounded-lg hover:shadow-lg hover:shadow-amber-500/30 transition-all duration-200 flex items-center space-x-2"
            >
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
              </svg>
              <span>Add Transaction</span>
            </button>
          </div>
        </div>

        <!-- Filters Bar -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 p-4 mb-6">
          <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Date From -->
            <div>
              <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1.5">Date From</label>
              <input
                v-model="startDate"
                type="date"
                class="w-full px-3 py-2 text-sm border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 transition-all"
              />
            </div>

            <!-- Date To -->
            <div>
              <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1.5">Date To</label>
              <input
                v-model="endDate"
                type="date"
                class="w-full px-3 py-2 text-sm border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 transition-all"
              />
            </div>

            <!-- Category Filter -->
            <div>
              <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1.5">Category</label>
              <select
                v-model="categoryFilter"
                class="w-full px-3 py-2 text-sm border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 transition-all"
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
              <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1.5">Payment Method</label>
              <select
                v-model="paymentMethodFilter"
                class="w-full px-3 py-2 text-sm border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 transition-all"
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
          </div>

          <!-- Clear Filters Button -->
          <div v-if="hasActiveFilters" class="mt-3 flex justify-end">
            <button
              @click="clearFilters"
              class="px-4 py-1.5 text-xs bg-zinc-100 dark:bg-zinc-900 text-gray-700 dark:text-gray-300 hover:bg-zinc-200 dark:hover:bg-zinc-800 rounded-lg transition-colors font-medium border border-zinc-200 dark:border-zinc-700"
            >
              Clear Filters
            </button>
          </div>
        </div>

        <!-- Transactions List -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 overflow-hidden">
          <div class="overflow-x-auto">
            <table class="w-full">
              <thead class="bg-zinc-50 dark:bg-zinc-900">
                <tr>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Date</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Category</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Description</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Payment</th>
                  <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Amount</th>
                  <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                <tr
                  v-for="transaction in paginatedTransactions"
                  :key="transaction.id"
                  class="hover:bg-zinc-50 dark:hover:bg-zinc-900/50 transition-colors"
                >
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                    {{ formatDate(transaction.transaction_date) }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center space-x-2">
                      <div
                        :style="{ backgroundColor: transaction.category.color }"
                        class="w-8 h-8 rounded-lg flex items-center justify-center text-white"
                      >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                      </div>
                      <span class="text-sm font-medium text-gray-900 dark:text-white">{{ transaction.category.name }}</span>
                    </div>
                  </td>
                  <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                    {{ transaction.description || 'No description' }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-400">
                    {{ transaction.payment_method || 'N/A' }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-right">
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
                  <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                    <div class="flex items-center justify-end space-x-2">
                      <button
                        @click="editTransaction(transaction)"
                        class="p-2 text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-lg transition-colors"
                      >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                      </button>
                      <button
                        @click="deleteTransaction(transaction.id)"
                        class="p-2 text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors"
                      >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                      </button>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>

            <!-- Empty State -->
            <div
              v-if="paginatedTransactions.length === 0"
              class="flex flex-col items-center justify-center py-16"
            >
              <div class="w-16 h-16 bg-zinc-100 dark:bg-zinc-800 rounded-full flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                </svg>
              </div>
              <p class="text-zinc-500 dark:text-zinc-400 text-lg font-medium mb-2">No transactions found</p>
              <p class="text-zinc-400 dark:text-zinc-500 text-sm mb-4">Add your first transaction to get started</p>
              <button
                @click="openAddModal()"
                class="px-4 py-2 text-amber-600 dark:text-amber-400 hover:bg-amber-50 dark:hover:bg-amber-900/20 rounded-lg transition-colors"
              >
                Add Transaction
              </button>
            </div>
          </div>

          <!-- Pagination -->
          <div v-if="filteredTransactions.length > 0" class="px-6 py-4 border-t border-zinc-200 dark:border-zinc-700">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
              <div class="text-sm text-gray-600 dark:text-gray-400">
                Showing {{ ((currentPage - 1) * perPage) + 1 }} to {{ Math.min(currentPage * perPage, filteredTransactions.length) }} of {{ filteredTransactions.length }} transactions
              </div>
              <div class="flex items-center space-x-2">
                <button
                  @click="currentPage = 1"
                  :disabled="currentPage === 1"
                  class="px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 text-gray-700 dark:text-gray-300 hover:bg-zinc-50 dark:hover:bg-zinc-800 disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
                >
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/>
                  </svg>
                </button>
                <button
                  @click="currentPage--"
                  :disabled="currentPage === 1"
                  class="px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 text-gray-700 dark:text-gray-300 hover:bg-zinc-50 dark:hover:bg-zinc-800 disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
                >
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                  </svg>
                </button>
                <div class="flex items-center space-x-1">
                  <button
                    v-for="page in visiblePages"
                    :key="page"
                    @click="typeof page === 'number' ? currentPage = page : null"
                    :disabled="typeof page !== 'number'"
                    :class="[
                      'px-3 py-2 rounded-lg transition-colors',
                      currentPage === page
                        ? 'bg-amber-600 text-white'
                        : typeof page === 'number'
                          ? 'border border-zinc-300 dark:border-zinc-600 text-gray-700 dark:text-gray-300 hover:bg-zinc-50 dark:hover:bg-zinc-800'
                          : 'text-gray-400 dark:text-gray-600 cursor-default'
                    ]"
                  >
                    {{ page }}
                  </button>
                </div>
                <button
                  @click="currentPage++"
                  :disabled="currentPage === totalPages"
                  class="px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 text-gray-700 dark:text-gray-300 hover:bg-zinc-50 dark:hover:bg-zinc-800 disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
                >
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                  </svg>
                </button>
                <button
                  @click="currentPage = totalPages"
                  :disabled="currentPage === totalPages"
                  class="px-3 py-2 rounded-lg border border-zinc-300 dark:border-zinc-600 text-gray-700 dark:text-gray-300 hover:bg-zinc-50 dark:hover:bg-zinc-800 disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
                >
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"/>
                  </svg>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- Add/Edit Transaction Modal -->
    <div
      v-if="showAddModal"
      class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4"
      @click.self="closeModal"
    >
      <div class="bg-white dark:bg-zinc-800 rounded-2xl max-w-lg w-full p-6 shadow-2xl transform transition-all max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between mb-6">
          <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
            {{ editingTransaction ? 'Edit' : 'Add' }} Transaction
          </h2>
          <button
            @click="closeModal"
            class="p-2 hover:bg-zinc-100 dark:hover:bg-zinc-700 rounded-lg transition-colors"
          >
            <svg class="w-5 h-5 text-zinc-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
          </button>
        </div>

        <form @submit.prevent="saveTransaction" class="space-y-4">
          <!-- Type Switcher -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Transaction Type
            </label>
            <div class="grid grid-cols-2 gap-3">
              <button
                type="button"
                @click="form.type = 'income'"
                :class="[
                  'px-4 py-3 rounded-lg border-2 transition-all font-medium flex items-center justify-center space-x-2',
                  form.type === 'income'
                    ? 'border-green-500 bg-green-50 dark:bg-green-900/20 text-green-600 dark:text-green-400'
                    : 'border-zinc-200 dark:border-zinc-700 text-zinc-600 dark:text-zinc-400 hover:border-green-300'
                ]"
              >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                </svg>
                <span>Income</span>
              </button>
              <button
                type="button"
                @click="form.type = 'expense'"
                :class="[
                  'px-4 py-3 rounded-lg border-2 transition-all font-medium flex items-center justify-center space-x-2',
                  form.type === 'expense'
                    ? 'border-red-500 bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400'
                    : 'border-zinc-200 dark:border-zinc-700 text-zinc-600 dark:text-zinc-400 hover:border-red-300'
                ]"
              >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                </svg>
                <span>Expense</span>
              </button>
            </div>
          </div>

          <!-- Category -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Category
            </label>
            <select
              v-model="form.category_id"
              required
              class="w-full px-4 py-2.5 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
            >
              <option value="">Select a category</option>
              <option
                v-for="category in availableCategories"
                :key="category.id"
                :value="category.id"
              >
                {{ category.name }}
              </option>
            </select>
          </div>

          <!-- Amount -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Amount ($)
            </label>
            <input
              v-model.number="form.amount"
              type="number"
              step="0.01"
              min="0"
              required
              class="w-full px-4 py-2.5 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
              placeholder="100.00"
            />
          </div>

          <!-- Date -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Date
            </label>
            <input
              v-model="form.transaction_date"
              type="date"
              required
              class="w-full px-4 py-2.5 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
            />
          </div>

          <!-- Description -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Description (Optional)
            </label>
            <textarea
              v-model="form.description"
              rows="3"
              class="w-full px-4 py-2.5 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all resize-none"
              placeholder="Add notes about this transaction..."
            ></textarea>
          </div>

          <!-- Payment Method -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Payment Method (Optional)
            </label>
            <input
              v-model="form.payment_method"
              type="text"
              class="w-full px-4 py-2.5 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
              placeholder="Cash, Card, Bank Transfer..."
            />
          </div>

          <!-- Submit Buttons -->
          <div class="flex space-x-3 pt-4">
            <button
              type="button"
              @click="closeModal"
              class="flex-1 px-4 py-2.5 border border-zinc-300 dark:border-zinc-600 text-zinc-700 dark:text-zinc-300 rounded-lg hover:bg-zinc-50 dark:hover:bg-zinc-700 transition-colors font-medium"
            >
              Cancel
            </button>
            <button
              type="submit"
              :disabled="loading"
              class="flex-1 px-4 py-2.5 bg-gradient-to-r from-amber-600 to-amber-800 dark:from-amber-500 dark:to-amber-700 text-white rounded-lg hover:shadow-lg hover:shadow-amber-500/30 transition-all font-medium disabled:opacity-50"
            >
              {{ loading ? 'Saving...' : (editingTransaction ? 'Update' : 'Create') }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, watch } from 'vue';
import { Head } from '@inertiajs/vue3';
import Header from '@/Components/Layout/Header.vue';
import Sidebar from './Components/Sidebar.vue';
import { useSidebar } from '@/composables/useSidebar';
import axios from 'axios';

const { isCollapsed: sidebarCollapsed } = useSidebar();

const showAddModal = ref(false);
const editingTransaction = ref(null);
const loading = ref(false);
const currentPage = ref(1);
const perPage = ref(10);
const startDate = ref('');
const endDate = ref('');
const categoryFilter = ref('');
const paymentMethodFilter = ref('');

const form = ref({
  type: 'expense',
  category_id: '',
  amount: 0,
  transaction_date: new Date().toISOString().split('T')[0],
  description: '',
  payment_method: ''
});

const transactions = ref([]);
const categories = ref([]);

const availableCategories = computed(() => {
  return categories.value.filter(cat => cat.type === form.value.type);
});

const paymentMethods = computed(() => {
  const methods = transactions.value
    .map(t => t.payment_method)
    .filter(method => method && method.trim() !== '');
  return [...new Set(methods)].sort();
});

const filteredTransactions = computed(() => {
  let filtered = transactions.value;

  if (categoryFilter.value) {
    filtered = filtered.filter(t => t.category_id === categoryFilter.value);
  }

  if (paymentMethodFilter.value) {
    filtered = filtered.filter(t => t.payment_method === paymentMethodFilter.value);
  }

  if (startDate.value) {
    filtered = filtered.filter(t => t.transaction_date >= startDate.value);
  }

  if (endDate.value) {
    filtered = filtered.filter(t => t.transaction_date <= endDate.value);
  }

  return filtered.sort((a, b) => new Date(b.transaction_date) - new Date(a.transaction_date));
});

const hasActiveFilters = computed(() => {
  return !!(startDate.value || endDate.value || categoryFilter.value || paymentMethodFilter.value);
});

const totalPages = computed(() => {
  return Math.ceil(filteredTransactions.value.length / perPage.value) || 1;
});

const visiblePages = computed(() => {
  const pages = [];
  const total = totalPages.value;
  const current = currentPage.value;

  if (total <= 7) {
    // Show all pages if total is 7 or less
    for (let i = 1; i <= total; i++) {
      pages.push(i);
    }
  } else {
    // Always show first page
    pages.push(1);

    if (current > 3) {
      pages.push('...');
    }

    // Show pages around current page
    const start = Math.max(2, current - 1);
    const end = Math.min(total - 1, current + 1);

    for (let i = start; i <= end; i++) {
      if (!pages.includes(i)) {
        pages.push(i);
      }
    }

    if (current < total - 2) {
      pages.push('...');
    }

    // Always show last page
    if (!pages.includes(total)) {
      pages.push(total);
    }
  }

  return pages;
});

const paginatedTransactions = computed(() => {
  const start = (currentPage.value - 1) * perPage.value;
  const end = start + perPage.value;
  return filteredTransactions.value.slice(start, end);
});

const formatNumber = (num) => {
  return parseFloat(num || 0).toFixed(2);
};

const formatDate = (date) => {
  if (!date) return 'N/A';
  return new Date(date).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
};

const fetchTransactions = async () => {
  try {
    const response = await axios.get('/api/budget/transactions');
    transactions.value = response.data.transactions || [];
  } catch (error) {
    console.error('Error fetching transactions:', error);
  }
};

const fetchCategories = async () => {
  try {
    const response = await axios.get('/api/budget/categories');
    categories.value = response.data.categories || [];
  } catch (error) {
    console.error('Error fetching categories:', error);
  }
};

const openAddModal = () => {
  showAddModal.value = true;
};

const saveTransaction = async () => {
  loading.value = true;
  try {
    if (editingTransaction.value) {
      await axios.put(`/api/budget/transactions/${editingTransaction.value.id}`, form.value);
    } else {
      await axios.post('/api/budget/transactions', form.value);
    }
    await fetchTransactions();
    closeModal();
  } catch (error) {
    console.error('Error saving transaction:', error);
  } finally {
    loading.value = false;
  }
};

const editTransaction = (transaction) => {
  editingTransaction.value = transaction;
  form.value = {
    type: transaction.type,
    category_id: transaction.category_id,
    amount: transaction.amount,
    transaction_date: transaction.transaction_date,
    description: transaction.description || '',
    payment_method: transaction.payment_method || ''
  };
  showAddModal.value = true;
};

const deleteTransaction = async (id) => {
  if (!confirm('Are you sure you want to delete this transaction?')) return;

  try {
    await axios.delete(`/api/budget/transactions/${id}`);
    await fetchTransactions();
  } catch (error) {
    console.error('Error deleting transaction:', error);
  }
};

const closeModal = () => {
  showAddModal.value = false;
  editingTransaction.value = null;
  form.value = {
    type: 'expense',
    category_id: '',
    amount: 0,
    transaction_date: new Date().toISOString().split('T')[0],
    description: '',
    payment_method: ''
  };
};

const clearFilters = () => {
  startDate.value = '';
  endDate.value = '';
  categoryFilter.value = '';
  paymentMethodFilter.value = '';
};

// Reset category when type changes
watch(() => form.value.type, () => {
  form.value.category_id = '';
});

// Reset currentPage when filters change
watch([categoryFilter, paymentMethodFilter, startDate, endDate], () => {
  currentPage.value = 1;
});

onMounted(() => {
  fetchTransactions();
  fetchCategories();
});
</script>
