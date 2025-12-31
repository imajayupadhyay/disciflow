<template>
    <Card hover padding="lg" @click="handleClick">
        <div class="flex flex-col h-full">
            <!-- Header -->
            <div class="flex items-start justify-between mb-6">
                <div :class="[
                    'w-14 h-14 rounded-xl flex items-center justify-center transition-transform group-hover:scale-110',
                    iconBgClass
                ]">
                    <svg class="w-7 h-7" :class="iconColorClass" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path v-if="icon === 'budget'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        <path v-else-if="icon === 'habit'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        <path v-else-if="icon === 'tasks'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        <path v-else-if="icon === 'goals'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        <path v-else-if="icon === 'food'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        <path v-else-if="icon === 'time'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        <path v-else-if="icon === 'gym'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        <path v-else-if="icon === 'sleep'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>

                <Badge v-if="badge" :variant="badgeVariant">
                    {{ badge }}
                </Badge>
            </div>

            <!-- Content -->
            <div class="flex-grow">
                <h3 class="text-xl font-bold text-zinc-900 dark:text-white mb-2">
                    {{ title }}
                </h3>
                <p class="text-sm text-zinc-600 dark:text-zinc-400 leading-relaxed mb-4">
                    {{ description }}
                </p>

                <!-- Stats -->
                <div v-if="stats && stats.length" class="grid grid-cols-2 gap-3 mb-4">
                    <div v-for="(stat, index) in stats" :key="index" class="bg-zinc-50 dark:bg-zinc-800/50 rounded-lg p-3">
                        <div class="text-xs text-zinc-500 dark:text-zinc-400 mb-1">{{ stat.label }}</div>
                        <div class="text-lg font-bold text-zinc-900 dark:text-white">{{ stat.value }}</div>
                    </div>
                </div>

                <!-- Features -->
                <div v-if="features && features.length" class="space-y-2">
                    <div v-for="(feature, index) in features" :key="index" class="flex items-center text-sm text-zinc-600 dark:text-zinc-400">
                        <svg class="w-4 h-4 mr-2 text-amber-600 dark:text-amber-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span>{{ feature }}</span>
                    </div>
                </div>
            </div>

            <!-- Footer/Action -->
            <div class="mt-6 pt-4 border-t border-zinc-200 dark:border-zinc-800">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-zinc-700 dark:text-zinc-300">
                        {{ actionText }}
                    </span>
                    <svg class="w-5 h-5 text-amber-600 dark:text-amber-500 transform transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </div>
            </div>
        </div>
    </Card>
</template>

<script setup>
import { computed } from 'vue';
import Card from '@/Components/UI/Card.vue';
import Badge from '@/Components/UI/Badge.vue';

const props = defineProps({
    title: {
        type: String,
        required: true
    },
    description: {
        type: String,
        required: true
    },
    icon: {
        type: String,
        required: true
    },
    iconColor: {
        type: String,
        default: 'amber'
    },
    badge: {
        type: String,
        default: null
    },
    badgeVariant: {
        type: String,
        default: 'primary'
    },
    stats: {
        type: Array,
        default: () => []
    },
    features: {
        type: Array,
        default: () => []
    },
    actionText: {
        type: String,
        default: 'Start Tracking'
    },
    route: {
        type: String,
        default: null
    }
});

const emit = defineEmits(['click']);

const iconColorClass = computed(() => {
    const colors = {
        amber: 'text-amber-700 dark:text-amber-500',
        green: 'text-green-700 dark:text-green-500',
        blue: 'text-blue-700 dark:text-blue-500',
        purple: 'text-purple-700 dark:text-purple-500',
        red: 'text-red-700 dark:text-red-500',
        indigo: 'text-indigo-700 dark:text-indigo-500'
    };

    return colors[props.iconColor] || colors.amber;
});

const iconBgClass = computed(() => {
    const colors = {
        amber: 'bg-amber-100 dark:bg-amber-900/30',
        green: 'bg-green-100 dark:bg-green-900/30',
        blue: 'bg-blue-100 dark:bg-blue-900/30',
        purple: 'bg-purple-100 dark:bg-purple-900/30',
        red: 'bg-red-100 dark:bg-red-900/30',
        indigo: 'bg-indigo-100 dark:bg-indigo-900/30'
    };

    return colors[props.iconColor] || colors.amber;
});

const handleClick = () => {
    emit('click');
    if (props.route) {
        // Navigate to route when implemented
        console.log('Navigate to:', props.route);
    }
};
</script>
