<template>
  <div class="relative">
    <!-- Sidebar -->
    <aside
      :class="[
        'fixed left-0 top-16 h-[calc(100vh-4rem)] bg-white dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700 transition-all duration-300 z-40 hidden md:block',
        isCollapsed ? 'w-16' : 'w-64'
      ]"
    >
      <!-- Toggle Button -->
      <button
        @click="toggleSidebar"
        class="absolute -right-3 top-6 w-6 h-6 bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-full flex items-center justify-center hover:bg-zinc-50 dark:hover:bg-zinc-700 transition-colors shadow-md"
      >
        <svg
          :class="['w-4 h-4 text-zinc-600 dark:text-zinc-400 transition-transform duration-300', isCollapsed ? 'rotate-180' : '']"
          fill="none"
          stroke="currentColor"
          viewBox="0 0 24 24"
        >
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
      </button>

      <!-- Sidebar Content -->
      <div class="flex flex-col h-full">
        <!-- Sidebar Header -->
        <div class="p-4 border-b border-zinc-200 dark:border-zinc-700">
          <h2
            v-show="!isCollapsed"
            class="text-lg font-bold text-zinc-900 dark:text-white transition-opacity duration-200"
          >
            Your Trackers
          </h2>
          <div
            v-show="isCollapsed"
            class="w-8 h-8 bg-gradient-to-br from-amber-600 to-amber-800 dark:from-amber-500 dark:to-amber-700 rounded-lg flex items-center justify-center mx-auto"
          >
            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
            </svg>
          </div>
        </div>

        <!-- Trackers List -->
        <div class="flex-1 overflow-y-auto p-2">
          <nav class="space-y-1">
            <!-- Budget Calculator with Dropdown -->
            <div>
              <button
                @click="budgetDropdownOpen = !budgetDropdownOpen"
                :class="[
                  'w-full flex items-center rounded-lg transition-all duration-200',
                  isCollapsed ? 'justify-center p-3' : 'px-3 py-2 justify-between',
                  isActiveRoute('/trackers/budget-calculator')
                    ? 'bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400'
                    : 'text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800'
                ]"
                :title="isCollapsed ? 'Budget Calculator' : ''"
              >
                <div class="flex items-center" :class="isCollapsed ? '' : 'space-x-3'">
                  <div class="flex items-center justify-center w-8 h-8">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                    </svg>
                  </div>
                  <span v-show="!isCollapsed" class="font-medium text-sm">
                    Budget Calculator
                  </span>
                </div>
                <svg
                  v-show="!isCollapsed"
                  :class="['w-4 h-4 transition-transform duration-200', budgetDropdownOpen ? 'rotate-180' : '']"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
              </button>

              <!-- Dropdown Menu -->
              <div
                v-show="budgetDropdownOpen && !isCollapsed"
                class="mt-1 ml-6 space-y-1"
              >
                <Link
                  v-for="item in budgetMenuItems"
                  :key="item.id"
                  :href="item.route"
                  :class="[
                    'flex items-center space-x-2 px-3 py-2 rounded-lg text-sm transition-all duration-200',
                    isActiveRoute(item.route)
                      ? 'bg-amber-50 dark:bg-amber-900/20 text-amber-600 dark:text-amber-400'
                      : 'text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800'
                  ]"
                >
                  <div v-html="item.icon"></div>
                  <span>{{ item.name }}</span>
                </Link>
              </div>
            </div>
          </nav>
        </div>

        <!-- Add Tracker Button -->
        <div class="p-4 border-t border-zinc-200 dark:border-zinc-700">
          <button
            :class="[
              'w-full bg-gradient-to-r from-amber-600 to-amber-800 dark:from-amber-500 dark:to-amber-700 text-white rounded-lg hover:shadow-lg hover:shadow-amber-500/20 transition-all duration-200',
              isCollapsed ? 'p-3' : 'px-4 py-2.5'
            ]"
            :title="isCollapsed ? 'Add Tracker' : ''"
          >
            <svg
              v-if="isCollapsed"
              class="w-5 h-5 mx-auto"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
            >
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            <span v-else class="text-sm font-semibold">+ Add Tracker</span>
          </button>
        </div>
      </div>
    </aside>

    <!-- Overlay for mobile -->
    <div
      v-if="!isCollapsed"
      @click="toggleSidebar"
      class="fixed inset-0 bg-black/50 z-30 md:hidden"
    ></div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import { useSidebar } from '@/composables/useSidebar';

const { isCollapsed, toggleSidebar } = useSidebar();

const budgetDropdownOpen = ref(false);

const page = usePage();

const isActiveRoute = (route) => {
  return page.url.startsWith(route);
};

const budgetMenuItems = ref([
  {
    id: 'categories',
    name: 'Categories',
    route: '/trackers/budget-calculator/categories',
    icon: '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>'
  },
  {
    id: 'budget',
    name: 'Budget',
    route: '/trackers/budget-calculator/budget',
    icon: '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'
  },
  {
    id: 'transactions',
    name: 'Income / Expense',
    route: '/trackers/budget-calculator/transactions',
    icon: '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>'
  }
]);
</script>
