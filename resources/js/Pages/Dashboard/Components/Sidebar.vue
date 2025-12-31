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
            <a
              v-for="tracker in trackers"
              :key="tracker.id"
              href="#"
              :class="[
                'flex items-center rounded-lg transition-all duration-200',
                isCollapsed ? 'justify-center p-3' : 'px-3 py-2 space-x-3',
                tracker.active
                  ? 'bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400'
                  : 'text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800'
              ]"
              :title="isCollapsed ? tracker.name : ''"
            >
              <div
                :class="[
                  'flex items-center justify-center rounded-lg',
                  isCollapsed ? 'w-8 h-8' : 'w-8 h-8'
                ]"
                v-html="tracker.icon"
              ></div>
              <span
                v-show="!isCollapsed"
                class="font-medium text-sm transition-opacity duration-200"
              >
                {{ tracker.name }}
              </span>
            </a>
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
import { ref, provide } from 'vue';

const isCollapsed = ref(false);

provide('sidebarCollapsed', isCollapsed);

const trackers = ref([
  {
    id: 1,
    name: 'Habit Tracker',
    icon: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
    active: true
  },
  {
    id: 2,
    name: 'Water Intake',
    icon: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>',
    active: false
  },
  {
    id: 3,
    name: 'Sleep Tracker',
    icon: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>',
    active: false
  },
  {
    id: 4,
    name: 'Exercise Log',
    icon: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>',
    active: false
  },
  {
    id: 5,
    name: 'Mood Tracker',
    icon: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
    active: false
  },
  {
    id: 6,
    name: 'Reading Log',
    icon: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>',
    active: false
  },
  {
    id: 7,
    name: 'Meditation',
    icon: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>',
    active: false
  },
  {
    id: 8,
    name: 'Productivity',
    icon: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>',
    active: false
  }
]);

const toggleSidebar = () => {
  isCollapsed.value = !isCollapsed.value;
};
</script>
