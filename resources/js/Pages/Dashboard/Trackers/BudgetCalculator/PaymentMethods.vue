<template>
  <Head title="Payment Methods - Budget Calculator" />

  <div class="min-h-screen bg-white dark:bg-gray-900 transition-colors duration-200">
    <Header />
    <Sidebar />

    <main :class="['pt-16 transition-all duration-300', sidebarCollapsed ? 'md:pl-16' : 'md:pl-64']">
      <div class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Page Header -->
        <div class="mb-8 text-center">
          <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Payment Methods</h1>
          <p class="text-gray-600 dark:text-gray-400 mb-6">Manage how you pay for things</p>
        </div>

        <!-- Custom Payment Method Button -->
        <div class="mb-6">
          <button
            @click="showAddModal = true"
            class="px-6 py-3 bg-gradient-to-r from-amber-600 to-amber-800 dark:from-amber-500 dark:to-amber-700 text-white font-semibold rounded-lg hover:shadow-lg hover:shadow-amber-500/30 transition-all duration-200 flex items-center space-x-2"
          >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            <span>Add Payment Method</span>
          </button>
        </div>

        <!-- My Payment Methods Section Header -->
        <div class="mb-6">
          <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
            My Payment Methods
          </h2>
        </div>

        <!-- Payment Methods Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
          <div
            v-for="method in paymentMethods"
            :key="method.id"
            class="group bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 p-5 hover:shadow-lg hover:shadow-amber-500/10 hover:border-amber-300 dark:hover:border-amber-600 transition-all duration-200"
          >
            <div class="flex items-start justify-between">
              <div class="flex items-center space-x-3 flex-1">
                <div
                  :style="{ backgroundColor: method.color }"
                  class="w-12 h-12 rounded-lg flex items-center justify-center text-white shadow-md"
                >
                  <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                  </svg>
                </div>
                <div class="flex-1">
                  <h3 class="font-semibold text-gray-900 dark:text-white">{{ method.name }}</h3>
                  <p class="text-sm text-gray-500 dark:text-gray-400 capitalize">{{ method.type }}</p>
                </div>
              </div>
              <div class="flex items-center space-x-2 opacity-0 group-hover:opacity-100 transition-opacity">
                <button
                  @click="editPaymentMethod(method)"
                  class="p-2 text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-lg transition-colors"
                >
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                  </svg>
                </button>
                <button
                  @click="deletePaymentMethod(method.id)"
                  class="p-2 text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors"
                >
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                  </svg>
                </button>
              </div>
            </div>
          </div>

          <!-- Empty State -->
          <div
            v-if="paymentMethods.length === 0"
            class="col-span-full flex flex-col items-center justify-center py-16"
          >
            <div class="w-16 h-16 bg-zinc-100 dark:bg-zinc-800 rounded-full flex items-center justify-center mb-4">
              <svg class="w-8 h-8 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
              </svg>
            </div>
            <p class="text-zinc-500 dark:text-zinc-400 text-lg font-medium mb-2">No payment methods yet</p>
            <p class="text-zinc-400 dark:text-zinc-500 text-sm mb-4">Add from suggestions below or create a custom one</p>
            <button
              @click="showAddModal = true"
              class="px-4 py-2 text-amber-600 dark:text-amber-400 hover:bg-amber-50 dark:hover:bg-amber-900/20 rounded-lg transition-colors font-medium"
            >
              Add Payment Method
            </button>
          </div>
        </div>

        <!-- Show Suggestions Button (when hidden) -->
        <div v-if="paymentMethods.length > 0 && !showSuggestions" class="mt-8">
          <button
            @click="showSuggestions = true"
            class="text-amber-600 dark:text-amber-400 hover:underline text-sm font-medium flex items-center space-x-2"
          >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            <span>Quick add from suggestions</span>
          </button>
        </div>

        <!-- Predefined Payment Methods / Suggestions -->
        <div v-if="paymentMethods.length === 0 || showSuggestions" class="mt-8">
          <div class="bg-gradient-to-br from-amber-50 to-orange-50 dark:from-amber-900/20 dark:to-orange-900/20 rounded-xl border border-amber-200 dark:border-amber-700 p-6">
            <div class="flex items-start justify-between mb-4">
              <div>
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                  {{ paymentMethods.length === 0 ? 'Get Started Quickly!' : 'Quick Add Payment Methods' }}
                </h2>
                <p class="text-gray-600 dark:text-gray-400 text-sm">
                  {{ paymentMethods.length === 0
                    ? 'Select from our predefined payment methods to start tracking immediately'
                    : 'Add more payment methods from our suggestions' }}
                </p>
              </div>
              <button
                v-if="paymentMethods.length > 0"
                @click="showSuggestions = false"
                class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300"
              >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
              </button>
            </div>

            <!-- Suggested Payment Methods Grid -->
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-3">
              <button
                v-for="suggestion in suggestedPaymentMethods"
                :key="suggestion.name"
                @click="addSuggestedPaymentMethod(suggestion)"
                :disabled="isPaymentMethodExists(suggestion.name)"
                class="relative group p-4 bg-white dark:bg-zinc-800 rounded-lg border-2 border-dashed transition-all hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100"
                :class="[
                  isPaymentMethodExists(suggestion.name)
                    ? 'border-zinc-200 dark:border-zinc-700'
                    : 'border-zinc-300 dark:border-zinc-600 hover:border-amber-500 dark:hover:border-amber-500'
                ]"
              >
                <div class="flex flex-col items-center space-y-2">
                  <div
                    :style="{ backgroundColor: suggestion.color }"
                    class="w-12 h-12 rounded-lg flex items-center justify-center shadow-md"
                  >
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                    </svg>
                  </div>
                  <span class="text-xs font-medium text-center text-gray-700 dark:text-gray-300">
                    {{ suggestion.name }}
                  </span>
                  <div v-if="!isPaymentMethodExists(suggestion.name)" class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity bg-white/90 dark:bg-zinc-800/90 rounded-lg">
                    <svg class="w-8 h-8 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                  </div>
                  <div v-else class="absolute top-2 right-2">
                    <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                  </div>
                </div>
              </button>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- Add/Edit Payment Method Modal -->
    <div
      v-if="showAddModal"
      class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4"
      @click.self="closeModal"
    >
      <div class="bg-white dark:bg-zinc-800 rounded-2xl max-w-md w-full p-6 shadow-2xl transform transition-all">
        <div class="flex items-center justify-between mb-6">
          <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
            {{ editingPaymentMethod ? 'Edit' : 'Add' }} Payment Method
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

        <form @submit.prevent="savePaymentMethod" class="space-y-4">
          <!-- Payment Method Name -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Payment Method Name
            </label>
            <input
              v-model="form.name"
              type="text"
              required
              class="w-full px-4 py-2.5 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
              placeholder="e.g., Chase Credit Card, Cash"
            />
          </div>

          <!-- Type -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Type (Optional)
            </label>
            <input
              v-model="form.type"
              type="text"
              class="w-full px-4 py-2.5 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
              placeholder="e.g., Credit Card, Bank Account"
            />
          </div>

          <!-- Color Picker -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Color
            </label>
            <div class="grid grid-cols-8 gap-2">
              <button
                v-for="color in colorOptions"
                :key="color"
                type="button"
                @click="form.color = color"
                :style="{ backgroundColor: color }"
                :class="[
                  'w-10 h-10 rounded-lg transition-all',
                  form.color === color ? 'ring-2 ring-offset-2 ring-amber-500 scale-110' : 'hover:scale-105'
                ]"
              ></button>
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
              {{ loading ? 'Saving...' : (editingPaymentMethod ? 'Update' : 'Add') }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { Head } from '@inertiajs/vue3';
import Header from '@/Components/Layout/Header.vue';
import Sidebar from './Components/Sidebar.vue';
import { useSidebar } from '@/composables/useSidebar';
import axios from 'axios';

const { isCollapsed: sidebarCollapsed } = useSidebar();

const showAddModal = ref(false);
const editingPaymentMethod = ref(null);
const loading = ref(false);
const showSuggestions = ref(true);

const form = ref({
  name: '',
  type: 'custom',
  color: '#3B82F6',
  icon: 'default'
});

const colorOptions = [
  '#EF4444', '#F59E0B', '#10B981', '#3B82F6',
  '#8B5CF6', '#EC4899', '#14B8A6', '#F97316',
  '#6366F1', '#84CC16', '#06B6D4', '#A855F7',
  '#F43F5E', '#EAB308', '#22C55E', '#6B7280'
];

// Predefined payment method suggestions
const suggestedPaymentMethods = ref([
  { name: 'Cash', type: 'cash', color: '#10B981', icon: 'default' },
  { name: 'Credit Card', type: 'credit_card', color: '#3B82F6', icon: 'default' },
  { name: 'Debit Card', type: 'debit_card', color: '#8B5CF6', icon: 'default' },
  { name: 'Bank Transfer', type: 'bank_transfer', color: '#14B8A6', icon: 'default' },
  { name: 'PayPal', type: 'digital_wallet', color: '#F59E0B', icon: 'default' },
  { name: 'Apple Pay', type: 'digital_wallet', color: '#6B7280', icon: 'default' },
  { name: 'Google Pay', type: 'digital_wallet', color: '#06B6D4', icon: 'default' },
  { name: 'Venmo', type: 'digital_wallet', color: '#3B82F6', icon: 'default' },
  { name: 'Check', type: 'check', color: '#84CC16', icon: 'default' },
  { name: 'Wire Transfer', type: 'bank_transfer', color: '#A855F7', icon: 'default' },
  { name: 'Gift Card', type: 'gift_card', color: '#EC4899', icon: 'default' },
  { name: 'Cryptocurrency', type: 'crypto', color: '#F97316', icon: 'default' }
]);

const paymentMethods = ref([]);

const isPaymentMethodExists = (name) => {
  return paymentMethods.value.some(pm => pm.name.toLowerCase() === name.toLowerCase());
};

const fetchPaymentMethods = async () => {
  try {
    const response = await axios.get('/api/budget/payment-methods');
    paymentMethods.value = response.data.payment_methods || [];
  } catch (error) {
    console.error('Error fetching payment methods:', error);
  }
};

const savePaymentMethod = async () => {
  loading.value = true;
  try {
    if (editingPaymentMethod.value) {
      await axios.put(`/api/budget/payment-methods/${editingPaymentMethod.value.id}`, form.value);
    } else {
      await axios.post('/api/budget/payment-methods', form.value);
    }
    await fetchPaymentMethods();
    closeModal();
  } catch (error) {
    console.error('Error saving payment method:', error);
  } finally {
    loading.value = false;
  }
};

const addSuggestedPaymentMethod = async (suggestion) => {
  if (isPaymentMethodExists(suggestion.name)) {
    return;
  }

  try {
    await axios.post('/api/budget/payment-methods', {
      name: suggestion.name,
      type: suggestion.type,
      color: suggestion.color,
      icon: suggestion.icon
    });
    await fetchPaymentMethods();
  } catch (error) {
    console.error('Error adding suggested payment method:', error);
  }
};

const editPaymentMethod = (method) => {
  editingPaymentMethod.value = method;
  form.value = {
    name: method.name,
    type: method.type || 'custom',
    color: method.color,
    icon: method.icon || 'default'
  };
  showAddModal.value = true;
};

const deletePaymentMethod = async (id) => {
  if (!confirm('Are you sure you want to delete this payment method?')) return;

  try {
    await axios.delete(`/api/budget/payment-methods/${id}`);
    await fetchPaymentMethods();
  } catch (error) {
    console.error('Error deleting payment method:', error);
  }
};

const closeModal = () => {
  showAddModal.value = false;
  editingPaymentMethod.value = null;
  form.value = {
    name: '',
    type: 'custom',
    color: '#3B82F6',
    icon: 'default'
  };
};

// Fetch payment methods on mount
fetchPaymentMethods();
</script>
