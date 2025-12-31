<template>
    <div class="min-h-screen flex flex-col bg-white dark:bg-black transition-colors duration-500 relative overflow-hidden">
        <!-- Background SVG Pattern -->
        <div class="absolute inset-0 pointer-events-none">
            <!-- Grid Pattern -->
            <svg class="absolute inset-0 w-full h-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="grid" width="32" height="32" patternUnits="userSpaceOnUse">
                        <path d="M 32 0 L 0 0 0 32" fill="none" stroke="currentColor" class="text-zinc-200/30 dark:text-zinc-800/30" stroke-width="0.5"/>
                    </pattern>
                    <linearGradient id="gradient1" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" class="text-amber-500/10 dark:text-amber-600/5" style="stop-color:currentColor"/>
                        <stop offset="100%" class="text-transparent" style="stop-color:currentColor"/>
                    </linearGradient>
                    <radialGradient id="radial1" cx="30%" cy="20%">
                        <stop offset="0%" class="text-amber-500/20 dark:text-amber-600/10" style="stop-color:currentColor"/>
                        <stop offset="100%" class="text-transparent" style="stop-color:currentColor"/>
                    </radialGradient>
                    <radialGradient id="radial2" cx="70%" cy="80%">
                        <stop offset="0%" class="text-amber-500/15 dark:text-amber-600/8" style="stop-color:currentColor"/>
                        <stop offset="100%" class="text-transparent" style="stop-color:currentColor"/>
                    </radialGradient>
                </defs>
                <rect width="100%" height="100%" fill="url(#grid)" />
                <rect width="100%" height="100%" fill="url(#gradient1)" />
                <circle cx="30%" cy="20%" r="300" fill="url(#radial1)" />
                <circle cx="70%" cy="80%" r="400" fill="url(#radial2)" />
            </svg>

            <!-- Floating Circles -->
            <div class="absolute top-20 left-10 w-32 h-32 bg-amber-500/5 dark:bg-amber-600/5 rounded-full blur-3xl"></div>
            <div class="absolute top-40 right-20 w-48 h-48 bg-amber-500/5 dark:bg-amber-600/5 rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 left-1/4 w-40 h-40 bg-amber-500/5 dark:bg-amber-600/5 rounded-full blur-3xl"></div>
            <div class="absolute bottom-40 right-1/3 w-56 h-56 bg-amber-500/5 dark:bg-amber-600/5 rounded-full blur-3xl"></div>
        </div>

        <div class="relative z-50">
            <Header />
        </div>

        <main class="flex-grow pt-32 pb-16 relative z-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Page Header -->
                <div class="mb-12">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-amber-600 to-amber-800 dark:from-amber-500 dark:to-amber-700 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <h1 class="text-4xl md:text-5xl font-bold text-zinc-900 dark:text-white">
                            Life Trackers
                        </h1>
                    </div>
                    <p class="text-lg text-zinc-600 dark:text-zinc-400 max-w-3xl">
                        Track every aspect of your life with precision. Build discipline through consistent data collection and actionable insights.
                    </p>
                </div>

                <!-- Category Filter -->
                <div class="flex items-center space-x-2 mb-8 overflow-x-auto pb-2">
                    <button
                        v-for="category in categories"
                        :key="category.id"
                        @click="selectedCategory = category.id"
                        :class="[
                            'px-4 py-2 rounded-lg font-medium text-sm whitespace-nowrap transition-all duration-200',
                            selectedCategory === category.id
                                ? 'bg-amber-600 dark:bg-amber-700 text-white shadow-lg'
                                : 'bg-zinc-100 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300 hover:bg-zinc-200 dark:hover:bg-zinc-700'
                        ]"
                    >
                        {{ category.name }}
                    </button>
                </div>

                <!-- Trackers Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <TrackerCard
                        v-for="tracker in filteredTrackers"
                        :key="tracker.id"
                        :title="tracker.title"
                        :description="tracker.description"
                        :icon="tracker.icon"
                        :icon-color="tracker.iconColor"
                        :badge="tracker.badge"
                        :badge-variant="tracker.badgeVariant"
                        :stats="tracker.stats"
                        :features="tracker.features"
                        :action-text="tracker.actionText"
                        :route="tracker.route"
                        @click="handleTrackerClick(tracker)"
                    />
                </div>

                <!-- Empty State -->
                <div v-if="filteredTrackers.length === 0" class="text-center py-16">
                    <div class="w-16 h-16 bg-zinc-100 dark:bg-zinc-800 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M12 12h.01M12 12h.01M12 12h.01M12 20h.01M12 20h.01M12 20h.01"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-zinc-900 dark:text-white mb-2">No trackers found</h3>
                    <p class="text-zinc-600 dark:text-zinc-400">Try selecting a different category</p>
                </div>
            </div>
        </main>

        <div class="relative z-10">
            <Footer />
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import Header from '@/Components/Layout/Header.vue';
import Footer from '@/Components/Layout/Footer.vue';
import TrackerCard from './TrackerCard.vue';

const selectedCategory = ref('all');

const categories = [
    { id: 'all', name: 'All Trackers' },
    { id: 'health', name: 'Health & Fitness' },
    { id: 'finance', name: 'Finance' },
    { id: 'productivity', name: 'Productivity' },
    { id: 'personal', name: 'Personal Growth' }
];

const trackers = [
    {
        id: 'budget',
        title: 'Budget Tracker',
        description: 'Track income, expenses, and financial goals with detailed categorization',
        icon: 'budget',
        iconColor: 'amber',
        badge: 'Popular',
        badgeVariant: 'primary',
        category: 'finance',
        stats: [
            { label: 'This Month', value: '$2,450' },
            { label: 'Saved', value: '32%' }
        ],
        features: [
            'Income tracking',
            'Expense categorization',
            'Budget limits',
            'Savings goals'
        ],
        actionText: 'Manage Budget',
        route: '/trackers/budget'
    },
    {
        id: 'habit',
        title: 'Habit Tracker',
        description: 'Build consistent habits with daily check-ins and streak tracking',
        icon: 'habit',
        iconColor: 'green',
        badge: 'Most Used',
        badgeVariant: 'success',
        category: 'personal',
        stats: [
            { label: 'Active Habits', value: '8' },
            { label: 'Best Streak', value: '45 days' }
        ],
        features: [
            'Daily check-ins',
            'Streak tracking',
            'Habit chains',
            'Success rate metrics'
        ],
        actionText: 'Track Habits',
        route: '/trackers/habits'
    },
    {
        id: 'tasks',
        title: 'Task Tracker',
        description: 'Organize daily tasks with priority levels and completion analytics',
        icon: 'tasks',
        iconColor: 'blue',
        category: 'productivity',
        stats: [
            { label: 'Today', value: '12' },
            { label: 'Completed', value: '8' }
        ],
        features: [
            'Daily tasks',
            'Priority levels',
            'Project organization',
            'Completion analytics'
        ],
        actionText: 'Manage Tasks',
        route: '/trackers/tasks'
    },
    {
        id: 'goals',
        title: 'Goals Tracker',
        description: 'Set and achieve short-term and long-term goals with milestones',
        icon: 'goals',
        iconColor: 'purple',
        category: 'personal',
        stats: [
            { label: 'Active Goals', value: '5' },
            { label: 'Completed', value: '12' }
        ],
        features: [
            'Short & long-term goals',
            'Progress milestones',
            'Achievement tracking',
            'Goal analytics'
        ],
        actionText: 'View Goals',
        route: '/trackers/goals'
    },
    {
        id: 'food',
        title: 'Food Tracker',
        description: 'Log meals and track nutrition with calorie and macro breakdown',
        icon: 'food',
        iconColor: 'red',
        category: 'health',
        stats: [
            { label: 'Today', value: '1,850 cal' },
            { label: 'Protein', value: '120g' }
        ],
        features: [
            'Meal logging',
            'Calorie tracking',
            'Macro breakdown',
            'Meal patterns'
        ],
        actionText: 'Log Meals',
        route: '/trackers/food'
    },
    {
        id: 'time',
        title: 'Time Tracker',
        description: 'Track time spent on activities and optimize productivity',
        icon: 'time',
        iconColor: 'indigo',
        category: 'productivity',
        stats: [
            { label: 'Today', value: '6.5h' },
            { label: 'Productive', value: '82%' }
        ],
        features: [
            'Time block tracking',
            'Activity categories',
            'Productivity metrics',
            'Time distribution'
        ],
        actionText: 'Track Time',
        route: '/trackers/time'
    },
    {
        id: 'gym',
        title: 'Gym Tracker',
        description: 'Log workouts, track progress, and monitor strength gains',
        icon: 'gym',
        iconColor: 'amber',
        badge: 'New',
        badgeVariant: 'info',
        category: 'health',
        stats: [
            { label: 'This Week', value: '4 days' },
            { label: 'Exercises', value: '28' }
        ],
        features: [
            'Workout logging',
            'Sets/reps/weight tracking',
            'Progress photos',
            'Strength progression'
        ],
        actionText: 'Log Workout',
        route: '/trackers/gym'
    },
    {
        id: 'sleep',
        title: 'Sleep Tracker',
        description: 'Monitor sleep quality, duration, and patterns for better rest',
        icon: 'sleep',
        iconColor: 'purple',
        category: 'health',
        stats: [
            { label: 'Last Night', value: '7.5h' },
            { label: 'Quality', value: '85%' }
        ],
        features: [
            'Sleep duration',
            'Quality rating',
            'Sleep consistency',
            'Pattern analysis'
        ],
        actionText: 'Track Sleep',
        route: '/trackers/sleep'
    }
];

const filteredTrackers = computed(() => {
    if (selectedCategory.value === 'all') {
        return trackers;
    }
    return trackers.filter(tracker => tracker.category === selectedCategory.value);
});

const handleTrackerClick = (tracker) => {
    console.log('Tracker clicked:', tracker.title);
    // TODO: Navigate to tracker page when routes are set up
};
</script>
