<template>
  <div class="min-h-screen bg-white dark:bg-gray-900 transition-colors duration-200">
    <Header />
    <Sidebar />

    <main :class="['pt-16 transition-all duration-300', sidebarCollapsed ? 'md:pl-16' : 'md:pl-64']">
      <div class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
          <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Budget Planner</h1>
            <p class="text-gray-600 dark:text-gray-400">Set spending limits for your expense categories</p>
          </div>
          <button
            @click="showAddModal = true"
            class="mt-4 md:mt-0 px-6 py-3 bg-gradient-to-r from-amber-600 to-amber-800 dark:from-amber-500 dark:to-amber-700 text-white font-semibold rounded-lg hover:shadow-lg hover:shadow-amber-500/30 transition-all duration-200 flex items-center space-x-2"
          >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            <span>Set Budget</span>
          </button>
        </div>

        <!-- Period Filter -->
        <div class="mb-6">
          <div class="inline-flex bg-zinc-100 dark:bg-zinc-800 rounded-lg p-1">
            <button
              v-for="period in periods"
              :key="period.value"
              @click="activePeriod = period.value"
              :class="[
                'px-4 py-2 rounded-md text-sm font-medium transition-all duration-200',
                activePeriod === period.value
                  ? 'bg-white dark:bg-zinc-900 text-amber-600 dark:text-amber-400 shadow'
                  : 'text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-zinc-200'
              ]"
            >
              {{ period.label }}
            </button>
          </div>
        </div>

        <!-- Budget Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <div
            v-for="budget in filteredBudgets"
            :key="budget.id"
            class="group bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 p-6 hover:shadow-lg hover:shadow-amber-500/10 transition-all duration-200"
          >
            <!-- Category Info -->
            <div class="flex items-center justify-between mb-4">
              <div class="flex items-center space-x-3">
                <div
                  :style="{ backgroundColor: budget.category.color }"
                  class="w-10 h-10 rounded-lg flex items-center justify-center text-white shadow-md"
                >
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                  </svg>
                </div>
                <div>
                  <h3 class="font-semibold text-gray-900 dark:text-white">{{ budget.category.name }}</h3>
                  <p class="text-xs text-gray-500 dark:text-gray-400 capitalize">{{ budget.period }}</p>
                </div>
              </div>
              <div class="flex items-center space-x-1 opacity-0 group-hover:opacity-100 transition-opacity">
                <button
                  @click="editBudget(budget)"
                  class="p-2 text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-lg transition-colors"
                >
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                  </svg>
                </button>
                <button
                  @click="deleteBudget(budget.id)"
                  class="p-2 text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors"
                >
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                  </svg>
                </button>
              </div>
            </div>

            <!-- Budget Amount -->
            <div class="mb-4">
              <div class="flex items-baseline justify-between mb-2">
                <span class="text-2xl font-bold text-gray-900 dark:text-white">${{ formatNumber(budget.spent) }}</span>
                <span class="text-sm text-gray-500 dark:text-gray-400">of ${{ formatNumber(budget.amount) }}</span>
              </div>

              <!-- Progress Bar -->
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

            <!-- Stats -->
            <div class="flex items-center justify-between text-sm">
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

            <!-- Date Range -->
            <div class="mt-3 pt-3 border-t border-zinc-200 dark:border-zinc-700">
              <p class="text-xs text-gray-500 dark:text-gray-400">
                {{ formatDate(budget.start_date) }} - {{ formatDate(budget.end_date) }}
              </p>
            </div>
          </div>

          <!-- Empty State -->
          <div
            v-if="filteredBudgets.length === 0"
            class="col-span-full flex flex-col items-center justify-center py-16"
          >
            <div class="w-16 h-16 bg-zinc-100 dark:bg-zinc-800 rounded-full flex items-center justify-center mb-4">
              <svg class="w-8 h-8 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
            <p class="text-zinc-500 dark:text-zinc-400 text-lg font-medium mb-2">No {{ activePeriod }} budgets yet</p>
            <p class="text-zinc-400 dark:text-zinc-500 text-sm mb-4">Set your first budget to track spending</p>
            <button
              @click="showAddModal = true"
              class="px-4 py-2 text-amber-600 dark:text-amber-400 hover:bg-amber-50 dark:hover:bg-amber-900/20 rounded-lg transition-colors"
            >
              Set Budget
            </button>
          </div>
        </div>
      </div>
    </main>

    <!-- Add/Edit Budget Modal -->
    <div
      v-if="showAddModal"
      class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4"
      @click.self="closeModal"
    >
      <div class="bg-white dark:bg-zinc-800 rounded-2xl max-w-md w-full p-6 shadow-2xl transform transition-all">
        <div class="flex items-center justify-between mb-6">
          <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
            {{ editingBudget ? 'Edit' : 'Set' }} Budget
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

        <form @submit.prevent="saveBudget" class="space-y-4">
          <!-- Category Selection -->
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
                v-for="category in expenseCategories"
                :key="category.id"
                :value="category.id"
              >
                {{ category.name }}
              </option>
            </select>
          </div>

          <!-- Budget Amount -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Budget Amount ($)
            </label>
            <input
              v-model.number="form.amount"
              type="number"
              step="0.01"
              min="0"
              required
              class="w-full px-4 py-2.5 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
              placeholder="1000.00"
            />
          </div>

          <!-- Period -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Period
            </label>
            <div class="grid grid-cols-2 gap-3">
              <button
                v-for="period in periods"
                :key="period.value"
                type="button"
                @click="form.period = period.value"
                :class="[
                  'px-4 py-3 rounded-lg border-2 transition-all font-medium text-sm',
                  form.period === period.value
                    ? 'border-amber-500 bg-amber-50 dark:bg-amber-900/20 text-amber-600 dark:text-amber-400'
                    : 'border-zinc-200 dark:border-zinc-700 text-zinc-600 dark:text-zinc-400 hover:border-amber-300'
                ]"
              >
                {{ period.label }}
              </button>
            </div>
          </div>

          <!-- Date Range -->
          <div class="grid grid-cols-2 gap-3">
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Start Date
              </label>
              <input
                v-model="form.start_date"
                type="date"
                required
                class="w-full px-4 py-2.5 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
              />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                End Date
              </label>
              <input
                v-model="form.end_date"
                type="date"
                class="w-full px-4 py-2.5 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
              />
            </div>
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
              {{ loading ? 'Saving...' : (editingBudget ? 'Update' : 'Create') }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import Header from '@/Components/Layout/Header.vue';
import Sidebar from '@/Pages/Dashboard/Components/Sidebar.vue';
import { useSidebar } from '@/composables/useSidebar';
import axios from 'axios';

const { isCollapsed: sidebarCollapsed } = useSidebar();

const showAddModal = ref(false);
const editingBudget = ref(null);
const loading = ref(false);
const activePeriod = ref('monthly');

const periods = [
  { label: 'Daily', value: 'daily' },
  { label: 'Weekly', value: 'weekly' },
  { label: 'Monthly', value: 'monthly' },
  { label: 'Yearly', value: 'yearly' }
];

const form = ref({
  category_id: '',
  amount: 0,
  period: 'monthly',
  start_date: '',
  end_date: ''
});

const budgets = ref([]);
const categories = ref([]);

const expenseCategories = computed(() => {
  return categories.value.filter(cat => cat.type === 'expense');
});

const filteredBudgets = computed(() => {
  return budgets.value.filter(budget => budget.period === activePeriod.value);
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

const fetchBudgets = async () => {
  try {
    const response = await axios.get('/api/budget/budgets');
    budgets.value = response.data.budgets || [];
  } catch (error) {
    console.error('Error fetching budgets:', error);
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

const saveBudget = async () => {
  loading.value = true;
  try {
    if (editingBudget.value) {
      await axios.put(`/api/budget/budgets/${editingBudget.value.id}`, form.value);
    } else {
      await axios.post('/api/budget/budgets', form.value);
    }
    await fetchBudgets();
    closeModal();
  } catch (error) {
    console.error('Error saving budget:', error);
  } finally {
    loading.value = false;
  }
};

const editBudget = (budget) => {
  editingBudget.value = budget;
  form.value = {
    category_id: budget.category_id,
    amount: budget.amount,
    period: budget.period,
    start_date: budget.start_date,
    end_date: budget.end_date
  };
  showAddModal.value = true;
};

const deleteBudget = async (id) => {
  if (!confirm('Are you sure you want to delete this budget?')) return;

  try {
    await axios.delete(`/api/budget/budgets/${id}`);
    await fetchBudgets();
  } catch (error) {
    console.error('Error deleting budget:', error);
  }
};

const closeModal = () => {
  showAddModal.value = false;
  editingBudget.value = null;
  form.value = {
    category_id: '',
    amount: 0,
    period: 'monthly',
    start_date: '',
    end_date: ''
  };
};

onMounted(() => {
  fetchBudgets();
  fetchCategories();
});
</script>
