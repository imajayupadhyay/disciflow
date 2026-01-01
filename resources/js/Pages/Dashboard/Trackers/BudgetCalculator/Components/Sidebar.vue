<template>
  <div class="relative">
    <!-- Mobile Menu Button -->
    <button
      @click="toggleMobileSidebar"
      class="fixed left-0 top-1/2 -translate-y-1/2 z-50 md:hidden px-3 py-4 bg-amber-600 hover:bg-amber-700 text-white rounded-r-lg shadow-lg flex flex-col items-center justify-center gap-1 transition-all duration-200"
    >
      <div class="w-5 h-0.5 bg-white rounded"></div>
      <div class="w-5 h-0.5 bg-white rounded"></div>
      <div class="w-5 h-0.5 bg-white rounded"></div>
    </button>

    <!-- Sidebar -->
    <aside
      :class="[
        'fixed left-0 top-16 h-[calc(100vh-4rem)] bg-white dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700 transition-all duration-300 z-40',
        'md:block',
        isMobileOpen ? 'block w-64' : 'hidden md:block',
        isCollapsed && !isMobileOpen ? 'md:w-16' : 'md:w-64'
      ]"
    >
      <!-- Toggle Button (Desktop only) -->
      <button
        @click="toggleSidebar"
        class="absolute -right-3 top-6 w-6 h-6 bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-full items-center justify-center hover:bg-zinc-50 dark:hover:bg-zinc-700 transition-colors shadow-md hidden md:flex"
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
          <div class="flex items-center justify-between">
            <h2
              :class="[
                'text-lg font-bold text-zinc-900 dark:text-white transition-opacity duration-200',
                isCollapsed ? 'hidden md:hidden' : 'block'
              ]"
            >
              Your Trackers
            </h2>
            <div
              :class="[
                'w-8 h-8 bg-gradient-to-br from-amber-600 to-amber-800 dark:from-amber-500 dark:to-amber-700 rounded-lg flex items-center justify-center mx-auto',
                isCollapsed && !isMobileOpen ? 'md:flex' : 'hidden'
              ]"
            >
              <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
              </svg>
            </div>
            <!-- Close button for mobile -->
            <button
              @click="closeMobileSidebar"
              class="md:hidden p-1.5 hover:bg-zinc-100 dark:hover:bg-zinc-800 rounded-lg transition-colors"
            >
              <svg class="w-5 h-5 text-zinc-600 dark:text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
              </svg>
            </button>
          </div>
        </div>

        <!-- Trackers List -->
        <div class="flex-1 overflow-y-auto p-2">
          <nav class="space-y-1">
            <!-- Budget Calculator Menu Items -->
            <Link
              v-for="item in budgetMenuItems"
              :key="item.id"
              :href="item.route"
              @click="closeMobileSidebar"
              :class="[
                'flex items-center rounded-lg transition-all duration-200',
                isCollapsed && !isMobileOpen ? 'md:justify-center md:p-3 px-3 py-2 space-x-3' : 'px-3 py-2 space-x-3',
                isActiveRoute(item.route)
                  ? 'bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400'
                  : 'text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800'
              ]"
              :title="isCollapsed && !isMobileOpen ? item.name : ''"
            >
              <div class="flex items-center justify-center w-8 h-8 flex-shrink-0" v-html="item.icon"></div>
              <span
                :class="[
                  'font-medium text-sm',
                  isCollapsed && !isMobileOpen ? 'hidden md:hidden' : 'block'
                ]"
              >
                {{ item.name }}
              </span>
            </Link>
          </nav>
        </div>

        <!-- Add Tracker Button -->
        <div class="p-4 border-t border-zinc-200 dark:border-zinc-700">
          <button
            :class="[
              'w-full bg-gradient-to-r from-amber-600 to-amber-800 dark:from-amber-500 dark:to-amber-700 text-white rounded-lg hover:shadow-lg hover:shadow-amber-500/20 transition-all duration-200',
              isCollapsed && !isMobileOpen ? 'md:p-3 px-4 py-2.5' : 'px-4 py-2.5'
            ]"
            :title="isCollapsed && !isMobileOpen ? 'Add Tracker' : ''"
          >
            <svg
              :class="[
                'w-5 h-5 mx-auto',
                isCollapsed && !isMobileOpen ? 'md:block hidden' : 'hidden'
              ]"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
            >
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            <span
              :class="[
                'text-sm font-semibold',
                isCollapsed && !isMobileOpen ? 'hidden md:hidden' : 'block'
              ]"
            >
              + Add Tracker
            </span>
          </button>
        </div>
      </div>
    </aside>

    <!-- Overlay for mobile -->
    <div
      v-if="isMobileOpen"
      @click="closeMobileSidebar"
      class="fixed inset-0 bg-black/50 z-30 md:hidden"
    ></div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import { useSidebar } from '@/composables/useSidebar';

const { isCollapsed, toggleSidebar } = useSidebar();

const isMobileOpen = ref(false);

const toggleMobileSidebar = () => {
  isMobileOpen.value = !isMobileOpen.value;
};

const closeMobileSidebar = () => {
  isMobileOpen.value = false;
};

const page = usePage();

const isActiveRoute = (route) => {
  return page.url.startsWith(route);
};

const budgetMenuItems = ref([
  {
    id: 'dashboard',
    name: 'Dashboard',
    route: '/trackers/budget-calculator/dashboard',
    icon: '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>'
  },
  {
    id: 'categories',
    name: 'Categories',
    route: '/trackers/budget-calculator/categories',
    icon: '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>'
  },
  {
    id: 'payment-methods',
    name: 'Payment Methods',
    route: '/trackers/budget-calculator/payment-methods',
    icon: '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>'
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
  },
  {
    id: 'export',
    name: 'Export Reports',
    route: '/trackers/budget-calculator/export',
    icon: '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>'
  },
  {
    id: 'alerts',
    name: 'Alerts',
    route: '/trackers/budget-calculator/alerts',
    icon: '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>'
  }
]);
</script>
