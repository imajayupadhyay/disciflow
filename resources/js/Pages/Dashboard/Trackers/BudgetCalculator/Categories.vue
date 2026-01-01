<template>
  <Head title="Categories - Budget Calculator" />

  <div class="min-h-screen bg-white dark:bg-gray-900 transition-colors duration-200">
    <Header />
    <Sidebar />

    <main :class="['pt-16 transition-all duration-300', sidebarCollapsed ? 'md:pl-16' : 'md:pl-64']">
      <div class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Page Header -->
        <div class="mb-8 text-center">
          <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Categories</h1>
          <p class="text-gray-600 dark:text-gray-400 mb-6">Organize your finances with categories</p>

          <!-- Main Category Type Switcher -->
          <div class="flex justify-center">
            <div class="inline-flex bg-zinc-100 dark:bg-zinc-800 rounded-lg p-1">
              <button
                @click="activeTab = 'expense'"
                :class="[
                  'px-8 py-3 rounded-md text-sm font-semibold transition-all duration-200 flex items-center space-x-2',
                  activeTab === 'expense'
                    ? 'bg-white dark:bg-zinc-900 text-red-600 dark:text-red-400 shadow'
                    : 'text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-zinc-200'
                ]"
              >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                </svg>
                <span>Expenses</span>
              </button>
              <button
                @click="activeTab = 'income'"
                :class="[
                  'px-8 py-3 rounded-md text-sm font-semibold transition-all duration-200 flex items-center space-x-2',
                  activeTab === 'income'
                    ? 'bg-white dark:bg-zinc-900 text-green-600 dark:text-green-400 shadow'
                    : 'text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-zinc-200'
                ]"
              >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                </svg>
                <span>Income</span>
              </button>
            </div>
          </div>
        </div>

        <!-- Custom Category Button -->
        <div class="mb-6">
          <button
            @click="showAddModal = true"
            class="px-6 py-3 bg-gradient-to-r from-amber-600 to-amber-800 dark:from-amber-500 dark:to-amber-700 text-white font-semibold rounded-lg hover:shadow-lg hover:shadow-amber-500/30 transition-all duration-200 flex items-center space-x-2"
          >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            <span>Create Custom Category</span>
          </button>
        </div>

        <!-- My Categories Section Header -->
        <div class="mb-6">
          <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
            My {{ activeTab === 'income' ? 'Income' : 'Expense' }} Categories
          </h2>
        </div>

        <!-- Categories Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
          <div
            v-for="category in filteredCategories"
            :key="category.id"
            class="group bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 p-5 hover:shadow-lg hover:shadow-amber-500/10 hover:border-amber-300 dark:hover:border-amber-600 transition-all duration-200"
          >
            <div class="flex items-start justify-between">
              <div class="flex items-center space-x-3 flex-1">
                <div
                  :style="{ backgroundColor: category.color }"
                  class="w-12 h-12 rounded-lg flex items-center justify-center text-white shadow-md"
                >
                  <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="getCategoryIcon(category.icon)"/>
                  </svg>
                </div>
                <div class="flex-1">
                  <h3 class="font-semibold text-gray-900 dark:text-white">{{ category.name }}</h3>
                  <p class="text-sm text-gray-500 dark:text-gray-400 capitalize">{{ category.type }}</p>
                </div>
              </div>
              <div class="flex items-center space-x-2 opacity-0 group-hover:opacity-100 transition-opacity">
                <button
                  @click="editCategory(category)"
                  class="p-2 text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-lg transition-colors"
                >
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                  </svg>
                </button>
                <button
                  @click="deleteCategory(category.id)"
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
            v-if="filteredCategories.length === 0"
            class="col-span-full flex flex-col items-center justify-center py-16"
          >
            <div class="w-16 h-16 bg-zinc-100 dark:bg-zinc-800 rounded-full flex items-center justify-center mb-4">
              <svg class="w-8 h-8 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
              </svg>
            </div>
            <p class="text-zinc-500 dark:text-zinc-400 text-lg font-medium mb-2">No {{ activeTab }} categories yet</p>
            <p class="text-zinc-400 dark:text-zinc-500 text-sm mb-4">
              {{ categories.length === 0 ? 'Add from suggestions above or create a custom category' : 'Create your first ' + activeTab + ' category' }}
            </p>
            <div class="flex items-center space-x-3">
              <button
                v-if="!showSuggestions && categories.length > 0"
                @click="showSuggestions = true"
                class="px-4 py-2 text-amber-600 dark:text-amber-400 hover:bg-amber-50 dark:hover:bg-amber-900/20 rounded-lg transition-colors font-medium"
              >
                Browse Suggestions
              </button>
              <button
                @click="showAddModal = true; form.type = activeTab"
                class="px-4 py-2 bg-amber-600 dark:bg-amber-500 text-white hover:bg-amber-700 dark:hover:bg-amber-600 rounded-lg transition-colors font-medium"
              >
                Create Custom
              </button>
            </div>
          </div>
        </div>

        <!-- Show Suggestions Button (when hidden) -->
        <div v-if="categories.length > 0 && !showSuggestions" class="mt-8">
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

        <!-- Predefined Categories / Suggestions -->
        <div v-if="categories.length === 0 || showSuggestions" class="mt-8">
          <div class="bg-gradient-to-br from-amber-50 to-orange-50 dark:from-amber-900/20 dark:to-orange-900/20 rounded-xl border border-amber-200 dark:border-amber-700 p-6">
            <div class="flex items-start justify-between mb-4">
              <div>
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                  {{ categories.length === 0 ? 'Get Started Quickly!' : 'Quick Add Categories' }}
                </h2>
                <p class="text-gray-600 dark:text-gray-400 text-sm">
                  {{ categories.length === 0
                    ? 'Select from our predefined categories to start tracking immediately'
                    : 'Add more categories from our suggestions' }}
                </p>
              </div>
              <button
                v-if="categories.length > 0"
                @click="showSuggestions = false"
                class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300"
              >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
              </button>
            </div>

            <!-- Suggested Categories Grid -->
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-3">
              <button
                v-for="suggestion in filteredSuggestions"
                :key="suggestion.name"
                @click="addSuggestedCategory(suggestion)"
                :disabled="isCategoryExists(suggestion.name)"
                class="relative group p-4 bg-white dark:bg-zinc-800 rounded-lg border-2 border-dashed transition-all hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100"
                :class="[
                  isCategoryExists(suggestion.name)
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
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                  </div>
                  <span class="text-xs font-medium text-center text-gray-700 dark:text-gray-300">
                    {{ suggestion.name }}
                  </span>
                  <div v-if="!isCategoryExists(suggestion.name)" class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity bg-white/90 dark:bg-zinc-800/90 rounded-lg">
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

    <!-- Add/Edit Category Modal -->
    <div
      v-if="showAddModal"
      class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4"
      @click.self="closeModal"
    >
      <div class="bg-white dark:bg-zinc-800 rounded-2xl max-w-md w-full p-6 shadow-2xl transform transition-all">
        <div class="flex items-center justify-between mb-6">
          <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
            {{ editingCategory ? 'Edit' : 'Add' }} Category
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

        <form @submit.prevent="saveCategory" class="space-y-4">
          <!-- Category Name -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Category Name
            </label>
            <input
              v-model="form.name"
              type="text"
              required
              class="w-full px-4 py-2.5 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
              placeholder="e.g., Groceries, Salary"
            />
          </div>

          <!-- Category Type -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Type
            </label>
            <div class="grid grid-cols-2 gap-3">
              <button
                type="button"
                @click="form.type = 'expense'"
                :class="[
                  'px-4 py-3 rounded-lg border-2 transition-all font-medium',
                  form.type === 'expense'
                    ? 'border-red-500 bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400'
                    : 'border-zinc-200 dark:border-zinc-700 text-zinc-600 dark:text-zinc-400 hover:border-red-300'
                ]"
              >
                Expense
              </button>
              <button
                type="button"
                @click="form.type = 'income'"
                :class="[
                  'px-4 py-3 rounded-lg border-2 transition-all font-medium',
                  form.type === 'income'
                    ? 'border-green-500 bg-green-50 dark:bg-green-900/20 text-green-600 dark:text-green-400'
                    : 'border-zinc-200 dark:border-zinc-700 text-zinc-600 dark:text-zinc-400 hover:border-green-300'
                ]"
              >
                Income
              </button>
            </div>
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
              {{ loading ? 'Saving...' : (editingCategory ? 'Update' : 'Create') }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { Head } from '@inertiajs/vue3';
import Header from '@/Components/Layout/Header.vue';
import Sidebar from './Components/Sidebar.vue';
import { useSidebar } from '@/composables/useSidebar';
import axios from 'axios';

const { isCollapsed: sidebarCollapsed } = useSidebar();

const activeTab = ref('expense');
const showAddModal = ref(false);
const editingCategory = ref(null);
const loading = ref(false);
const showSuggestions = ref(true);

const form = ref({
  name: '',
  type: 'expense',
  color: '#EF4444',
  icon: 'default'
});

const colorOptions = [
  '#EF4444', '#F59E0B', '#10B981', '#3B82F6',
  '#8B5CF6', '#EC4899', '#14B8A6', '#F97316',
  '#6366F1', '#84CC16', '#06B6D4', '#A855F7',
  '#F43F5E', '#EAB308', '#22C55E', '#6B7280'
];

// Predefined category suggestions
const suggestedCategories = ref([
  // Expense Categories
  { name: 'Groceries', type: 'expense', color: '#10B981', icon: 'default' },
  { name: 'Dining Out', type: 'expense', color: '#F59E0B', icon: 'default' },
  { name: 'Transportation', type: 'expense', color: '#3B82F6', icon: 'default' },
  { name: 'Utilities', type: 'expense', color: '#8B5CF6', icon: 'default' },
  { name: 'Rent', type: 'expense', color: '#EF4444', icon: 'default' },
  { name: 'Healthcare', type: 'expense', color: '#EC4899', icon: 'default' },
  { name: 'Entertainment', type: 'expense', color: '#F97316', icon: 'default' },
  { name: 'Shopping', type: 'expense', color: '#6366F1', icon: 'default' },
  { name: 'Insurance', type: 'expense', color: '#14B8A6', icon: 'default' },
  { name: 'Education', type: 'expense', color: '#84CC16', icon: 'default' },
  { name: 'Fitness', type: 'expense', color: '#06B6D4', icon: 'default' },
  { name: 'Travel', type: 'expense', color: '#A855F7', icon: 'default' },
  { name: 'Subscriptions', type: 'expense', color: '#F43F5E', icon: 'default' },
  { name: 'Phone Bill', type: 'expense', color: '#EAB308', icon: 'default' },
  { name: 'Internet', type: 'expense', color: '#22C55E', icon: 'default' },
  { name: 'Gas/Fuel', type: 'expense', color: '#6B7280', icon: 'default' },
  { name: 'Clothing', type: 'expense', color: '#EC4899', icon: 'default' },
  { name: 'Personal Care', type: 'expense', color: '#8B5CF6', icon: 'default' },

  // Income Categories
  { name: 'Salary', type: 'income', color: '#10B981', icon: 'default' },
  { name: 'Freelance', type: 'income', color: '#3B82F6', icon: 'default' },
  { name: 'Business', type: 'income', color: '#F59E0B', icon: 'default' },
  { name: 'Investment', type: 'income', color: '#8B5CF6', icon: 'default' },
  { name: 'Rental Income', type: 'income', color: '#14B8A6', icon: 'default' },
  { name: 'Bonus', type: 'income', color: '#84CC16', icon: 'default' },
  { name: 'Gift', type: 'income', color: '#EC4899', icon: 'default' },
  { name: 'Refund', type: 'income', color: '#06B6D4', icon: 'default' },
  { name: 'Side Hustle', type: 'income', color: '#F97316', icon: 'default' },
  { name: 'Commission', type: 'income', color: '#A855F7', icon: 'default' },
  { name: 'Pension', type: 'income', color: '#22C55E', icon: 'default' },
  { name: 'Other Income', type: 'income', color: '#6B7280', icon: 'default' }
]);

const categories = ref([]);

const filteredCategories = computed(() => {
  return categories.value.filter(cat => cat.type === activeTab.value);
});

const filteredSuggestions = computed(() => {
  return suggestedCategories.value.filter(cat => cat.type === activeTab.value);
});

const isCategoryExists = (name) => {
  return categories.value.some(cat => cat.name.toLowerCase() === name.toLowerCase());
};

const getCategoryIcon = (icon) => {
  // Default icon path
  return 'M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z';
};

const fetchCategories = async () => {
  try {
    const response = await axios.get('/api/budget/categories');
    categories.value = response.data.categories || [];
  } catch (error) {
    console.error('Error fetching categories:', error);
  }
};

const saveCategory = async () => {
  loading.value = true;
  try {
    if (editingCategory.value) {
      await axios.put(`/api/budget/categories/${editingCategory.value.id}`, form.value);
    } else {
      await axios.post('/api/budget/categories', form.value);
    }
    await fetchCategories();
    closeModal();
  } catch (error) {
    console.error('Error saving category:', error);
  } finally {
    loading.value = false;
  }
};

const addSuggestedCategory = async (suggestion) => {
  if (isCategoryExists(suggestion.name)) {
    return;
  }

  try {
    await axios.post('/api/budget/categories', {
      name: suggestion.name,
      type: suggestion.type,
      color: suggestion.color,
      icon: suggestion.icon
    });
    await fetchCategories();

    // Show success feedback (optional - you could add a toast notification)
    console.log(`Added ${suggestion.name} successfully!`);
  } catch (error) {
    console.error('Error adding suggested category:', error);
  }
};

const editCategory = (category) => {
  editingCategory.value = category;
  form.value = {
    name: category.name,
    type: category.type,
    color: category.color,
    icon: category.icon || 'default'
  };
  showAddModal.value = true;
};

const deleteCategory = async (id) => {
  if (!confirm('Are you sure you want to delete this category?')) return;

  try {
    await axios.delete(`/api/budget/categories/${id}`);
    await fetchCategories();
  } catch (error) {
    console.error('Error deleting category:', error);
  }
};

const closeModal = () => {
  showAddModal.value = false;
  editingCategory.value = null;
  form.value = {
    name: '',
    type: 'expense',
    color: '#EF4444',
    icon: 'default'
  };
};

// Fetch categories on mount
fetchCategories();
</script>
