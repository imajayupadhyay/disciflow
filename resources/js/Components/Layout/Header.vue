<template>
    <header class="fixed w-full top-0 left-0 z-50 transition-all duration-300" :class="isScrolled ? 'p-0' : 'p-0 md:py-4 md:px-4'">
        <nav :class="[
            'mx-auto bg-white/90 dark:bg-zinc-900/90 backdrop-blur-xl shadow-lg transition-all duration-300',
            isScrolled
                ? 'max-w-full rounded-none border-b border-zinc-200 dark:border-zinc-700'
                : 'max-w-full rounded-none border-b border-zinc-200 dark:border-zinc-700 md:max-w-[80%] md:rounded-2xl md:border md:border-zinc-200 md:dark:border-zinc-700'
        ]">
            <div class="flex justify-between items-center h-16 px-6">
                <!-- Logo -->
                <Link href="/" class="flex items-center space-x-3 group cursor-pointer">
                    <div class="relative">
                        <div class="w-9 h-9 bg-gradient-to-br from-amber-600 to-amber-800 dark:from-amber-500 dark:to-amber-700 rounded-xl flex items-center justify-center transform group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                    </div>
                    <span class="text-xl font-bold bg-gradient-to-r from-amber-700 to-amber-900 dark:from-amber-400 dark:to-amber-600 bg-clip-text text-transparent">
                        DisciFlow
                    </span>
                </Link>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-1">
                    <Link
                        href="/"
                        :class="[
                            'px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200',
                            isActive('/')
                                ? 'bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400'
                                : 'text-zinc-700 dark:text-zinc-300 hover:text-amber-700 dark:hover:text-amber-400 hover:bg-zinc-50 dark:hover:bg-zinc-800'
                        ]"
                    >
                        Home
                    </Link>
                    <Link
                        href="/trackers"
                        :class="[
                            'px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200',
                            isActive('/trackers')
                                ? 'bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400'
                                : 'text-zinc-700 dark:text-zinc-300 hover:text-amber-700 dark:hover:text-amber-400 hover:bg-zinc-50 dark:hover:bg-zinc-800'
                        ]"
                    >
                        Trackers
                    </Link>
                    <Link
                        href="/pricing"
                        :class="[
                            'px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200',
                            isActive('/pricing')
                                ? 'bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400'
                                : 'text-zinc-700 dark:text-zinc-300 hover:text-amber-700 dark:hover:text-amber-400 hover:bg-zinc-50 dark:hover:bg-zinc-800'
                        ]"
                    >
                        Pricing
                    </Link>
                    <Link
                        href="/support"
                        :class="[
                            'px-4 py-2 text-sm font-medium rounded-lg transition-all duration-200',
                            isActive('/support')
                                ? 'bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400'
                                : 'text-zinc-700 dark:text-zinc-300 hover:text-amber-700 dark:hover:text-amber-400 hover:bg-zinc-50 dark:hover:bg-zinc-800'
                        ]"
                    >
                        Support
                    </Link>
                </div>

                <!-- Right Side - Theme Toggle & Auth -->
                <div class="flex items-center space-x-4">
                    <!-- Theme Toggle Switch -->
                    <div class="hidden md:flex items-center bg-zinc-100 dark:bg-zinc-800 rounded-full p-1 border border-zinc-200 dark:border-zinc-700">
                        <button
                            @click="setLightMode"
                            :class="[
                                'px-4 py-2 text-xs font-semibold rounded-full transition-all duration-300',
                                !isDark
                                    ? 'bg-white text-zinc-900 shadow-md'
                                    : 'text-zinc-500 hover:text-zinc-700'
                            ]"
                        >
                            Light
                        </button>
                        <button
                            @click="setDarkMode"
                            :class="[
                                'px-4 py-2 text-xs font-semibold rounded-full transition-all duration-300',
                                isDark
                                    ? 'bg-zinc-900 text-white shadow-md'
                                    : 'text-zinc-500 hover:text-zinc-700'
                            ]"
                        >
                            Dark
                        </button>
                    </div>

                    <!-- Auth Button / User Menu -->
                    <div v-if="!isAuthenticated" class="hidden md:block">
                        <button
                            @click="showAuthModal = true"
                            class="px-5 py-2.5 bg-gradient-to-r from-amber-600 to-amber-800 dark:from-amber-500 dark:to-amber-700 text-white text-sm font-semibold rounded-lg hover:shadow-lg hover:shadow-amber-500/30 transform hover:-translate-y-0.5 transition-all duration-200"
                        >
                            Login / Signup
                        </button>
                    </div>

                    <!-- User Dropdown (when logged in) -->
                    <div v-else class="hidden md:block relative">
                        <button
                            @click="userMenuOpen = !userMenuOpen"
                            class="flex items-center space-x-2 px-4 py-2 bg-zinc-100 dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-lg hover:bg-zinc-200 dark:hover:bg-zinc-700 transition-all"
                        >
                            <div class="w-8 h-8 bg-gradient-to-br from-amber-600 to-amber-800 dark:from-amber-500 dark:to-amber-700 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                {{ user?.name?.charAt(0).toUpperCase() }}
                            </div>
                            <span class="text-sm font-medium text-zinc-700 dark:text-zinc-300">
                                {{ user?.name }}
                            </span>
                            <svg class="w-4 h-4 text-zinc-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <Transition name="dropdown">
                            <div
                                v-if="userMenuOpen"
                                class="absolute right-0 mt-2 w-48 bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-xl shadow-lg overflow-hidden"
                            >
                                <a href="#" class="block px-4 py-3 text-sm text-zinc-700 dark:text-zinc-300 hover:bg-zinc-50 dark:hover:bg-zinc-800 transition-colors">
                                    Profile
                                </a>
                                <a href="#" class="block px-4 py-3 text-sm text-zinc-700 dark:text-zinc-300 hover:bg-zinc-50 dark:hover:bg-zinc-800 transition-colors">
                                    Settings
                                </a>
                                <div class="border-t border-zinc-200 dark:border-zinc-700"></div>
                                <button
                                    @click="handleLogout"
                                    class="w-full text-left px-4 py-3 text-sm text-red-600 dark:text-red-500 hover:bg-zinc-50 dark:hover:bg-zinc-800 transition-colors"
                                >
                                    Logout
                                </button>
                            </div>
                        </Transition>
                    </div>

                    <!-- Mobile Menu Button -->
                    <button
                        @click="mobileMenuOpen = !mobileMenuOpen"
                        class="md:hidden p-2 rounded-lg hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors"
                    >
                        <svg class="w-6 h-6 text-zinc-700 dark:text-zinc-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path v-if="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div
                v-show="mobileMenuOpen"
                class="md:hidden px-6 pb-4 space-y-2 border-t border-zinc-200 dark:border-zinc-700 pt-4 mt-2"
            >
                <Link
                    href="/"
                    :class="[
                        'block px-4 py-2 text-sm font-medium rounded-lg transition-all',
                        isActive('/')
                            ? 'bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400'
                            : 'text-zinc-700 dark:text-zinc-300 hover:text-amber-700 dark:hover:text-amber-400 hover:bg-zinc-50 dark:hover:bg-zinc-800'
                    ]"
                >
                    Home
                </Link>
                <Link
                    href="/trackers"
                    :class="[
                        'block px-4 py-2 text-sm font-medium rounded-lg transition-all',
                        isActive('/trackers')
                            ? 'bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400'
                            : 'text-zinc-700 dark:text-zinc-300 hover:text-amber-700 dark:hover:text-amber-400 hover:bg-zinc-50 dark:hover:bg-zinc-800'
                    ]"
                >
                    Trackers
                </Link>
                <Link
                    href="/pricing"
                    :class="[
                        'block px-4 py-2 text-sm font-medium rounded-lg transition-all',
                        isActive('/pricing')
                            ? 'bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400'
                            : 'text-zinc-700 dark:text-zinc-300 hover:text-amber-700 dark:hover:text-amber-400 hover:bg-zinc-50 dark:hover:bg-zinc-800'
                    ]"
                >
                    Pricing
                </Link>
                <Link
                    href="/support"
                    :class="[
                        'block px-4 py-2 text-sm font-medium rounded-lg transition-all',
                        isActive('/support')
                            ? 'bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400'
                            : 'text-zinc-700 dark:text-zinc-300 hover:text-amber-700 dark:hover:text-amber-400 hover:bg-zinc-50 dark:hover:bg-zinc-800'
                    ]"
                >
                    Support
                </Link>

                <!-- Mobile Theme Toggle -->
                <div class="flex items-center bg-zinc-100 dark:bg-zinc-800 rounded-full p-1 border border-zinc-200 dark:border-zinc-700">
                    <button
                        @click="setLightMode"
                        :class="[
                            'flex-1 px-4 py-2 text-xs font-semibold rounded-full transition-all duration-300',
                            !isDark
                                ? 'bg-white text-zinc-900 shadow-md'
                                : 'text-zinc-500'
                        ]"
                    >
                        Light
                    </button>
                    <button
                        @click="setDarkMode"
                        :class="[
                            'flex-1 px-4 py-2 text-xs font-semibold rounded-full transition-all duration-300',
                            isDark
                                ? 'bg-zinc-900 text-white shadow-md'
                                : 'text-zinc-500'
                        ]"
                    >
                        Dark
                    </button>
                </div>

                <!-- Mobile Auth -->
                <div v-if="!isAuthenticated">
                    <button
                        @click="showAuthModal = true"
                        class="w-full px-4 py-2.5 bg-gradient-to-r from-amber-600 to-amber-800 dark:from-amber-500 dark:to-amber-700 text-white text-sm font-semibold rounded-lg"
                    >
                        Login / Signup
                    </button>
                </div>

                <!-- Mobile User Menu -->
                <div v-else class="space-y-2">
                    <div class="flex items-center space-x-2 px-4 py-2 bg-zinc-100 dark:bg-zinc-800 rounded-lg">
                        <div class="w-8 h-8 bg-gradient-to-br from-amber-600 to-amber-800 dark:from-amber-500 dark:to-amber-700 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                            {{ user?.name?.charAt(0).toUpperCase() }}
                        </div>
                        <span class="text-sm font-medium text-zinc-700 dark:text-zinc-300">
                            {{ user?.name }}
                        </span>
                    </div>
                    <a href="#" class="block px-4 py-2 text-sm text-zinc-700 dark:text-zinc-300 hover:bg-zinc-50 dark:hover:bg-zinc-800 rounded-lg">
                        Profile
                    </a>
                    <a href="#" class="block px-4 py-2 text-sm text-zinc-700 dark:text-zinc-300 hover:bg-zinc-50 dark:hover:bg-zinc-800 rounded-lg">
                        Settings
                    </a>
                    <button
                        @click="handleLogout"
                        class="w-full text-left px-4 py-2 text-sm text-red-600 dark:text-red-500 hover:bg-zinc-50 dark:hover:bg-zinc-800 rounded-lg"
                    >
                        Logout
                    </button>
                </div>
            </div>
        </nav>

        <!-- Auth Modal -->
        <AuthModal v-model="showAuthModal" />
    </header>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import { useDarkMode } from '@/composables/useDarkMode';
import { useAuth } from '@/composables/useAuth';
import AuthModal from '@/Components/Auth/AuthModal.vue';

const mobileMenuOpen = ref(false);
const userMenuOpen = ref(false);
const showAuthModal = ref(false);
const isScrolled = ref(false);

const { isDark, toggleDarkMode, initTheme } = useDarkMode();
const { user, isAuthenticated, logout, initAuth } = useAuth();

const page = usePage();

const isActive = (path) => {
    return page.url === path;
};

const setLightMode = () => {
    if (isDark.value) {
        toggleDarkMode();
    }
};

const setDarkMode = () => {
    if (!isDark.value) {
        toggleDarkMode();
    }
};

const handleLogout = () => {
    logout();
    userMenuOpen.value = false;
    mobileMenuOpen.value = false;
};

const handleScroll = () => {
    isScrolled.value = window.scrollY > 50;
};

onMounted(() => {
    initTheme();
    initAuth();
    window.addEventListener('scroll', handleScroll);
});

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
});
</script>

<style scoped>
.dropdown-enter-active,
.dropdown-leave-active {
    transition: all 0.2s ease;
}

.dropdown-enter-from,
.dropdown-leave-to {
    opacity: 0;
    transform: translateY(-10px);
}
</style>
