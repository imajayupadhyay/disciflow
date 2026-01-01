<template>
  <Head title="Dashboard" />

  <div class="min-h-screen bg-white dark:bg-gray-900 transition-colors duration-200">
    <Header />

    <main class="pt-16">
      <div class="container mx-auto px-4 py-8 max-w-4xl min-h-[calc(100vh-4rem)] flex items-center justify-center">
        <!-- Budget Tracker Card -->
        <a
          href="/trackers/budget-calculator/dashboard"
          class="w-full bg-gradient-to-br from-amber-50 to-orange-50 dark:from-amber-900/20 dark:to-orange-900/20 rounded-2xl border-2 border-amber-200 dark:border-amber-700 p-12 hover:shadow-2xl hover:shadow-amber-500/20 transition-all duration-300 group hover:scale-[1.02]"
        >
          <div class="flex flex-col items-center text-center">
            <!-- Icon -->
            <div class="w-24 h-24 bg-gradient-to-br from-amber-600 to-amber-800 dark:from-amber-500 dark:to-amber-700 rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-amber-500/30 group-hover:shadow-amber-500/50 transition-all">
              <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
              </svg>
            </div>

            <!-- Title -->
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-amber-700 dark:group-hover:text-amber-400 transition-colors">
              Budget Tracker
            </h1>

            <!-- Description -->
            <p class="text-gray-600 dark:text-gray-400 text-lg mb-6 max-w-md">
              Track your income, expenses, and budgets all in one place. Get insights into your financial health.
            </p>

            <!-- Button -->
            <div class="flex items-center space-x-2 text-amber-600 dark:text-amber-400 font-semibold group-hover:gap-4 transition-all">
              <span>Go to Dashboard</span>
              <svg class="w-5 h-5 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
              </svg>
            </div>
          </div>
        </a>
      </div>
    </main>
  </div>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import Header from '@/Components/Layout/Header.vue';
</script>
