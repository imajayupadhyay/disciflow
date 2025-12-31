<template>
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden">

        <!-- Content -->
        <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-20">
            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-zinc-100 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 px-5 py-2.5 rounded-full mb-8 animate-fade-in-down">
                <div class="w-2 h-2 bg-amber-600 dark:bg-amber-500 rounded-full animate-pulse"></div>
                <span class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Your Life Operating System</span>
            </div>

            <!-- Main Heading -->
            <h1 class="text-6xl md:text-8xl font-bold mb-8 animate-fade-in-up leading-tight">
                <span class="block text-zinc-900 dark:text-white mb-3">Build Discipline.</span>
                <span class="block bg-gradient-to-r from-amber-700 via-amber-600 to-amber-800 dark:from-amber-500 dark:via-amber-400 dark:to-amber-600 bg-clip-text text-transparent min-h-[6rem] md:min-h-[8rem]">
                    {{ displayedText }}<span class="typing-cursor">|</span>
                </span>
            </h1>

            <!-- Subheading -->
            <p class="text-xl md:text-2xl text-zinc-600 dark:text-zinc-400 mb-12 max-w-3xl mx-auto leading-relaxed animate-fade-in-up animation-delay-200 font-light">
                Data-driven insights for consistent self-improvement
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center animate-fade-in-up animation-delay-400 mb-20">
                <button class="group relative px-10 py-4 bg-gradient-to-r from-amber-700 to-amber-900 dark:from-amber-600 dark:to-amber-800 text-white font-semibold rounded-xl overflow-hidden transition-all duration-300 hover:shadow-2xl hover:shadow-amber-900/30 dark:hover:shadow-amber-600/30 hover:scale-105">
                    <span class="relative z-10 flex items-center space-x-2">
                        <span>Start Your Journey</span>
                        <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </span>
                </button>

                <button class="px-10 py-4 bg-transparent border-2 border-zinc-900 dark:border-zinc-100 text-zinc-900 dark:text-zinc-100 font-semibold rounded-xl hover:bg-zinc-900 dark:hover:bg-zinc-100 hover:text-white dark:hover:text-black transition-all duration-300 hover:scale-105">
                    View Features
                </button>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-3 gap-6 max-w-4xl mx-auto animate-fade-in animation-delay-600">
                <div class="bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-2xl p-8 hover:border-amber-700 dark:hover:border-amber-600 transition-all duration-300 hover:scale-105">
                    <div class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-amber-700 to-amber-900 dark:from-amber-500 dark:to-amber-700 bg-clip-text text-transparent mb-3">
                        8+
                    </div>
                    <div class="text-sm font-medium text-zinc-600 dark:text-zinc-400">Life Trackers</div>
                </div>
                <div class="bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-2xl p-8 hover:border-amber-700 dark:hover:border-amber-600 transition-all duration-300 hover:scale-105">
                    <div class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-zinc-700 to-zinc-900 dark:from-zinc-300 dark:to-zinc-500 bg-clip-text text-transparent mb-3">
                        AI
                    </div>
                    <div class="text-sm font-medium text-zinc-600 dark:text-zinc-400">Powered Insights</div>
                </div>
                <div class="bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-2xl p-8 hover:border-amber-700 dark:hover:border-amber-600 transition-all duration-300 hover:scale-105">
                    <div class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-amber-700 to-amber-900 dark:from-amber-500 dark:to-amber-700 bg-clip-text text-transparent mb-3">
                        24/7
                    </div>
                    <div class="text-sm font-medium text-zinc-600 dark:text-zinc-400">Always Available</div>
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
    'Master Life.',
    'Track Everything.',
    'Achieve Goals.',
    'Build Habits.',
    'Optimize Daily.',
    'Stay Consistent.',
    'Grow Stronger.',
    'Live Purposefully.'
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

@keyframes float {
    0%, 100% {
        transform: translate(0, 0);
    }
    50% {
        transform: translate(30px, -30px);
    }
}

@keyframes float-delayed {
    0%, 100% {
        transform: translate(0, 0);
    }
    50% {
        transform: translate(-30px, 30px);
    }
}

@keyframes fade-in-down {
    0% {
        opacity: 0;
        transform: translateY(-10px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fade-in-up {
    0% {
        opacity: 0;
        transform: translateY(10px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fade-in {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}

.animate-float {
    animation: float 20s ease-in-out infinite;
}

.animate-float-delayed {
    animation: float-delayed 20s ease-in-out infinite;
}

.animate-fade-in-down {
    animation: fade-in-down 0.6s ease-out;
}

.animate-fade-in-up {
    animation: fade-in-up 0.6s ease-out;
}

.animate-fade-in {
    animation: fade-in 0.6s ease-out;
}

.animation-delay-200 {
    animation-delay: 0.2s;
    opacity: 0;
    animation-fill-mode: forwards;
}

.animation-delay-400 {
    animation-delay: 0.4s;
    opacity: 0;
    animation-fill-mode: forwards;
}

.animation-delay-600 {
    animation-delay: 0.6s;
    opacity: 0;
    animation-fill-mode: forwards;
}
</style>
