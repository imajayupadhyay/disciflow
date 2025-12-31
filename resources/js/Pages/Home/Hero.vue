<template>
    <section class="relative min-h-screen flex items-center overflow-hidden bg-gradient-to-br from-zinc-50 via-white to-amber-50/30 dark:from-zinc-950 dark:via-zinc-900 dark:to-zinc-900 pt-16 lg:pt-0">

        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-[0.03] dark:opacity-[0.02]">
            <div class="absolute inset-0" style="background-image: radial-gradient(circle at 1px 1px, rgb(161 98 7) 1px, transparent 0); background-size: 40px 40px;"></div>
        </div>

        <!-- Content Container -->
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16 lg:py-32">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-16 items-center">

                <!-- Left Content -->
                <div class="space-y-6 lg:space-y-8 animate-fade-in-left order-1">
                    <!-- Badge -->
                    <div class="inline-flex items-center space-x-2 bg-amber-100 dark:bg-amber-950/50 border border-amber-200 dark:border-amber-800/50 px-4 py-2 rounded-full">
                        <svg class="w-4 h-4 text-amber-600 dark:text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <span class="text-sm font-semibold text-amber-700 dark:text-amber-400">Transform Your Life</span>
                    </div>

                    <!-- Main Heading -->
                    <div class="space-y-3 lg:space-y-4">
                        <h1 class="text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-bold leading-tight">
                            <span class="block text-zinc-900 dark:text-white">Engineer Your</span>
                            <span class="block bg-gradient-to-r from-amber-700 via-amber-600 to-amber-800 dark:from-amber-500 dark:via-amber-400 dark:to-amber-600 bg-clip-text text-transparent min-h-[4rem] sm:min-h-[5rem] lg:min-h-[6rem] xl:min-h-[7rem]">
                                {{ displayedText }}<span class="typing-cursor">|</span>
                            </span>
                        </h1>
                        <p class="text-base sm:text-lg lg:text-xl text-zinc-600 dark:text-zinc-400 max-w-xl leading-relaxed">
                            Take control of your life with intelligent tracking, actionable insights, and science-backed discipline systems. Your personal growth deserves better than spreadsheets.
                        </p>
                    </div>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <button class="group relative px-8 py-4 bg-gradient-to-r from-amber-700 to-amber-900 dark:from-amber-600 dark:to-amber-800 text-white font-semibold rounded-xl overflow-hidden transition-all duration-300 hover:shadow-2xl hover:shadow-amber-900/30 dark:hover:shadow-amber-600/30 hover:scale-105">
                            <span class="relative z-10 flex items-center justify-center space-x-2">
                                <span>Get Started Free</span>
                                <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </span>
                        </button>
                        <button class="px-8 py-4 bg-white dark:bg-zinc-800 border-2 border-zinc-200 dark:border-zinc-700 text-zinc-900 dark:text-zinc-100 font-semibold rounded-xl hover:border-amber-600 dark:hover:border-amber-500 hover:bg-zinc-50 dark:hover:bg-zinc-700/50 transition-all duration-300 hover:scale-105">
                            Watch Demo
                        </button>
                    </div>

                    <!-- Trust Indicators -->
                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 sm:gap-8 pt-4">
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5 text-amber-600 dark:text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-sm font-medium text-zinc-600 dark:text-zinc-400">No credit card required</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5 text-amber-600 dark:text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-sm font-medium text-zinc-600 dark:text-zinc-400">Privacy-first</span>
                        </div>
                    </div>
                </div>

                <!-- Right Infographics -->
                <div class="relative h-auto lg:h-[600px] animate-fade-in-right order-2">
                    <!-- Main Card - Central Focus -->
                    <div class="relative lg:absolute lg:top-1/2 lg:left-1/2 lg:transform lg:-translate-x-1/2 lg:-translate-y-1/2 w-full max-w-md mx-auto lg:w-80 xl:w-96 bg-white dark:bg-zinc-800 rounded-2xl shadow-2xl border border-zinc-200 dark:border-zinc-700 p-6 z-20 lg:animate-float mb-8 lg:mb-0">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-bold text-zinc-900 dark:text-white">Today's Progress</h3>
                            <div class="px-3 py-1 bg-green-100 dark:bg-green-900/30 rounded-full">
                                <span class="text-sm font-semibold text-green-700 dark:text-green-400">On Track</span>
                            </div>
                        </div>

                        <!-- Progress Circle -->
                        <div class="flex justify-center my-6">
                            <div class="relative w-40 h-40">
                                <svg class="transform -rotate-90 w-40 h-40">
                                    <circle cx="80" cy="80" r="70" stroke="currentColor" stroke-width="12" fill="transparent" class="text-zinc-200 dark:text-zinc-700"/>
                                    <circle cx="80" cy="80" r="70" stroke="currentColor" stroke-width="12" fill="transparent" stroke-dasharray="439.6" stroke-dashoffset="88" class="text-amber-600 dark:text-amber-500 transition-all duration-1000" stroke-linecap="round"/>
                                </svg>
                                <div class="absolute inset-0 flex flex-col items-center justify-center">
                                    <span class="text-4xl font-bold text-zinc-900 dark:text-white">80%</span>
                                    <span class="text-sm text-zinc-600 dark:text-zinc-400">Complete</span>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Stats -->
                        <div class="grid grid-cols-3 gap-3">
                            <div class="text-center p-3 bg-zinc-50 dark:bg-zinc-900/50 rounded-xl">
                                <div class="text-2xl font-bold text-amber-600 dark:text-amber-500">6/8</div>
                                <div class="text-xs text-zinc-600 dark:text-zinc-400 mt-1">Tasks</div>
                            </div>
                            <div class="text-center p-3 bg-zinc-50 dark:bg-zinc-900/50 rounded-xl">
                                <div class="text-2xl font-bold text-amber-600 dark:text-amber-500">12</div>
                                <div class="text-xs text-zinc-600 dark:text-zinc-400 mt-1">Streak</div>
                            </div>
                            <div class="text-center p-3 bg-zinc-50 dark:bg-zinc-900/50 rounded-xl">
                                <div class="text-2xl font-bold text-amber-600 dark:text-amber-500">5h</div>
                                <div class="text-xs text-zinc-600 dark:text-zinc-400 mt-1">Focus</div>
                            </div>
                        </div>
                    </div>

                    <!-- Floating Metric Card - Top Left -->
                    <div class="absolute top-0 left-0 lg:left-8 w-48 bg-gradient-to-br from-amber-500 to-amber-700 rounded-xl shadow-lg p-4 z-10 animate-float-delayed hidden lg:block">
                        <div class="flex items-center space-x-2 mb-2">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-white font-semibold text-sm">Growth</span>
                        </div>
                        <div class="text-3xl font-bold text-white">+127%</div>
                        <div class="text-xs text-amber-100 mt-1">vs last month</div>
                    </div>

                    <!-- Floating Achievement Badge - Top Right -->
                    <div class="absolute top-12 right-0 lg:right-8 w-52 bg-white dark:bg-zinc-800 rounded-xl shadow-lg border border-zinc-200 dark:border-zinc-700 p-4 z-10 animate-float hidden lg:block" style="animation-delay: 0.5s;">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-gradient-to-br from-amber-400 to-amber-600 rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm font-bold text-zinc-900 dark:text-white">Consistency King</div>
                                <div class="text-xs text-zinc-600 dark:text-zinc-400">30 day streak unlocked!</div>
                            </div>
                        </div>
                    </div>

                    <!-- Floating Insight Card - Bottom Left -->
                    <div class="absolute bottom-0 left-0 lg:left-4 w-56 bg-white dark:bg-zinc-800 rounded-xl shadow-lg border border-zinc-200 dark:border-zinc-700 p-4 z-10 animate-float-delayed hidden lg:block" style="animation-delay: 1s;">
                        <div class="flex items-start space-x-3">
                            <div class="w-10 h-10 bg-amber-100 dark:bg-amber-900/30 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-amber-600 dark:text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <div class="text-xs font-semibold text-amber-600 dark:text-amber-500 mb-1">AI Insight</div>
                                <div class="text-sm text-zinc-700 dark:text-zinc-300">Your peak productivity is 9-11 AM</div>
                            </div>
                        </div>
                    </div>

                    <!-- Floating Habit Tracker - Bottom Right -->
                    <div class="absolute bottom-8 right-0 lg:right-4 w-44 bg-white dark:bg-zinc-800 rounded-xl shadow-lg border border-zinc-200 dark:border-zinc-700 p-4 z-10 animate-float hidden lg:block" style="animation-delay: 0.8s;">
                        <div class="text-xs font-semibold text-zinc-600 dark:text-zinc-400 mb-3">This Week</div>
                        <div class="flex justify-between items-end space-x-1">
                            <div class="flex flex-col items-center space-y-1">
                                <div class="w-6 h-16 bg-amber-200 dark:bg-amber-900/30 rounded-t"></div>
                                <span class="text-xs text-zinc-500">M</span>
                            </div>
                            <div class="flex flex-col items-center space-y-1">
                                <div class="w-6 h-20 bg-amber-300 dark:bg-amber-800/50 rounded-t"></div>
                                <span class="text-xs text-zinc-500">T</span>
                            </div>
                            <div class="flex flex-col items-center space-y-1">
                                <div class="w-6 h-24 bg-amber-400 dark:bg-amber-700/70 rounded-t"></div>
                                <span class="text-xs text-zinc-500">W</span>
                            </div>
                            <div class="flex flex-col items-center space-y-1">
                                <div class="w-6 h-20 bg-amber-500 dark:bg-amber-600/80 rounded-t"></div>
                                <span class="text-xs text-zinc-500">T</span>
                            </div>
                            <div class="flex flex-col items-center space-y-1">
                                <div class="w-6 h-28 bg-amber-600 dark:bg-amber-600 rounded-t"></div>
                                <span class="text-xs text-zinc-500">F</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <a href="#trackers">
                <svg class="w-6 h-6 text-zinc-400 dark:text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                </svg>
            </a>
        </div>
    </section>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';

const headlines = [
    'Best Self',
    'Dream Life',
    'Peak Performance',
    'True Potential',
    'Better Habits',
    'Daily Wins',
    'Strong Future',
    'Success Story'
];

const displayedText = ref('');
const currentHeadlineIndex = ref(0);
const currentCharIndex = ref(0);
const isDeleting = ref(false);
let typingTimeout = null;

const typeWriter = () => {
    const currentHeadline = headlines[currentHeadlineIndex.value];

    if (!isDeleting.value) {
        // Typing
        if (currentCharIndex.value < currentHeadline.length) {
            displayedText.value = currentHeadline.substring(0, currentCharIndex.value + 1);
            currentCharIndex.value++;
            typingTimeout = setTimeout(typeWriter, 100); // Typing speed
        } else {
            // Pause before deleting
            typingTimeout = setTimeout(() => {
                isDeleting.value = true;
                typeWriter();
            }, 2000); // Pause duration
        }
    } else {
        // Deleting
        if (currentCharIndex.value > 0) {
            displayedText.value = currentHeadline.substring(0, currentCharIndex.value - 1);
            currentCharIndex.value--;
            typingTimeout = setTimeout(typeWriter, 50); // Deleting speed (faster)
        } else {
            // Move to next headline
            isDeleting.value = false;
            currentHeadlineIndex.value = (currentHeadlineIndex.value + 1) % headlines.length;
            typingTimeout = setTimeout(typeWriter, 500); // Pause before next word
        }
    }
};

onMounted(() => {
    typeWriter();
});

onUnmounted(() => {
    if (typingTimeout) {
        clearTimeout(typingTimeout);
    }
});
</script>

<style scoped>
/* Typing Cursor Animation */
.typing-cursor {
    animation: blink 1s infinite;
    font-weight: 300;
}

@keyframes blink {
    0%, 50% {
        opacity: 1;
    }
    51%, 100% {
        opacity: 0;
    }
}

/* Float Animation for Cards */
@keyframes float {
    0%, 100% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-20px);
    }
}

@keyframes float-delayed {
    0%, 100% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-15px);
    }
}

/* Fade in from Left */
@keyframes fade-in-left {
    0% {
        opacity: 0;
        transform: translateX(-30px);
    }
    100% {
        opacity: 1;
        transform: translateX(0);
    }
}

/* Fade in from Right */
@keyframes fade-in-right {
    0% {
        opacity: 0;
        transform: translateX(30px);
    }
    100% {
        opacity: 1;
        transform: translateX(0);
    }
}

.animate-float {
    animation: float 6s ease-in-out infinite;
}

.animate-float-delayed {
    animation: float-delayed 6s ease-in-out infinite;
}

.animate-fade-in-left {
    animation: fade-in-left 0.8s ease-out;
}

.animate-fade-in-right {
    animation: fade-in-right 0.8s ease-out 0.2s both;
}
</style>
