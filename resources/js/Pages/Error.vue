<template>
    <Head>
        <title>{{ title }} - {{ status }} Error | Disciflow</title>
        <meta name="description" :content="description" />
        <meta name="keywords" content="error page, page not found, 404, server error, disciflow" />

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website" />
        <meta property="og:title" :content="`${title} - ${status} Error`" />
        <meta property="og:description" :content="description" />
        <meta property="og:site_name" content="Disciflow" />

        <!-- Twitter Card -->
        <meta name="twitter:card" content="summary" />
        <meta name="twitter:title" :content="`${title} - ${status} Error`" />
        <meta name="twitter:description" :content="description" />

        <!-- Additional SEO Tags -->
        <meta name="robots" content="noindex, follow" />
        <meta name="author" content="Disciflow" />
    </Head>

    <div class="min-h-screen bg-white dark:bg-black flex items-center justify-center relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 pointer-events-none">
            <svg class="absolute inset-0 w-full h-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="grid-error" width="32" height="32" patternUnits="userSpaceOnUse">
                        <path d="M 32 0 L 0 0 0 32" fill="none" stroke="currentColor" class="text-zinc-200/30 dark:text-zinc-800/30" stroke-width="0.5"/>
                    </pattern>
                    <linearGradient id="gradient-error" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" class="text-amber-500/10 dark:text-amber-600/5" style="stop-color:currentColor"/>
                        <stop offset="100%" class="text-transparent" style="stop-color:currentColor"/>
                    </linearGradient>
                    <radialGradient id="radial-error-1" cx="30%" cy="20%">
                        <stop offset="0%" class="text-amber-500/20 dark:text-amber-600/10" style="stop-color:currentColor"/>
                        <stop offset="100%" class="text-transparent" style="stop-color:currentColor"/>
                    </radialGradient>
                    <radialGradient id="radial-error-2" cx="70%" cy="80%">
                        <stop offset="0%" class="text-amber-500/15 dark:text-amber-600/8" style="stop-color:currentColor"/>
                        <stop offset="100%" class="text-transparent" style="stop-color:currentColor"/>
                    </radialGradient>
                </defs>
                <rect width="100%" height="100%" fill="url(#grid-error)" />
                <rect width="100%" height="100%" fill="url(#gradient-error)" />
                <circle cx="30%" cy="20%" r="300" fill="url(#radial-error-1)" />
                <circle cx="70%" cy="80%" r="400" fill="url(#radial-error-2)" />
            </svg>
            <!-- Floating Circles -->
            <div class="absolute top-20 left-10 w-32 h-32 bg-amber-500/5 dark:bg-amber-600/5 rounded-full blur-3xl"></div>
            <div class="absolute top-40 right-20 w-48 h-48 bg-amber-500/5 dark:bg-amber-600/5 rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 left-1/4 w-40 h-40 bg-amber-500/5 dark:bg-amber-600/5 rounded-full blur-3xl"></div>
            <div class="absolute bottom-40 right-1/3 w-56 h-56 bg-amber-500/5 dark:bg-amber-600/5 rounded-full blur-3xl"></div>
        </div>

        <!-- Content -->
        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <!-- 404 Number -->
            <div class="mb-8">
                <h1 class="text-9xl md:text-[12rem] font-bold bg-gradient-to-r from-amber-700 to-amber-900 dark:from-amber-400 dark:to-amber-600 bg-clip-text text-transparent leading-none">
                    {{ status }}
                </h1>
            </div>

            <!-- Icon -->
            <div class="flex justify-center mb-8">
                <div class="w-24 h-24 bg-gradient-to-br from-amber-600 to-amber-800 dark:from-amber-500 dark:to-amber-700 rounded-2xl flex items-center justify-center shadow-xl shadow-amber-900/30 dark:shadow-amber-600/30">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>

            <!-- Heading -->
            <h2 class="text-4xl md:text-5xl font-bold text-zinc-900 dark:text-white mb-6">
                {{ title }}
            </h2>

            <!-- Description -->
            <p class="text-lg md:text-xl text-zinc-600 dark:text-zinc-400 mb-12 max-w-2xl mx-auto leading-relaxed">
                {{ description }}
            </p>

            <!-- Quick Links -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-12 max-w-3xl mx-auto">
                <Link
                    href="/"
                    class="group bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl p-6 hover:border-amber-600 dark:hover:border-amber-500 transition-all duration-300 hover:scale-105"
                >
                    <svg class="w-8 h-8 text-amber-600 dark:text-amber-500 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <h3 class="text-sm font-semibold text-zinc-900 dark:text-white">Home</h3>
                </Link>

                <Link
                    href="/trackers"
                    class="group bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl p-6 hover:border-amber-600 dark:hover:border-amber-500 transition-all duration-300 hover:scale-105"
                >
                    <svg class="w-8 h-8 text-amber-600 dark:text-amber-500 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    <h3 class="text-sm font-semibold text-zinc-900 dark:text-white">Trackers</h3>
                </Link>

                <Link
                    href="/support"
                    class="group bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl p-6 hover:border-amber-600 dark:hover:border-amber-500 transition-all duration-300 hover:scale-105"
                >
                    <svg class="w-8 h-8 text-amber-600 dark:text-amber-500 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    <h3 class="text-sm font-semibold text-zinc-900 dark:text-white">Support</h3>
                </Link>
            </div>

            <!-- CTA Button -->
            <Link
                href="/"
                class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-amber-600 to-amber-800 dark:from-amber-500 dark:to-amber-700 text-white font-semibold rounded-xl hover:shadow-xl hover:shadow-amber-900/30 dark:hover:shadow-amber-600/30 transition-all duration-300 hover:scale-105"
            >
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Take Me Home
            </Link>
        </div>
    </div>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    status: {
        type: Number,
        required: true
    }
});

const title = computed(() => {
    const titles = {
        503: 'Service Unavailable',
        500: 'Server Error',
        404: 'Page Not Found',
        403: 'Forbidden'
    };
    return titles[props.status] || 'Error';
});

const description = computed(() => {
    const descriptions = {
        503: 'Sorry, we are doing some maintenance. Please check back soon.',
        500: 'Whoops, something went wrong on our servers.',
        404: 'Sorry, the page you are looking for could not be found. It might have been moved or deleted.',
        403: 'Sorry, you are forbidden from accessing this page.'
    };
    return descriptions[props.status] || 'An error occurred.';
});
</script>
