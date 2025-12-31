<template>
    <div class="min-h-screen flex flex-col bg-white dark:bg-black transition-colors duration-500 relative overflow-hidden">
        <!-- Background SVG Pattern -->
        <div class="absolute inset-0 pointer-events-none">
            <!-- Grid Pattern -->
            <svg class="absolute inset-0 w-full h-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="support-grid" width="32" height="32" patternUnits="userSpaceOnUse">
                        <path d="M 32 0 L 0 0 0 32" fill="none" stroke="currentColor" class="text-zinc-200/30 dark:text-zinc-800/30" stroke-width="0.5"/>
                    </pattern>
                    <linearGradient id="support-gradient1" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" class="text-amber-500/10 dark:text-amber-600/5" style="stop-color:currentColor"/>
                        <stop offset="100%" class="text-transparent" style="stop-color:currentColor"/>
                    </linearGradient>
                    <radialGradient id="support-radial1" cx="30%" cy="20%">
                        <stop offset="0%" class="text-amber-500/20 dark:text-amber-600/10" style="stop-color:currentColor"/>
                        <stop offset="100%" class="text-transparent" style="stop-color:currentColor"/>
                    </radialGradient>
                    <radialGradient id="support-radial2" cx="70%" cy="80%">
                        <stop offset="0%" class="text-amber-500/15 dark:text-amber-600/8" style="stop-color:currentColor"/>
                        <stop offset="100%" class="text-transparent" style="stop-color:currentColor"/>
                    </radialGradient>
                </defs>
                <rect width="100%" height="100%" fill="url(#support-grid)" />
                <rect width="100%" height="100%" fill="url(#support-gradient1)" />
                <circle cx="30%" cy="20%" r="300" fill="url(#support-radial1)" />
                <circle cx="70%" cy="80%" r="400" fill="url(#support-radial2)" />
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

        <main class="flex-grow pt-32 pb-20 relative z-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Page Header -->
                <div class="mb-20 text-center">
                    <h1 class="text-5xl md:text-6xl font-bold text-zinc-900 dark:text-white mb-6">
                        Support Center
                    </h1>
                    <p class="text-xl text-zinc-600 dark:text-zinc-400 max-w-2xl mx-auto mb-8">
                        Everything you need to know about DisciFlow
                    </p>

                    <!-- Search Bar -->
                    <div class="max-w-2xl mx-auto">
                        <div class="relative">
                            <input
                                v-model="searchQuery"
                                type="text"
                                placeholder="Search for help..."
                                class="w-full px-6 py-4 pl-14 bg-white dark:bg-zinc-900 border-2 border-zinc-200 dark:border-zinc-800 rounded-2xl focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all text-zinc-900 dark:text-white placeholder-zinc-400 text-lg"
                            />
                            <svg class="absolute left-5 top-1/2 -translate-y-1/2 w-6 h-6 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Help Categories -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-24">
                    <div
                        v-for="category in categories"
                        :key="category.id"
                        class="group relative bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-3xl p-8 hover:border-amber-500 dark:hover:border-amber-600 transition-all duration-300 cursor-pointer"
                    >
                        <div class="absolute inset-0 bg-gradient-to-br from-amber-500/5 to-transparent rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative">
                            <div :class="[
                                'w-16 h-16 rounded-2xl flex items-center justify-center mb-6 transform group-hover:scale-110 transition-transform duration-300',
                                category.bgClass
                            ]">
                                <svg class="w-8 h-8" :class="category.iconClass" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="category.iconPath"/>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-zinc-900 dark:text-white mb-3">
                                {{ category.title }}
                            </h3>
                            <p class="text-zinc-600 dark:text-zinc-400 mb-6 leading-relaxed">
                                {{ category.description }}
                            </p>
                            <div class="flex items-center text-amber-600 dark:text-amber-500 font-semibold group-hover:translate-x-2 transition-transform duration-300">
                                <span>Learn more</span>
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Common Questions -->
                <div class="mb-24">
                    <div class="text-center mb-12">
                        <h2 class="text-4xl font-bold text-zinc-900 dark:text-white mb-4">
                            Common Questions
                        </h2>
                        <p class="text-lg text-zinc-600 dark:text-zinc-400">
                            Quick answers to questions you may have
                        </p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-6xl mx-auto">
                        <div
                            v-for="(faq, index) in faqs"
                            :key="index"
                            class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-2xl p-8 hover:border-amber-500 dark:hover:border-amber-600 transition-all duration-300"
                        >
                            <div class="flex items-start mb-4">
                                <div class="w-10 h-10 rounded-xl bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center mr-4 flex-shrink-0">
                                    <svg class="w-5 h-5 text-amber-600 dark:text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-zinc-900 dark:text-white leading-tight">
                                    {{ faq.question }}
                                </h3>
                            </div>
                            <p class="text-zinc-600 dark:text-zinc-400 leading-relaxed pl-14">
                                {{ faq.answer }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Contact Section -->
                <div class="bg-gradient-to-br from-amber-50 to-white dark:from-zinc-900 dark:to-black border-2 border-amber-200 dark:border-amber-900/30 rounded-3xl p-12 max-w-4xl mx-auto">
                    <div class="text-center mb-10">
                        <div class="w-16 h-16 bg-gradient-to-br from-amber-600 to-amber-800 dark:from-amber-500 dark:to-amber-700 rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <h2 class="text-3xl font-bold text-zinc-900 dark:text-white mb-3">
                            Get in Touch
                        </h2>
                        <p class="text-lg text-zinc-600 dark:text-zinc-400">
                            Can't find what you're looking for? We're here to help
                        </p>
                    </div>
                    <form @submit.prevent="handleSubmit" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-zinc-700 dark:text-zinc-300 mb-2">
                                    Your Name
                                </label>
                                <input
                                    v-model="contactForm.name"
                                    type="text"
                                    required
                                    placeholder="John Doe"
                                    class="w-full px-4 py-3.5 bg-white dark:bg-zinc-800 border-2 border-zinc-200 dark:border-zinc-700 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all text-zinc-900 dark:text-white placeholder-zinc-400"
                                />
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-zinc-700 dark:text-zinc-300 mb-2">
                                    Email Address
                                </label>
                                <input
                                    v-model="contactForm.email"
                                    type="email"
                                    required
                                    placeholder="your@email.com"
                                    class="w-full px-4 py-3.5 bg-white dark:bg-zinc-800 border-2 border-zinc-200 dark:border-zinc-700 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all text-zinc-900 dark:text-white placeholder-zinc-400"
                                />
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-zinc-700 dark:text-zinc-300 mb-2">
                                Subject
                            </label>
                            <select
                                v-model="contactForm.subject"
                                required
                                class="w-full px-4 py-3.5 bg-white dark:bg-zinc-800 border-2 border-zinc-200 dark:border-zinc-700 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all text-zinc-900 dark:text-white"
                            >
                                <option value="">Select a topic</option>
                                <option value="getting-started">Getting Started</option>
                                <option value="account">Account & Billing</option>
                                <option value="technical">Technical Issue</option>
                                <option value="feature">Feature Request</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-zinc-700 dark:text-zinc-300 mb-2">
                                Message
                            </label>
                            <textarea
                                v-model="contactForm.message"
                                required
                                rows="6"
                                placeholder="Tell us how we can help you..."
                                class="w-full px-4 py-3.5 bg-white dark:bg-zinc-800 border-2 border-zinc-200 dark:border-zinc-700 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all text-zinc-900 dark:text-white placeholder-zinc-400 resize-none"
                            ></textarea>
                        </div>

                        <button
                            type="submit"
                            class="w-full px-8 py-4 bg-gradient-to-r from-amber-600 to-amber-800 dark:from-amber-500 dark:to-amber-700 text-white font-semibold rounded-xl hover:shadow-xl hover:shadow-amber-500/30 hover:-translate-y-0.5 transition-all duration-200 text-lg"
                        >
                            Send Message
                        </button>
                    </form>
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
import Header from '@/Components/Layout/Header.vue';
import Footer from '@/Components/Layout/Footer.vue';

const searchQuery = ref('');

const categories = [
    {
        id: 'getting-started',
        title: 'Getting Started',
        description: 'Everything you need to know to start using DisciFlow effectively',
        iconPath: 'M13 10V3L4 14h7v7l9-11h-7z',
        iconClass: 'text-amber-700 dark:text-amber-500',
        bgClass: 'bg-amber-100 dark:bg-amber-900/30'
    },
    {
        id: 'trackers',
        title: 'Trackers & Features',
        description: 'Learn about all the tracking tools and features available',
        iconPath: 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z',
        iconClass: 'text-blue-700 dark:text-blue-500',
        bgClass: 'bg-blue-100 dark:bg-blue-900/30'
    },
    {
        id: 'account',
        title: 'Account & Billing',
        description: 'Manage your account settings, profile, and subscription',
        iconPath: 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z',
        iconClass: 'text-purple-700 dark:text-purple-500',
        bgClass: 'bg-purple-100 dark:bg-purple-900/30'
    }
];

const faqs = [
    {
        question: 'How do I get started with DisciFlow?',
        answer: 'Simply create an account, and you\'ll be guided through setting up your first tracker. Start with one area of your life you want to improve, and expand from there.'
    },
    {
        question: 'Can I track multiple metrics at once?',
        answer: 'Yes! DisciFlow supports unlimited trackers. You can monitor your budget, habits, tasks, goals, fitness, and more all in one place.'
    },
    {
        question: 'Is my data secure and private?',
        answer: 'Absolutely. We use industry-standard encryption to protect your data. Your information is never shared with third parties and remains completely private.'
    },
    {
        question: 'Can I export my tracking data?',
        answer: 'Yes, you can export your data in various formats including CSV and PDF for backup or analysis purposes.'
    },
    {
        question: 'Do you offer a mobile app?',
        answer: 'Our web app is fully responsive and works great on mobile devices. Native iOS and Android apps are currently in development.'
    },
    {
        question: 'What happens if I forget my password?',
        answer: 'Click on "Forgot password?" on the login page, and we\'ll send you a secure link to reset your password via email.'
    }
];

const contactForm = ref({
    name: '',
    email: '',
    subject: '',
    message: ''
});

const handleSubmit = () => {
    // TODO: Implement contact form submission
    alert('Thank you for contacting us! We\'ll get back to you soon.');
    contactForm.value = {
        name: '',
        email: '',
        subject: '',
        message: ''
    };
};
</script>

