<template>
    <section id="trackers" class="relative py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-6xl font-bold text-zinc-900 dark:text-white mb-4">
                    Life Tracking <span class="bg-gradient-to-r from-amber-700 to-amber-900 dark:from-amber-500 dark:to-amber-700 bg-clip-text text-transparent">Systems</span>
                </h2>
                <p class="text-lg text-zinc-600 dark:text-zinc-400 max-w-2xl mx-auto">
                    Monitor every aspect of your life with precision and purpose
                </p>
            </div>

            <!-- Trackers Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <Link
                    v-for="tracker in trackers"
                    :key="tracker.slug"
                    :href="`/coming-soon/${tracker.slug}`"
                    class="group bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-2xl p-6 hover:border-amber-700 dark:hover:border-amber-600 transition-all duration-300 hover:shadow-xl hover:shadow-amber-900/10 dark:hover:shadow-amber-600/10 hover:-translate-y-1 cursor-pointer"
                >
                    <div class="w-12 h-12 bg-amber-100 dark:bg-amber-900/30 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-amber-700 dark:text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="tracker.icon"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-zinc-900 dark:text-white mb-2">{{ tracker.name }} Tracker</h3>
                    <p class="text-sm text-zinc-600 dark:text-zinc-400 leading-relaxed">{{ tracker.description }}</p>
                </Link>
            </div>

            <!-- CTA -->
            <div class="text-center mt-16">
                <button class="px-10 py-4 bg-gradient-to-r from-amber-700 to-amber-900 dark:from-amber-600 dark:to-amber-800 text-white font-semibold rounded-xl hover:shadow-xl hover:shadow-amber-900/30 dark:hover:shadow-amber-600/30 transition-all duration-300 hover:scale-105">
                    Explore All Trackers
                </button>
            </div>
        </div>
    </section>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

const trackers = [
    { name: 'Budget', slug: 'budget', icon: 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z', description: 'Track income, expenses, and financial goals' },
    { name: 'Habit', slug: 'habit', icon: 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z', description: 'Build streaks and maintain consistency' },
    { name: 'Task', slug: 'task', icon: 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4', description: 'Organize and complete daily tasks' },
    { name: 'Goals', slug: 'goals', icon: 'M13 10V3L4 14h7v7l9-11h-7z', description: 'Set and achieve your life goals' },
    { name: 'Food', slug: 'food', icon: 'M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z', description: 'Monitor nutrition and eating habits' },
    { name: 'Time', slug: 'time', icon: 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', description: 'Optimize how you spend your time' },
    { name: 'Gym', slug: 'gym', icon: 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z', description: 'Log workouts and track progress' },
    { name: 'Sleep', slug: 'sleep', icon: 'M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z', description: 'Monitor sleep quality and patterns' }
];
</script>
