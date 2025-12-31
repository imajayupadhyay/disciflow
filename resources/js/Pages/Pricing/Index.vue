<template>
    <Head>
        <title>Pricing Plans - Simple & Transparent Pricing | Disciflow</title>
        <meta name="description" content="Choose the perfect plan to track and master your life. Start free with 1 tracker, upgrade to Pro for 3 trackers, or go Enterprise for unlimited access. Flexible monthly and yearly billing with 20% savings." />
        <meta name="keywords" content="disciflow pricing, life tracker pricing, subscription plans, habit tracker cost, budget tracker pricing, free tracker, premium tracking app, affordable life management" />

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website" />
        <meta property="og:title" content="Pricing Plans - Simple & Transparent Pricing" />
        <meta property="og:description" content="Choose the perfect plan to track and master your life. Start free or upgrade to Pro and Enterprise plans with advanced features." />
        <meta property="og:site_name" content="Disciflow" />

        <!-- Twitter Card -->
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:title" content="Pricing Plans - Simple & Transparent Pricing" />
        <meta name="twitter:description" content="Choose the perfect plan to track and master your life. Start free or upgrade to Pro and Enterprise plans with advanced features." />

        <!-- Additional SEO Tags -->
        <meta name="robots" content="index, follow" />
        <meta name="author" content="Disciflow" />
        <link rel="canonical" href="https://disciflow.com/pricing" />
    </Head>

    <div class="min-h-screen flex flex-col bg-white dark:bg-black transition-colors duration-500 relative overflow-hidden">
        <!-- Background SVG Pattern -->
        <div class="absolute inset-0 pointer-events-none">
            <svg class="absolute inset-0 w-full h-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="pricing-grid" width="32" height="32" patternUnits="userSpaceOnUse">
                        <path d="M 32 0 L 0 0 0 32" fill="none" stroke="currentColor" class="text-zinc-200/30 dark:text-zinc-800/30" stroke-width="0.5"/>
                    </pattern>
                    <linearGradient id="pricing-gradient1" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" class="text-amber-500/10 dark:text-amber-600/5" style="stop-color:currentColor"/>
                        <stop offset="100%" class="text-transparent" style="stop-color:currentColor"/>
                    </linearGradient>
                    <radialGradient id="pricing-radial1" cx="30%" cy="20%">
                        <stop offset="0%" class="text-amber-500/20 dark:text-amber-600/10" style="stop-color:currentColor"/>
                        <stop offset="100%" class="text-transparent" style="stop-color:currentColor"/>
                    </radialGradient>
                    <radialGradient id="pricing-radial2" cx="70%" cy="80%">
                        <stop offset="0%" class="text-amber-500/15 dark:text-amber-600/8" style="stop-color:currentColor"/>
                        <stop offset="100%" class="text-transparent" style="stop-color:currentColor"/>
                    </radialGradient>
                </defs>
                <rect width="100%" height="100%" fill="url(#pricing-grid)" />
                <rect width="100%" height="100%" fill="url(#pricing-gradient1)" />
                <circle cx="30%" cy="20%" r="300" fill="url(#pricing-radial1)" />
                <circle cx="70%" cy="80%" r="400" fill="url(#pricing-radial2)" />
            </svg>

            <div class="absolute top-20 left-10 w-32 h-32 bg-amber-500/5 dark:bg-amber-600/5 rounded-full blur-3xl"></div>
            <div class="absolute top-40 right-20 w-48 h-48 bg-amber-500/5 dark:bg-amber-600/5 rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 left-1/4 w-40 h-40 bg-amber-500/5 dark:bg-amber-600/5 rounded-full blur-3xl"></div>
            <div class="absolute bottom-40 right-1/3 w-56 h-56 bg-amber-500/5 dark:bg-amber-600/5 rounded-full blur-3xl"></div>
        </div>

        <div class="relative z-50">
            <Header />
        </div>

        <main class="flex-grow pt-32 pb-20 relative z-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Page Header -->
                <div class="text-center mb-16">
                    <h1 class="text-5xl md:text-6xl font-bold text-zinc-900 dark:text-white mb-6">
                        Simple, Transparent <span class="bg-gradient-to-r from-amber-600 to-amber-800 dark:from-amber-500 dark:to-amber-700 bg-clip-text text-transparent">Pricing</span>
                    </h1>
                    <p class="text-xl text-zinc-600 dark:text-zinc-400 max-w-2xl mx-auto mb-10">
                        Choose the perfect plan to track and master your life
                    </p>

                    <!-- Currency Selector -->
                    <div class="flex justify-center mb-8">
                        <div class="inline-flex bg-white dark:bg-zinc-900 border-2 border-zinc-200 dark:border-zinc-800 rounded-2xl p-1.5">
                            <button
                                v-for="curr in currencies"
                                :key="curr.code"
                                @click="selectedCurrency = curr.code"
                                :class="[
                                    'px-6 py-2.5 rounded-xl font-semibold text-sm transition-all duration-200',
                                    selectedCurrency === curr.code
                                        ? 'bg-amber-600 dark:bg-amber-700 text-white shadow-lg'
                                        : 'text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white'
                                ]"
                            >
                                {{ curr.symbol }} {{ curr.code }}
                            </button>
                        </div>
                    </div>

                    <!-- Billing Toggle -->
                    <div class="flex items-center justify-center space-x-4">
                        <span :class="['text-sm font-medium transition-colors', !isYearly ? 'text-zinc-900 dark:text-white' : 'text-zinc-500 dark:text-zinc-500']">
                            Monthly
                        </span>
                        <button
                            @click="isYearly = !isYearly"
                            class="relative w-14 h-7 bg-zinc-200 dark:bg-zinc-700 rounded-full transition-colors duration-200"
                            :class="{ 'bg-amber-600 dark:bg-amber-700': isYearly }"
                        >
                            <span
                                class="absolute top-0.5 left-0.5 w-6 h-6 bg-white rounded-full shadow-md transition-transform duration-200"
                                :class="{ 'translate-x-7': isYearly }"
                            ></span>
                        </button>
                        <span :class="['text-sm font-medium transition-colors', isYearly ? 'text-zinc-900 dark:text-white' : 'text-zinc-500 dark:text-zinc-500']">
                            Yearly
                        </span>
                        <span v-if="isYearly" class="inline-flex items-center px-3 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-500 text-xs font-bold rounded-full">
                            Save 20%
                        </span>
                    </div>
                </div>

                <!-- Pricing Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto mb-20">
                    <!-- Free Plan -->
                    <div class="relative bg-white dark:bg-zinc-900 border-2 border-zinc-200 dark:border-zinc-800 rounded-3xl p-8 hover:border-zinc-300 dark:hover:border-zinc-700 transition-all duration-300">
                        <div class="mb-6">
                            <h3 class="text-2xl font-bold text-zinc-900 dark:text-white mb-2">
                                Starter
                            </h3>
                            <p class="text-zinc-600 dark:text-zinc-400 text-sm">
                                Perfect for getting started
                            </p>
                        </div>

                        <div class="mb-8">
                            <div class="flex items-baseline">
                                <span class="text-5xl font-bold text-zinc-900 dark:text-white">{{ getCurrencySymbol() }}0</span>
                                <span class="text-zinc-500 dark:text-zinc-400 ml-2">/month</span>
                            </div>
                        </div>

                        <ul class="space-y-4 mb-8">
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-green-600 dark:text-green-500 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-zinc-700 dark:text-zinc-300">1 Tracker of your choice</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-green-600 dark:text-green-500 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-zinc-700 dark:text-zinc-300">Basic analytics</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-green-600 dark:text-green-500 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-zinc-700 dark:text-zinc-300">Mobile app access</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-zinc-300 dark:text-zinc-700 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                <span class="text-zinc-400 dark:text-zinc-600 line-through">Data export</span>
                            </li>
                        </ul>

                        <button class="w-full px-6 py-3.5 bg-zinc-100 dark:bg-zinc-800 text-zinc-900 dark:text-white font-semibold rounded-xl hover:bg-zinc-200 dark:hover:bg-zinc-700 transition-all duration-200">
                            Get Started Free
                        </button>
                    </div>

                    <!-- Pro Plan -->
                    <div class="relative bg-white dark:bg-zinc-900 border-2 border-amber-500 dark:border-amber-600 rounded-3xl p-8 shadow-2xl shadow-amber-500/20 dark:shadow-amber-600/10 transform scale-105">
                        <!-- Popular Badge -->
                        <div class="absolute -top-4 left-1/2 -translate-x-1/2">
                            <span class="inline-flex items-center px-4 py-1.5 bg-gradient-to-r from-amber-600 to-amber-700 text-white text-xs font-bold rounded-full shadow-lg">
                                MOST POPULAR
                            </span>
                        </div>

                        <div class="mb-6 mt-2">
                            <h3 class="text-2xl font-bold text-zinc-900 dark:text-white mb-2">
                                Pro
                            </h3>
                            <p class="text-zinc-600 dark:text-zinc-400 text-sm">
                                For serious life trackers
                            </p>
                        </div>

                        <div class="mb-8">
                            <div class="flex items-baseline">
                                <span class="text-5xl font-bold bg-gradient-to-r from-amber-600 to-amber-800 bg-clip-text text-transparent">
                                    {{ getCurrencySymbol() }}{{ isYearly ? convertPrice(1 * 12 * 0.8) : convertPrice(1) }}
                                </span>
                                <span class="text-zinc-500 dark:text-zinc-400 ml-2">/{{ isYearly ? 'year' : 'month' }}</span>
                            </div>
                            <p v-if="isYearly" class="text-sm text-green-600 dark:text-green-500 mt-2">
                                Billed {{ getCurrencySymbol() }}{{ convertPrice(1 * 12 * 0.8) }} yearly
                            </p>
                        </div>

                        <ul class="space-y-4 mb-8">
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-green-600 dark:text-green-500 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-zinc-700 dark:text-zinc-300 font-medium">Up to 3 trackers</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-green-600 dark:text-green-500 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-zinc-700 dark:text-zinc-300">Advanced analytics</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-green-600 dark:text-green-500 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-zinc-700 dark:text-zinc-300">Data export (CSV/PDF)</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-green-600 dark:text-green-500 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-zinc-700 dark:text-zinc-300">Priority support</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-green-600 dark:text-green-500 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-zinc-700 dark:text-zinc-300">Custom reminders</span>
                            </li>
                        </ul>

                        <button class="w-full px-6 py-3.5 bg-gradient-to-r from-amber-600 to-amber-800 dark:from-amber-500 dark:to-amber-700 text-white font-semibold rounded-xl hover:shadow-xl hover:shadow-amber-500/30 hover:-translate-y-0.5 transition-all duration-200">
                            Start Pro Trial
                        </button>
                    </div>

                    <!-- Enterprise Plan -->
                    <div class="relative bg-white dark:bg-zinc-900 border-2 border-zinc-200 dark:border-zinc-800 rounded-3xl p-8 hover:border-zinc-300 dark:hover:border-zinc-700 transition-all duration-300">
                        <div class="mb-6">
                            <h3 class="text-2xl font-bold text-zinc-900 dark:text-white mb-2">
                                Enterprise
                            </h3>
                            <p class="text-zinc-600 dark:text-zinc-400 text-sm">
                                Complete life mastery
                            </p>
                        </div>

                        <div class="mb-8">
                            <div class="flex items-baseline">
                                <span class="text-5xl font-bold text-zinc-900 dark:text-white">
                                    {{ getCurrencySymbol() }}{{ isYearly ? convertPrice(5 * 12 * 0.8) : convertPrice(5) }}
                                </span>
                                <span class="text-zinc-500 dark:text-zinc-400 ml-2">/{{ isYearly ? 'year' : 'month' }}</span>
                            </div>
                            <p v-if="isYearly" class="text-sm text-green-600 dark:text-green-500 mt-2">
                                Billed {{ getCurrencySymbol() }}{{ convertPrice(5 * 12 * 0.8) }} yearly
                            </p>
                        </div>

                        <ul class="space-y-4 mb-8">
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-green-600 dark:text-green-500 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-zinc-700 dark:text-zinc-300 font-medium">All trackers unlimited</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-green-600 dark:text-green-500 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-zinc-700 dark:text-zinc-300">AI-powered insights</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-green-600 dark:text-green-500 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-zinc-700 dark:text-zinc-300">Unlimited data export</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-green-600 dark:text-green-500 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-zinc-700 dark:text-zinc-300">24/7 priority support</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-green-600 dark:text-green-500 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-zinc-700 dark:text-zinc-300">Custom integrations</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-green-600 dark:text-green-500 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-zinc-700 dark:text-zinc-300">Team collaboration</span>
                            </li>
                        </ul>

                        <button class="w-full px-6 py-3.5 bg-zinc-900 dark:bg-white text-white dark:text-zinc-900 font-semibold rounded-xl hover:bg-zinc-800 dark:hover:bg-zinc-100 transition-all duration-200">
                            Get Enterprise
                        </button>
                    </div>
                </div>

                <!-- FAQ Section -->
                <div class="max-w-3xl mx-auto">
                    <h2 class="text-3xl font-bold text-zinc-900 dark:text-white text-center mb-10">
                        Frequently Asked Questions
                    </h2>
                    <div class="space-y-4">
                        <div
                            v-for="(faq, index) in faqs"
                            :key="index"
                            class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-2xl p-6"
                        >
                            <h3 class="text-lg font-bold text-zinc-900 dark:text-white mb-2">
                                {{ faq.question }}
                            </h3>
                            <p class="text-zinc-600 dark:text-zinc-400">
                                {{ faq.answer }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <div class="relative z-10">
            <Footer />
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import Header from '@/Components/Layout/Header.vue';
import Footer from '@/Components/Layout/Footer.vue';

const selectedCurrency = ref('USD');
const isYearly = ref(false);

const currencies = [
    { code: 'USD', symbol: '$', rate: 1 },
    { code: 'EUR', symbol: '€', rate: 0.92 },
    { code: 'GBP', symbol: '£', rate: 0.79 },
    { code: 'INR', symbol: '₹', rate: 83 }
];

const faqs = [
    {
        question: 'Can I change my plan later?',
        answer: 'Yes! You can upgrade or downgrade your plan at any time. Changes will be reflected in your next billing cycle.'
    },
    {
        question: 'What payment methods do you accept?',
        answer: 'We accept all major credit cards, PayPal, and bank transfers for annual plans.'
    },
    {
        question: 'Is there a free trial?',
        answer: 'Yes! Pro and Enterprise plans come with a 14-day free trial. No credit card required.'
    },
    {
        question: 'Can I cancel anytime?',
        answer: 'Absolutely. You can cancel your subscription at any time with no cancellation fees.'
    }
];

const getCurrencySymbol = () => {
    return currencies.find(c => c.code === selectedCurrency.value)?.symbol || '$';
};

const convertPrice = (usdPrice) => {
    const currency = currencies.find(c => c.code === selectedCurrency.value);
    const converted = usdPrice * (currency?.rate || 1);
    return selectedCurrency.value === 'INR' ? Math.round(converted) : converted.toFixed(2);
};
</script>
