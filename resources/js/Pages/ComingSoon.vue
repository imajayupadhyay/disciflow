<template>
    <Head>
        <title>{{ tracker ? `${tracker} Tracker` : 'Feature' }} Coming Soon | Disciflow</title>
        <meta name="description" :content="`${tracker ? tracker + ' tracker is' : 'This feature is'} currently under development. We're crafting something exceptional with powerful features, intuitive design, and comprehensive insights for your life tracking journey.`" />
        <meta name="keywords" :content="`coming soon, ${tracker ? tracker.toLowerCase() + ' tracker,' : ''} disciflow features, under development, new features, life tracking, upcoming trackers`" />

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website" />
        <meta property="og:title" :content="`${tracker ? tracker + ' Tracker' : 'Feature'} Coming Soon`" />
        <meta property="og:description" :content="`${tracker ? tracker + ' tracker is' : 'This feature is'} currently under development. Stay tuned for powerful tracking capabilities.`" />
        <meta property="og:site_name" content="Disciflow" />

        <!-- Twitter Card -->
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:title" :content="`${tracker ? tracker + ' Tracker' : 'Feature'} Coming Soon`" />
        <meta name="twitter:description" :content="`${tracker ? tracker + ' tracker is' : 'This feature is'} currently under development. Stay tuned for powerful tracking capabilities.`" />

        <!-- Additional SEO Tags -->
        <meta name="robots" content="noindex, follow" />
        <meta name="author" content="Disciflow" />
    </Head>

    <div class="min-h-screen bg-white dark:bg-black flex items-center justify-center relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 pointer-events-none">
            <svg class="absolute inset-0 w-full h-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="grid-coming-soon" width="32" height="32" patternUnits="userSpaceOnUse">
                        <path d="M 32 0 L 0 0 0 32" fill="none" stroke="currentColor" class="text-zinc-200/30 dark:text-zinc-800/30" stroke-width="0.5"/>
                    </pattern>
                    <linearGradient id="gradient-coming-soon" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" class="text-amber-500/10 dark:text-amber-600/5" style="stop-color:currentColor"/>
                        <stop offset="100%" class="text-transparent" style="stop-color:currentColor"/>
                    </linearGradient>
                    <radialGradient id="radial-coming-soon-1" cx="30%" cy="20%">
                        <stop offset="0%" class="text-amber-500/20 dark:text-amber-600/10" style="stop-color:currentColor"/>
                        <stop offset="100%" class="text-transparent" style="stop-color:currentColor"/>
                    </radialGradient>
                    <radialGradient id="radial-coming-soon-2" cx="70%" cy="80%">
                        <stop offset="0%" class="text-amber-500/15 dark:text-amber-600/8" style="stop-color:currentColor"/>
                        <stop offset="100%" class="text-transparent" style="stop-color:currentColor"/>
                    </radialGradient>
                </defs>
                <rect width="100%" height="100%" fill="url(#grid-coming-soon)" />
                <rect width="100%" height="100%" fill="url(#gradient-coming-soon)" />
                <circle cx="30%" cy="20%" r="300" fill="url(#radial-coming-soon-1)" />
                <circle cx="70%" cy="80%" r="400" fill="url(#radial-coming-soon-2)" />
            </svg>
            <!-- Floating Circles -->
            <div class="absolute top-20 left-10 w-32 h-32 bg-amber-500/5 dark:bg-amber-600/5 rounded-full blur-3xl"></div>
            <div class="absolute top-40 right-20 w-48 h-48 bg-amber-500/5 dark:bg-amber-600/5 rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 left-1/4 w-40 h-40 bg-amber-500/5 dark:bg-amber-600/5 rounded-full blur-3xl"></div>
            <div class="absolute bottom-40 right-1/3 w-56 h-56 bg-amber-500/5 dark:bg-amber-600/5 rounded-full blur-3xl"></div>
        </div>

        <!-- Content -->
        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <!-- Icon -->
            <div class="flex justify-center mb-8">
                <div class="relative">
                    <div class="w-32 h-32 bg-gradient-to-br from-amber-600 to-amber-800 dark:from-amber-500 dark:to-amber-700 rounded-3xl flex items-center justify-center shadow-2xl shadow-amber-900/30 dark:shadow-amber-600/30 transform hover:scale-110 transition-transform duration-300">
                        <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <!-- Pulse Animation -->
                    <div class="absolute inset-0 w-32 h-32 bg-amber-600/20 rounded-3xl animate-ping"></div>
                </div>
            </div>

            <!-- Heading -->
            <h1 class="text-5xl md:text-7xl font-bold text-zinc-900 dark:text-white mb-6">
                Coming <span class="bg-gradient-to-r from-amber-700 to-amber-900 dark:from-amber-400 dark:to-amber-600 bg-clip-text text-transparent">Soon</span>
            </h1>

            <!-- Tracker Name (if provided) -->
            <p v-if="tracker" class="text-2xl md:text-3xl font-semibold text-zinc-700 dark:text-zinc-300 mb-4">
                {{ tracker }} Tracker
            </p>

            <!-- Description -->
            <p class="text-lg md:text-xl text-zinc-600 dark:text-zinc-400 mb-12 max-w-2xl mx-auto leading-relaxed">
                We're crafting something exceptional for you. This feature is under development and will be available soon. Stay tuned!
            </p>

            <!-- Feature Highlights -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div class="bg-white/50 dark:bg-zinc-900/50 backdrop-blur-sm border border-zinc-200 dark:border-zinc-800 rounded-2xl p-6">
                    <div class="w-12 h-12 bg-amber-100 dark:bg-amber-900/30 rounded-xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-amber-600 dark:text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-sm font-bold text-zinc-900 dark:text-white mb-2">Powerful Features</h3>
                    <p class="text-xs text-zinc-600 dark:text-zinc-400">Advanced tracking capabilities designed for your success</p>
                </div>

                <div class="bg-white/50 dark:bg-zinc-900/50 backdrop-blur-sm border border-zinc-200 dark:border-zinc-800 rounded-2xl p-6">
                    <div class="w-12 h-12 bg-amber-100 dark:bg-amber-900/30 rounded-xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-amber-600 dark:text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-sm font-bold text-zinc-900 dark:text-white mb-2">Intuitive Design</h3>
                    <p class="text-xs text-zinc-600 dark:text-zinc-400">Beautiful interface that makes tracking effortless</p>
                </div>

                <div class="bg-white/50 dark:bg-zinc-900/50 backdrop-blur-sm border border-zinc-200 dark:border-zinc-800 rounded-2xl p-6">
                    <div class="w-12 h-12 bg-amber-100 dark:bg-amber-900/30 rounded-xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-amber-600 dark:text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"/>
                        </svg>
                    </div>
                    <h3 class="text-sm font-bold text-zinc-900 dark:text-white mb-2">Insights & Analytics</h3>
                    <p class="text-xs text-zinc-600 dark:text-zinc-400">Data-driven insights to help you improve</p>
                </div>
            </div>

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <Link
                    href="/"
                    class="px-8 py-4 bg-gradient-to-r from-amber-600 to-amber-800 dark:from-amber-500 dark:to-amber-700 text-white font-semibold rounded-xl hover:shadow-xl hover:shadow-amber-900/30 dark:hover:shadow-amber-600/30 transition-all duration-300 hover:scale-105"
                >
                    Back to Home
                </Link>
                <Link
                    href="/trackers"
                    class="px-8 py-4 bg-white dark:bg-zinc-900 border-2 border-zinc-300 dark:border-zinc-700 text-zinc-900 dark:text-white font-semibold rounded-xl hover:border-amber-600 dark:hover:border-amber-500 transition-all duration-300 hover:scale-105"
                >
                    Explore Other Trackers
                </Link>
            </div>

            <!-- Progress Indicator -->
            <div class="mt-16">
                <p class="text-sm text-zinc-500 dark:text-zinc-500 mb-4">Development Progress</p>
                <div class="max-w-md mx-auto bg-zinc-200 dark:bg-zinc-800 rounded-full h-3 overflow-hidden">
                    <div class="bg-gradient-to-r from-amber-600 to-amber-800 dark:from-amber-500 dark:to-amber-700 h-full rounded-full animate-pulse" style="width: 65%"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    tracker: {
        type: String,
        default: null
    }
});
</script>

<style scoped>
@keyframes ping {
    75%, 100% {
        transform: scale(1.5);
        opacity: 0;
    }
}

.animate-ping {
    animation: ping 2s cubic-bezier(0, 0, 0.2, 1) infinite;
}

@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.7;
    }
}

.animate-pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}
</style>
