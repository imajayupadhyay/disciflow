<template>
  <Head title="Alerts - Budget Calculator" />

  <div class="min-h-screen bg-white dark:bg-gray-900 transition-colors duration-200">
    <Header />
    <Sidebar />

    <main :class="['pt-16 transition-all duration-300', sidebarCollapsed ? 'md:pl-16' : 'md:pl-64']">
      <div class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
          <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Budget Alerts</h1>
            <p class="text-gray-600 dark:text-gray-400">Stay on track with smart spending alerts</p>
          </div>
          <div class="flex items-center space-x-3 mt-4 md:mt-0">
            <button
              @click="openCreateModal()"
              class="px-6 py-3 bg-gradient-to-r from-amber-600 to-amber-800 dark:from-amber-500 dark:to-amber-700 text-white font-semibold rounded-lg hover:shadow-lg hover:shadow-amber-500/30 transition-all duration-200 flex items-center space-x-2"
            >
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
              </svg>
              <span>Create Alert</span>
            </button>
          </div>
        </div>

        <!-- Alert Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
          <div class="bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 rounded-xl border border-blue-200 dark:border-blue-700 p-5">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-blue-600 dark:text-blue-400 text-sm font-medium mb-1">Total Alerts</p>
                <p class="text-2xl font-bold text-blue-900 dark:text-blue-100">{{ alerts.length }}</p>
              </div>
              <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                </svg>
              </div>
            </div>
          </div>

          <div class="bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/20 rounded-xl border border-green-200 dark:border-green-700 p-5">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-green-600 dark:text-green-400 text-sm font-medium mb-1">Active</p>
                <p class="text-2xl font-bold text-green-900 dark:text-green-100">{{ activeAlertsCount }}</p>
              </div>
              <div class="w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
              </div>
            </div>
          </div>

          <div class="bg-gradient-to-br from-amber-50 to-amber-100 dark:from-amber-900/20 dark:to-amber-800/20 rounded-xl border border-amber-200 dark:border-amber-700 p-5">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-amber-600 dark:text-amber-400 text-sm font-medium mb-1">Triggered</p>
                <p class="text-2xl font-bold text-amber-900 dark:text-amber-100">{{ triggeredAlertsCount }}</p>
              </div>
              <div class="w-12 h-12 bg-amber-500 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
              </div>
            </div>
          </div>

          <div class="bg-gradient-to-br from-red-50 to-red-100 dark:from-red-900/20 dark:to-red-800/20 rounded-xl border border-red-200 dark:border-red-700 p-5">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-red-600 dark:text-red-400 text-sm font-medium mb-1">Inactive</p>
                <p class="text-2xl font-bold text-red-900 dark:text-red-100">{{ inactiveAlertsCount }}</p>
              </div>
              <div class="w-12 h-12 bg-red-500 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                </svg>
              </div>
            </div>
          </div>
        </div>

        <!-- Alerts List -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 overflow-hidden">
          <div class="px-6 py-4 border-b border-zinc-200 dark:border-zinc-700">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">My Alerts</h2>
          </div>

          <div v-if="alerts.length === 0" class="flex flex-col items-center justify-center py-16">
            <div class="w-16 h-16 bg-zinc-100 dark:bg-zinc-900 rounded-full flex items-center justify-center mb-4">
              <svg class="w-8 h-8 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
              </svg>
            </div>
            <p class="text-zinc-500 dark:text-zinc-400 text-lg font-medium mb-2">No alerts created yet</p>
            <p class="text-zinc-400 dark:text-zinc-500 text-sm mb-4">Create your first alert to stay on top of your budget</p>
            <button
              @click="openCreateModal()"
              class="px-4 py-2 text-amber-600 dark:text-amber-400 hover:bg-amber-50 dark:hover:bg-amber-900/20 rounded-lg transition-colors"
            >
              Create Alert
            </button>
          </div>

          <div v-else class="divide-y divide-zinc-200 dark:divide-zinc-700">
            <div
              v-for="alert in alerts"
              :key="alert.id"
              class="p-6 hover:bg-zinc-50 dark:hover:bg-zinc-900/50 transition-colors"
            >
              <div class="flex items-start justify-between">
                <div class="flex-1">
                  <div class="flex items-center space-x-3 mb-2">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ alert.name }}</h3>
                    <span
                      :class="[
                        'px-2.5 py-0.5 rounded-full text-xs font-medium',
                        alert.is_active
                          ? 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400'
                          : 'bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400'
                      ]"
                    >
                      {{ alert.is_active ? 'Active' : 'Inactive' }}
                    </span>
                    <span
                      v-if="alert.is_triggered"
                      class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400"
                    >
                      Triggered
                    </span>
                  </div>

                  <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-3">
                    <div>
                      <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Alert Type</p>
                      <p class="text-sm font-medium text-gray-900 dark:text-white capitalize">{{ alert.alert_type }}</p>
                    </div>
                    <div>
                      <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Condition</p>
                      <p class="text-sm font-medium text-gray-900 dark:text-white">
                        {{ alert.condition_type === 'percentage' ? alert.threshold_value + '%' : '$' + alert.threshold_value }}
                        {{ alert.condition_operator === 'exceeds' ? 'Exceeded' : 'Reached' }}
                      </p>
                    </div>
                    <div>
                      <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Frequency</p>
                      <p class="text-sm font-medium text-gray-900 dark:text-white capitalize">{{ alert.frequency }}</p>
                    </div>
                  </div>

                  <div v-if="alert.category" class="mt-3">
                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Category</p>
                    <div class="flex items-center space-x-2">
                      <div
                        :style="{ backgroundColor: alert.category.color }"
                        class="w-6 h-6 rounded flex items-center justify-center"
                      >
                        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                      </div>
                      <span class="text-sm font-medium text-gray-900 dark:text-white">{{ alert.category.name }}</span>
                    </div>
                  </div>

                  <div v-if="alert.budget" class="mt-3">
                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Budget</p>
                    <span class="text-sm font-medium text-gray-900 dark:text-white">{{ alert.budget.category.name }} - {{ alert.budget.period }}</span>
                  </div>
                </div>

                <div class="flex items-center space-x-2 ml-4">
                  <label class="relative inline-flex items-center cursor-pointer">
                    <input
                      type="checkbox"
                      :checked="alert.is_active"
                      @change="toggleAlert(alert.id, !alert.is_active)"
                      class="sr-only peer"
                    />
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-amber-300 dark:peer-focus:ring-amber-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-amber-600"></div>
                  </label>

                  <button
                    @click="editAlert(alert)"
                    class="p-2 text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-lg transition-colors"
                  >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                  </button>

                  <button
                    @click="deleteAlert(alert.id)"
                    class="p-2 text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors"
                  >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- Create/Edit Alert Modal -->
    <div
      v-if="showModal"
      class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4"
      @click.self="closeModal"
    >
      <div class="bg-white dark:bg-zinc-800 rounded-2xl max-w-2xl w-full p-6 shadow-2xl transform transition-all max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between mb-6">
          <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
            {{ editingAlert ? 'Edit Alert' : 'Create Alert' }}
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

        <form @submit.prevent="saveAlert" class="space-y-5">
          <!-- Alert Name -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Alert Name
            </label>
            <input
              v-model="form.name"
              type="text"
              required
              class="w-full px-4 py-2.5 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
              placeholder="e.g., Monthly Groceries Limit"
            />
          </div>

          <!-- Alert Type -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Alert Type
            </label>
            <select
              v-model="form.alert_type"
              required
              @change="onAlertTypeChange"
              class="w-full px-4 py-2.5 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 transition-all"
            >
              <option value="">Select alert type</option>
              <option value="budget_exceeded">Budget Exceeded</option>
              <option value="category_spending">Category Spending Limit</option>
              <option value="daily_spending">Daily Spending Limit</option>
              <option value="transaction_threshold">Large Transaction Alert</option>
            </select>
          </div>

          <!-- Budget Selection (for budget_exceeded) -->
          <div v-if="form.alert_type === 'budget_exceeded'">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Select Budget
            </label>
            <select
              v-model="form.budget_id"
              required
              class="w-full px-4 py-2.5 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 transition-all"
            >
              <option value="">Select a budget</option>
              <option
                v-for="budget in budgets"
                :key="budget.id"
                :value="budget.id"
              >
                {{ budget.category.name }} - {{ budget.period }} (${{ budget.amount }})
              </option>
            </select>
          </div>

          <!-- Category Selection (for category_spending) -->
          <div v-if="form.alert_type === 'category_spending'">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Select Category
            </label>
            <select
              v-model="form.category_id"
              required
              class="w-full px-4 py-2.5 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 transition-all"
            >
              <option value="">Select a category</option>
              <option
                v-for="category in categories"
                :key="category.id"
                :value="category.id"
              >
                {{ category.name }}
              </option>
            </select>
          </div>

          <!-- Condition Type -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Condition Type
            </label>
            <div class="grid grid-cols-2 gap-3">
              <button
                type="button"
                @click="form.condition_type = 'percentage'"
                :class="[
                  'px-4 py-3 rounded-lg border-2 transition-all font-medium',
                  form.condition_type === 'percentage'
                    ? 'border-amber-500 bg-amber-50 dark:bg-amber-900/20 text-amber-600 dark:text-amber-400'
                    : 'border-zinc-200 dark:border-zinc-700 text-zinc-600 dark:text-zinc-400 hover:border-amber-300'
                ]"
              >
                Percentage (%)
              </button>
              <button
                type="button"
                @click="form.condition_type = 'amount'"
                :class="[
                  'px-4 py-3 rounded-lg border-2 transition-all font-medium',
                  form.condition_type === 'amount'
                    ? 'border-amber-500 bg-amber-50 dark:bg-amber-900/20 text-amber-600 dark:text-amber-400'
                    : 'border-zinc-200 dark:border-zinc-700 text-zinc-600 dark:text-zinc-400 hover:border-amber-300'
                ]"
              >
                Fixed Amount ($)
              </button>
            </div>
          </div>

          <!-- Threshold Value -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Threshold Value {{ form.condition_type === 'percentage' ? '(%)' : '($)' }}
            </label>
            <input
              v-model.number="form.threshold_value"
              type="number"
              step="0.01"
              min="0"
              required
              class="w-full px-4 py-2.5 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
              :placeholder="form.condition_type === 'percentage' ? '80' : '1000'"
            />
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
              {{ form.condition_type === 'percentage' ? 'Alert when spending reaches this percentage of budget' : 'Alert when spending exceeds this amount' }}
            </p>
          </div>

          <!-- Frequency -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Alert Frequency
            </label>
            <select
              v-model="form.frequency"
              required
              class="w-full px-4 py-2.5 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 transition-all"
            >
              <option value="once">Once (First time only)</option>
              <option value="daily">Daily</option>
              <option value="weekly">Weekly</option>
              <option value="monthly">Monthly</option>
            </select>
          </div>

          <!-- Email Notification -->
          <div class="flex items-center justify-between p-4 bg-zinc-50 dark:bg-zinc-900 rounded-lg">
            <div>
              <p class="font-medium text-gray-900 dark:text-white">Email Notification</p>
              <p class="text-sm text-gray-500 dark:text-gray-400">Send alert to your email</p>
            </div>
            <label class="relative inline-flex items-center cursor-pointer">
              <input
                type="checkbox"
                v-model="form.send_email"
                class="sr-only peer"
              />
              <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-amber-300 dark:peer-focus:ring-amber-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-amber-600"></div>
            </label>
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
              {{ loading ? 'Saving...' : (editingAlert ? 'Update Alert' : 'Create Alert') }}
            </button>
          </div>
        </form>
      </div>
    </div>
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

const showModal = ref(false);
const editingAlert = ref(null);
const loading = ref(false);

const form = ref({
  name: '',
  alert_type: '',
  budget_id: '',
  category_id: '',
  condition_type: 'percentage',
  threshold_value: 80,
  frequency: 'once',
  send_email: true
});

const alerts = ref([]);
const budgets = ref([]);
const categories = ref([]);

const activeAlertsCount = computed(() => {
  return alerts.value.filter(a => a.is_active).length;
});

const inactiveAlertsCount = computed(() => {
  return alerts.value.filter(a => !a.is_active).length;
});

const triggeredAlertsCount = computed(() => {
  return alerts.value.filter(a => a.is_triggered).length;
});

const fetchAlerts = async () => {
  try {
    const response = await axios.get('/api/budget/alerts');
    alerts.value = response.data.alerts || [];
  } catch (error) {
    console.error('Error fetching alerts:', error);
  }
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

const openCreateModal = () => {
  showModal.value = true;
};

const onAlertTypeChange = () => {
  // Reset budget/category selection when type changes
  form.value.budget_id = '';
  form.value.category_id = '';
};

const saveAlert = async () => {
  loading.value = true;
  try {
    if (editingAlert.value) {
      await axios.put(`/api/budget/alerts/${editingAlert.value.id}`, form.value);
    } else {
      await axios.post('/api/budget/alerts', form.value);
    }
    await fetchAlerts();
    closeModal();
  } catch (error) {
    console.error('Error saving alert:', error);
    alert('Error saving alert. Please try again.');
  } finally {
    loading.value = false;
  }
};

const editAlert = (alert) => {
  editingAlert.value = alert;
  form.value = {
    name: alert.name,
    alert_type: alert.alert_type,
    budget_id: alert.budget_id || '',
    category_id: alert.category_id || '',
    condition_type: alert.condition_type,
    threshold_value: alert.threshold_value,
    frequency: alert.frequency,
    send_email: alert.send_email
  };
  showModal.value = true;
};

const toggleAlert = async (id, status) => {
  try {
    await axios.patch(`/api/budget/alerts/${id}/toggle`, { is_active: status });
    await fetchAlerts();
  } catch (error) {
    console.error('Error toggling alert:', error);
  }
};

const deleteAlert = async (id) => {
  if (!confirm('Are you sure you want to delete this alert?')) return;

  try {
    await axios.delete(`/api/budget/alerts/${id}`);
    await fetchAlerts();
  } catch (error) {
    console.error('Error deleting alert:', error);
  }
};

const closeModal = () => {
  showModal.value = false;
  editingAlert.value = null;
  form.value = {
    name: '',
    alert_type: '',
    budget_id: '',
    category_id: '',
    condition_type: 'percentage',
    threshold_value: 80,
    frequency: 'once',
    send_email: true
  };
};

onMounted(() => {
  fetchAlerts();
  fetchBudgets();
  fetchCategories();
});
</script>
