<template>
    <section id="trackers" class="relative py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <div class="inline-flex items-center space-x-2 bg-amber-100 dark:bg-amber-900/30 px-4 py-2 rounded-full mb-6">
                    <svg class="w-5 h-5 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    <span class="text-sm font-semibold text-amber-800 dark:text-amber-300">8+ Life Tracking Systems</span>
                </div>
                <h2 class="text-4xl md:text-6xl font-bold text-zinc-900 dark:text-white mb-4">
                    Track Everything That <span class="bg-gradient-to-r from-amber-700 to-amber-900 dark:from-amber-500 dark:to-amber-700 bg-clip-text text-transparent">Matters</span>
                </h2>
                <p class="text-lg text-zinc-600 dark:text-zinc-400 max-w-2xl mx-auto">
                    From finances to fitness, build discipline through comprehensive data tracking across all areas of your life
                </p>
            </div>

            <!-- Featured Tracker - Budget -->
            <div class="mb-12">
                <Link
                    href="/trackers/budget-tracker"
                    class="group relative bg-gradient-to-br from-amber-50 to-orange-50 dark:from-amber-950/50 dark:to-orange-950/50 border-2 border-amber-200 dark:border-amber-800 rounded-3xl p-8 md:p-10 hover:border-amber-400 dark:hover:border-amber-600 transition-all duration-300 hover:shadow-2xl hover:shadow-amber-500/20 hover:-translate-y-1 cursor-pointer overflow-hidden block"
                >
                    <!-- Popular Badge -->
                    <div class="absolute top-6 right-6 z-10">
                        <div class="flex items-center space-x-2 bg-amber-600 dark:bg-amber-500 px-4 py-2 rounded-full shadow-lg">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <span class="text-sm font-bold text-white">Most Popular</span>
                        </div>
                    </div>

                    <!-- Background Decoration -->
                    <div class="absolute inset-0 opacity-10 dark:opacity-5">
                        <svg class="absolute right-0 bottom-0 w-64 h-64" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                            <path fill="#F59E0B" d="M45.7,-59.8C58.9,-50.6,69.2,-36.4,73.7,-20.5C78.2,-4.6,76.9,12.9,69.8,27.1C62.7,41.3,49.8,52.2,35.6,59.4C21.4,66.6,5.9,70.1,-10.1,68.8C-26.1,67.5,-42.6,61.4,-54.9,51.1C-67.2,40.8,-75.3,26.3,-77.1,11.1C-78.9,-4.1,-74.4,-20,-65.3,-33.4C-56.2,-46.8,-42.5,-57.7,-27.8,-66.4C-13.1,-75.1,2.6,-81.6,18.4,-80.9C34.2,-80.2,32.5,-69,45.7,-59.8Z" transform="translate(100 100)" />
                        </svg>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 relative z-10">
                        <!-- Left Side - Content -->
                        <div class="flex flex-col justify-center">
                            <div class="flex items-center space-x-3 mb-4">
                                <div class="w-16 h-16 bg-gradient-to-br from-amber-600 to-amber-800 dark:from-amber-500 dark:to-amber-700 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-3xl font-bold text-zinc-900 dark:text-white">Budget Tracker</h3>
                                    <p class="text-sm text-amber-700 dark:text-amber-400 font-medium">Complete Financial Management</p>
                                </div>
                            </div>

                            <p class="text-zinc-700 dark:text-zinc-300 mb-6 text-lg leading-relaxed">
                                Master your finances with comprehensive income and expense tracking, smart budgets, custom categories, and powerful insights
                            </p>

                            <!-- Features List -->
                            <div class="grid grid-cols-2 gap-3 mb-6">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-5 h-5 text-green-600 dark:text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <span class="text-sm text-zinc-700 dark:text-zinc-300 font-medium">Smart Budgets</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <svg class="w-5 h-5 text-green-600 dark:text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <span class="text-sm text-zinc-700 dark:text-zinc-300 font-medium">Alerts & Reports</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <svg class="w-5 h-5 text-green-600 dark:text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <span class="text-sm text-zinc-700 dark:text-zinc-300 font-medium">Categories</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <svg class="w-5 h-5 text-green-600 dark:text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <span class="text-sm text-zinc-700 dark:text-zinc-300 font-medium">Export Data</span>
                                </div>
                            </div>

                            <!-- CTA Button -->
                            <div class="flex items-center space-x-3">
                                <span class="inline-flex items-center space-x-2 text-amber-700 dark:text-amber-400 font-semibold group-hover:translate-x-2 transition-transform">
                                    <span>Learn More & Explore Features</span>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                    </svg>
                                </span>
                            </div>
                        </div>

                        <!-- Right Side - Stats -->
                        <div class="flex items-center justify-center">
                            <div class="grid grid-cols-2 gap-4 w-full max-w-sm">
                                <div class="bg-white dark:bg-zinc-900 rounded-xl p-5 shadow-lg border border-zinc-200 dark:border-zinc-800">
                                    <div class="text-3xl font-bold text-amber-600 dark:text-amber-500 mb-1">7</div>
                                    <div class="text-sm text-zinc-600 dark:text-zinc-400">Core Features</div>
                                </div>
                                <div class="bg-white dark:bg-zinc-900 rounded-xl p-5 shadow-lg border border-zinc-200 dark:border-zinc-800">
                                    <div class="text-3xl font-bold text-green-600 dark:text-green-500 mb-1">∞</div>
                                    <div class="text-sm text-zinc-600 dark:text-zinc-400">Transactions</div>
                                </div>
                                <div class="bg-white dark:bg-zinc-900 rounded-xl p-5 shadow-lg border border-zinc-200 dark:border-zinc-800">
                                    <div class="text-3xl font-bold text-blue-600 dark:text-blue-500 mb-1">30+</div>
                                    <div class="text-sm text-zinc-600 dark:text-zinc-400">Categories</div>
                                </div>
                                <div class="bg-white dark:bg-zinc-900 rounded-xl p-5 shadow-lg border border-zinc-200 dark:border-zinc-800">
                                    <div class="text-3xl font-bold text-purple-600 dark:text-purple-500 mb-1">2</div>
                                    <div class="text-sm text-zinc-600 dark:text-zinc-400">Export Formats</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </Link>
            </div>

            <!-- Other Trackers Grid -->
            <div class="mb-8">
                <h3 class="text-2xl font-bold text-zinc-900 dark:text-white mb-6">More Trackers</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <Link
                        v-for="tracker in otherTrackers"
                        :key="tracker.slug"
                        :href="`/coming-soon/${tracker.slug}`"
                        class="group relative bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-2xl p-6 hover:border-amber-500 dark:hover:border-amber-600 transition-all duration-300 hover:shadow-xl hover:shadow-amber-900/10 dark:hover:shadow-amber-600/10 hover:-translate-y-1 cursor-pointer overflow-hidden"
                    >
                        <!-- Badge if applicable -->
                        <div v-if="tracker.badge" class="absolute top-4 right-4">
                            <span :class="[
                                'text-xs font-bold px-2 py-1 rounded-full',
                                tracker.badge === 'New' ? 'bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400' : 'bg-zinc-100 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-400'
                            ]">
                                {{ tracker.badge }}
                            </span>
                        </div>

                        <!-- Icon -->
                        <div :class="[
                            'w-12 h-12 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform shadow-md',
                            tracker.color
                        ]">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="tracker.icon"/>
                            </svg>
                        </div>

                        <!-- Content -->
                        <h4 class="text-lg font-bold text-zinc-900 dark:text-white mb-2 group-hover:text-amber-700 dark:group-hover:text-amber-500 transition-colors">
                            {{ tracker.name }}
                        </h4>
                        <p class="text-sm text-zinc-600 dark:text-zinc-400 leading-relaxed mb-4">
                            {{ tracker.description }}
                        </p>

                        <!-- Coming Soon Tag -->
                        <div class="flex items-center text-xs text-zinc-500 dark:text-zinc-500">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Coming Soon</span>
                        </div>
                    </Link>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="text-center mt-16 relative">
                <div class="absolute inset-0 bg-gradient-to-r from-amber-500/10 to-orange-500/10 dark:from-amber-600/5 dark:to-orange-600/5 rounded-3xl blur-3xl"></div>
                <div class="relative bg-white/50 dark:bg-zinc-900/50 backdrop-blur-sm border border-zinc-200 dark:border-zinc-800 rounded-3xl p-8 md:p-12">
                    <h3 class="text-3xl font-bold text-zinc-900 dark:text-white mb-4">
                        Ready to Start Tracking?
                    </h3>
                    <p class="text-zinc-600 dark:text-zinc-400 mb-8 max-w-2xl mx-auto">
                        Join thousands of users building discipline through comprehensive life tracking
                    </p>
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                        <Link
                            href="/trackers"
                            class="px-8 py-4 bg-gradient-to-r from-amber-700 to-amber-900 dark:from-amber-600 dark:to-amber-800 text-white font-semibold rounded-xl hover:shadow-xl hover:shadow-amber-900/30 dark:hover:shadow-amber-600/30 transition-all duration-300 hover:scale-105 inline-flex items-center space-x-2"
                        >
                            <span>View All Trackers</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </Link>
                        <Link
                            href="/pricing"
                            class="px-8 py-4 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white font-semibold rounded-xl border-2 border-zinc-300 dark:border-zinc-700 hover:border-amber-500 dark:hover:border-amber-600 transition-all duration-300 hover:scale-105"
                        >
                            View Pricing
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

const otherTrackers = [
    {
        name: 'Habit Tracker',
        slug: 'habit',
        icon: 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
        description: 'Build streaks and maintain consistency with daily habit tracking',
        color: 'bg-gradient-to-br from-green-500 to-emerald-600',
        badge: null
    },
    {
        name: 'Task Tracker',
        slug: 'task',
        icon: 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4',
        description: 'Organize and complete daily tasks with priority management',
        color: 'bg-gradient-to-br from-blue-500 to-cyan-600',
        badge: null
    },
    {
        name: 'Goals Tracker',
        slug: 'goals',
        icon: 'M13 10V3L4 14h7v7l9-11h-7z',
        description: 'Set and achieve your life goals with milestone tracking',
        color: 'bg-gradient-to-br from-purple-500 to-indigo-600',
        badge: null
    },
    {
        name: 'Food Tracker',
        slug: 'food',
        icon: 'M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z',
        description: 'Monitor nutrition and eating habits with meal logging',
        color: 'bg-gradient-to-br from-red-500 to-pink-600',
        badge: null
    },
    {
        name: 'Time Tracker',
        slug: 'time',
        icon: 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
        description: 'Optimize how you spend your time with detailed analytics',
        color: 'bg-gradient-to-br from-indigo-500 to-blue-600',
        badge: null
    },
    {
        name: 'Gym Tracker',
        slug: 'gym',
        icon: 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z',
        description: 'Log workouts and track progress with exercise tracking',
        color: 'bg-gradient-to-br from-orange-500 to-red-600',
        badge: 'New'
    },
    {
        name: 'Sleep Tracker',
        slug: 'sleep',
        icon: 'M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z',
        description: 'Monitor sleep quality and patterns for better rest',
        color: 'bg-gradient-to-br from-purple-500 to-violet-600',
        badge: null
    }
];
</script>
