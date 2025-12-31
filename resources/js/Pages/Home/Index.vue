<template>
    <div class="min-h-screen flex flex-col bg-white dark:bg-black transition-colors duration-500 relative overflow-hidden">
        <!-- Background SVG Pattern -->
        <div class="absolute inset-0 pointer-events-none">
            <!-- Grid Pattern -->
            <svg class="absolute inset-0 w-full h-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="home-grid" width="32" height="32" patternUnits="userSpaceOnUse">
                        <path d="M 32 0 L 0 0 0 32" fill="none" stroke="currentColor" class="text-zinc-200/30 dark:text-zinc-800/30" stroke-width="0.5"/>
                    </pattern>
                    <linearGradient id="home-gradient1" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" class="text-amber-500/10 dark:text-amber-600/5" style="stop-color:currentColor"/>
                        <stop offset="100%" class="text-transparent" style="stop-color:currentColor"/>
                    </linearGradient>
                    <radialGradient id="home-radial1" cx="30%" cy="20%">
                        <stop offset="0%" class="text-amber-500/20 dark:text-amber-600/10" style="stop-color:currentColor"/>
                        <stop offset="100%" class="text-transparent" style="stop-color:currentColor"/>
                    </radialGradient>
                    <radialGradient id="home-radial2" cx="70%" cy="80%">
                        <stop offset="0%" class="text-amber-500/15 dark:text-amber-600/8" style="stop-color:currentColor"/>
                        <stop offset="100%" class="text-transparent" style="stop-color:currentColor"/>
                    </radialGradient>
                </defs>
                <rect width="100%" height="100%" fill="url(#home-grid)" />
                <rect width="100%" height="100%" fill="url(#home-gradient1)" />
                <circle cx="30%" cy="20%" r="300" fill="url(#home-radial1)" />
                <circle cx="70%" cy="80%" r="400" fill="url(#home-radial2)" />
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

        <main class="flex-grow relative z-10">
            <Hero />
            <Trackers />
        </main>

        <div class="relative z-10">
            <Footer />
        </div>
    </div>
</template>

<script setup>
import Header from '@/Components/Layout/Header.vue';
import Footer from '@/Components/Layout/Footer.vue';
import Hero from './Hero.vue';
import Trackers from './Trackers.vue';
</script>
