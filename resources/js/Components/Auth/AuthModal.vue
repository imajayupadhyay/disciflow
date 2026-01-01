<template>
    <!-- Modal Overlay -->
    <Transition name="fade">
        <div
            v-if="modelValue"
            @click="closeModal"
            class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4"
        >
            <!-- Modal Content -->
            <div
                @click.stop
                class="bg-white dark:bg-zinc-900 rounded-2xl shadow-2xl max-w-lg w-full border border-zinc-200 dark:border-zinc-800 transform transition-all"
            >
                <!-- Close Button -->
                <button
                    @click="closeModal"
                    class="absolute top-4 right-4 p-2 text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-300 transition-colors"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>

                <!-- Modal Header -->
                <div class="p-8 pb-6">
                    <!-- Login/Signup Toggle -->
                    <div class="flex items-center bg-zinc-100 dark:bg-zinc-800 rounded-full p-1 border border-zinc-200 dark:border-zinc-700 mb-6">
                        <button
                            @click="isLogin = true"
                            :class="[
                                'flex-1 px-6 py-2.5 text-sm font-semibold rounded-full transition-all duration-300',
                                isLogin
                                    ? 'bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white shadow-md'
                                    : 'text-zinc-500 hover:text-zinc-700 dark:hover:text-zinc-400'
                            ]"
                        >
                            Login
                        </button>
                        <button
                            @click="isLogin = false"
                            :class="[
                                'flex-1 px-6 py-2.5 text-sm font-semibold rounded-full transition-all duration-300',
                                !isLogin
                                    ? 'bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white shadow-md'
                                    : 'text-zinc-500 hover:text-zinc-700 dark:hover:text-zinc-400'
                            ]"
                        >
                            Sign Up
                        </button>
                    </div>

                    <h2 class="text-2xl font-bold text-zinc-900 dark:text-white text-center mb-2">
                        {{ isLogin ? 'Welcome Back' : 'Create Account' }}
                    </h2>
                    <p class="text-sm text-zinc-600 dark:text-zinc-400 text-center">
                        {{ isLogin ? 'Enter your credentials to continue' : 'Start your journey with DisciFlow' }}
                    </p>
                </div>

                <!-- Modal Body -->
                <div class="px-8 pb-8">
                    <!-- Google OAuth Button -->
                    <button
                        @click="handleGoogleAuth"
                        class="w-full flex items-center justify-center space-x-3 px-4 py-3 bg-white dark:bg-zinc-800 border-2 border-zinc-200 dark:border-zinc-700 rounded-xl hover:bg-zinc-50 dark:hover:bg-zinc-700 transition-all duration-200 mb-6"
                    >
                        <svg class="w-5 h-5" viewBox="0 0 24 24">
                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                        </svg>
                        <span class="font-semibold text-zinc-700 dark:text-zinc-300">
                            Continue with Google
                        </span>
                    </button>

                    <!-- Divider -->
                    <div class="relative mb-6">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-zinc-200 dark:border-zinc-700"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-4 bg-white dark:bg-zinc-900 text-zinc-500 dark:text-zinc-400">Or continue with email</span>
                        </div>
                    </div>

                    <!-- Error Message -->
                    <div v-if="errorMessage" class="mb-4 p-3 bg-red-100 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-xl">
                        <p class="text-sm text-red-700 dark:text-red-400">{{ errorMessage }}</p>
                    </div>

                    <!-- Login Form -->
                    <form v-if="isLogin" @submit.prevent="handleLogin" class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                Email
                            </label>
                            <input
                                v-model="loginForm.email"
                                type="email"
                                required
                                :disabled="isLoading"
                                placeholder="your@email.com"
                                class="w-full px-4 py-3 bg-zinc-50 dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all text-zinc-900 dark:text-white placeholder-zinc-400 disabled:opacity-50 disabled:cursor-not-allowed"
                            />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                Password
                            </label>
                            <div class="relative">
                                <input
                                    v-model="loginForm.password"
                                    :type="showLoginPassword ? 'text' : 'password'"
                                    required
                                    :disabled="isLoading"
                                    placeholder="••••••••"
                                    class="w-full px-4 py-3 pr-12 bg-zinc-50 dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all text-zinc-900 dark:text-white placeholder-zinc-400 disabled:opacity-50 disabled:cursor-not-allowed"
                                />
                                <button
                                    type="button"
                                    @click="showLoginPassword = !showLoginPassword"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 p-1.5 text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-300 transition-colors"
                                >
                                    <svg v-if="!showLoginPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    <svg v-else class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="flex items-center justify-between text-sm">
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input v-model="loginForm.remember" type="checkbox" :disabled="isLoading" class="rounded border-zinc-300 dark:border-zinc-600 text-amber-600 focus:ring-amber-500 disabled:opacity-50 disabled:cursor-not-allowed" />
                                <span class="text-zinc-600 dark:text-zinc-400">Remember me</span>
                            </label>
                            <a href="#" class="text-amber-600 dark:text-amber-500 hover:text-amber-700 dark:hover:text-amber-400">
                                Forgot password?
                            </a>
                        </div>

                        <button
                            type="submit"
                            :disabled="isLoading"
                            class="w-full px-4 py-3 bg-gradient-to-r from-amber-600 to-amber-800 dark:from-amber-500 dark:to-amber-700 text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-amber-500/30 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                            {{ isLoading ? 'Signing In...' : 'Sign In' }}
                        </button>
                    </form>

                    <!-- Signup Form -->
                    <form v-else @submit.prevent="handleSignup" class="space-y-4">
                        <!-- Two Column Grid for Name and Email -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                    Full Name
                                </label>
                                <input
                                    v-model="signupForm.name"
                                    type="text"
                                    required
                                    :disabled="isLoading"
                                    placeholder="John Doe"
                                    class="w-full px-4 py-3 bg-zinc-50 dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all text-zinc-900 dark:text-white placeholder-zinc-400 disabled:opacity-50 disabled:cursor-not-allowed"
                                />
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                    Email
                                </label>
                                <input
                                    v-model="signupForm.email"
                                    type="email"
                                    required
                                    :disabled="isLoading"
                                    placeholder="your@email.com"
                                    class="w-full px-4 py-3 bg-zinc-50 dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all text-zinc-900 dark:text-white placeholder-zinc-400 disabled:opacity-50 disabled:cursor-not-allowed"
                                />
                            </div>
                        </div>

                        <!-- Two Column Grid for Passwords -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                    Password
                                </label>
                                <div class="relative">
                                    <input
                                        v-model="signupForm.password"
                                        :type="showSignupPassword ? 'text' : 'password'"
                                        required
                                        :disabled="isLoading"
                                        placeholder="••••••••"
                                        class="w-full px-4 py-3 pr-12 bg-zinc-50 dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all text-zinc-900 dark:text-white placeholder-zinc-400 disabled:opacity-50 disabled:cursor-not-allowed"
                                    />
                                    <button
                                        type="button"
                                        @click="showSignupPassword = !showSignupPassword"
                                        class="absolute right-3 top-1/2 -translate-y-1/2 p-1.5 text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-300 transition-colors"
                                    >
                                        <svg v-if="!showSignupPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        <svg v-else class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">
                                    Confirm Password
                                </label>
                                <div class="relative">
                                    <input
                                        v-model="signupForm.password_confirmation"
                                        :type="showConfirmPassword ? 'text' : 'password'"
                                        required
                                        :disabled="isLoading"
                                        placeholder="••••••••"
                                        class="w-full px-4 py-3 pr-12 bg-zinc-50 dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all text-zinc-900 dark:text-white placeholder-zinc-400 disabled:opacity-50 disabled:cursor-not-allowed"
                                    />
                                    <button
                                        type="button"
                                        @click="showConfirmPassword = !showConfirmPassword"
                                        class="absolute right-3 top-1/2 -translate-y-1/2 p-1.5 text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-300 transition-colors"
                                    >
                                        <svg v-if="!showConfirmPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        <svg v-else class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Terms Checkbox -->
                        <div class="flex items-start space-x-2 pt-2">
                            <input type="checkbox" required class="mt-1 rounded border-zinc-300 dark:border-zinc-600 text-amber-600 focus:ring-amber-500" />
                            <label class="text-sm text-zinc-600 dark:text-zinc-400">
                                I agree to the <a href="#" class="text-amber-600 dark:text-amber-500 hover:underline">Terms of Service</a> and <a href="#" class="text-amber-600 dark:text-amber-500 hover:underline">Privacy Policy</a>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button
                            type="submit"
                            :disabled="isLoading"
                            class="w-full px-4 py-3 bg-gradient-to-r from-amber-600 to-amber-800 dark:from-amber-500 dark:to-amber-700 text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-amber-500/30 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                            {{ isLoading ? 'Creating Account...' : 'Create Account' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </Transition>
</template>

<script setup>
import { ref } from 'vue';
import { useAuth } from '@/composables/useAuth';

const props = defineProps({
    modelValue: Boolean
});

const emit = defineEmits(['update:modelValue']);

const { register, login } = useAuth();

const isLogin = ref(true);
const showLoginPassword = ref(false);
const showSignupPassword = ref(false);
const showConfirmPassword = ref(false);
const isLoading = ref(false);
const errorMessage = ref('');

const loginForm = ref({
    email: '',
    password: '',
    remember: false
});

const signupForm = ref({
    name: '',
    email: '',
    password: '',
    password_confirmation: ''
});

const closeModal = () => {
    emit('update:modelValue', false);
    errorMessage.value = '';
    resetForms();
};

const resetForms = () => {
    loginForm.value = {
        email: '',
        password: '',
        remember: false
    };
    signupForm.value = {
        name: '',
        email: '',
        password: '',
        password_confirmation: ''
    };
};

const handleLogin = async () => {
    errorMessage.value = '';
    isLoading.value = true;

    try {
        const result = await login({
            email: loginForm.value.email,
            password: loginForm.value.password,
            remember: loginForm.value.remember
        });

        if (result.success) {
            closeModal();
        } else {
            errorMessage.value = result.errors?.email?.[0] || result.errors?.general || 'Login failed';
        }
    } catch (error) {
        errorMessage.value = 'An unexpected error occurred';
    } finally {
        isLoading.value = false;
    }
};

const handleSignup = async () => {
    errorMessage.value = '';

    if (signupForm.value.password !== signupForm.value.password_confirmation) {
        errorMessage.value = 'Passwords do not match!';
        return;
    }

    isLoading.value = true;

    try {
        const result = await register(signupForm.value);

        if (result.success) {
            closeModal();
        } else {
            if (result.errors?.email) {
                errorMessage.value = result.errors.email[0];
            } else if (result.errors?.password) {
                errorMessage.value = result.errors.password[0];
            } else {
                errorMessage.value = result.errors?.general || 'Registration failed';
            }
        }
    } catch (error) {
        errorMessage.value = 'An unexpected error occurred';
    } finally {
        isLoading.value = false;
    }
};

const handleGoogleAuth = () => {
    // Redirect to Google OAuth
    window.location.href = '/auth/google/redirect';
};
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

.fade-enter-active > div,
.fade-leave-active > div {
    transition: transform 0.3s ease;
}

.fade-enter-from > div,
.fade-leave-to > div {
    transform: scale(0.95);
}
</style>
