<template>
  <div class="min-h-screen bg-white dark:bg-gray-900 transition-colors duration-200">
    <Header />
    <Sidebar />

    <main :class="['pt-16 transition-all duration-300', sidebarCollapsed ? 'md:pl-16' : 'md:pl-64']">
      <div class="container mx-auto px-4 py-16">
        <div class="max-w-4xl mx-auto text-center">
          <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-4">
            Welcome to Your Dashboard
          </h1>
          <p class="text-lg text-gray-600 dark:text-gray-300">
            Hello, {{ user?.name || 'Customer' }}! We're glad to have you here.
          </p>
        </div>
      </div>
    </main>
  </div>
</template>

<script setup>
import Header from '@/Components/Layout/Header.vue';
import Sidebar from './Components/Sidebar.vue';
import { useAuth } from '@/composables/useAuth';
import { useSidebar } from '@/composables/useSidebar';

const { user } = useAuth();
const { isCollapsed: sidebarCollapsed } = useSidebar();
</script>
