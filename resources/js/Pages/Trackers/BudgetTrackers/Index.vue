<template>
    <Head>
        <title>Budget Tracker - Master Your Finances | Disciflow</title>
        <meta name="description" content="Track income, expenses, and budgets with our comprehensive Budget Tracker. Set spending limits, manage categories, receive smart alerts, and export detailed financial reports." />
        <meta name="keywords" content="budget tracker, expense tracker, income tracker, financial planning, budget planner, spending tracker, money management, personal finance" />

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website" />
        <meta property="og:title" content="Budget Tracker - Master Your Finances" />
        <meta property="og:description" content="Track income, expenses, and budgets with detailed categorization and smart alerts." />
        <meta property="og:site_name" content="Disciflow" />

        <!-- Twitter Card -->
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:title" content="Budget Tracker - Master Your Finances" />
        <meta name="twitter:description" content="Track income, expenses, and budgets with detailed categorization and smart alerts." />

        <!-- Additional SEO Tags -->
        <meta name="robots" content="index, follow" />
        <meta name="author" content="Disciflow" />
        <link rel="canonical" href="https://disciflow.com/trackers/budget-tracker" />
    </Head>

    <div class="min-h-screen flex flex-col bg-white dark:bg-black transition-colors duration-500 relative overflow-hidden">
        <!-- Background SVG Pattern -->
        <div class="absolute inset-0 pointer-events-none">
            <!-- Grid Pattern -->
            <svg class="absolute inset-0 w-full h-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="grid" width="32" height="32" patternUnits="userSpaceOnUse">
                        <path d="M 32 0 L 0 0 0 32" fill="none" stroke="currentColor" class="text-zinc-200/30 dark:text-zinc-800/30" stroke-width="0.5"/>
                    </pattern>
                    <linearGradient id="gradient1" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" class="text-amber-500/10 dark:text-amber-600/5" style="stop-color:currentColor"/>
                        <stop offset="100%" class="text-transparent" style="stop-color:currentColor"/>
                    </linearGradient>
                    <radialGradient id="radial1" cx="30%" cy="20%">
                        <stop offset="0%" class="text-amber-500/20 dark:text-amber-600/10" style="stop-color:currentColor"/>
                        <stop offset="100%" class="text-transparent" style="stop-color:currentColor"/>
                    </radialGradient>
                    <radialGradient id="radial2" cx="70%" cy="80%">
                        <stop offset="0%" class="text-amber-500/15 dark:text-amber-600/8" style="stop-color:currentColor"/>
                        <stop offset="100%" class="text-transparent" style="stop-color:currentColor"/>
                    </radialGradient>
                </defs>
                <rect width="100%" height="100%" fill="url(#grid)" />
                <rect width="100%" height="100%" fill="url(#gradient1)" />
                <circle cx="30%" cy="20%" r="300" fill="url(#radial1)" />
                <circle cx="70%" cy="80%" r="400" fill="url(#radial2)" />
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

        <main class="flex-grow pt-32 pb-16 relative z-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Hero Section -->
                <div class="text-center mb-16">
                    <div class="inline-flex items-center space-x-2 bg-amber-100 dark:bg-amber-900/30 px-4 py-2 rounded-full mb-6">
                        <svg class="w-5 h-5 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                        <span class="text-sm font-semibold text-amber-800 dark:text-amber-300">Most Popular Tracker</span>
                    </div>

                    <h1 class="text-5xl md:text-6xl font-bold text-zinc-900 dark:text-white mb-6">
                        Budget Tracker
                    </h1>

                    <p class="text-xl text-zinc-600 dark:text-zinc-400 max-w-3xl mx-auto mb-8">
                        Take complete control of your finances with powerful income and expense tracking, smart budgets, and actionable insights
                    </p>

                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                        <a
                            :href="pricingUrl"
                            class="px-8 py-4 bg-gradient-to-r from-amber-600 to-amber-800 dark:from-amber-500 dark:to-amber-700 text-white font-semibold rounded-xl hover:shadow-xl hover:shadow-amber-500/30 transition-all duration-200 flex items-center space-x-2"
                        >
                            <span>Get Started Now</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </a>
                        <button
                            @click="scrollToFeatures"
                            class="px-8 py-4 border-2 border-zinc-300 dark:border-zinc-700 text-zinc-700 dark:text-zinc-300 font-semibold rounded-xl hover:bg-zinc-50 dark:hover:bg-zinc-900 transition-all duration-200"
                        >
                            Explore Features
                        </button>
                    </div>
                </div>

                <!-- Key Stats -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-20">
                    <div class="bg-white dark:bg-zinc-900 rounded-xl border border-zinc-200 dark:border-zinc-800 p-6 text-center">
                        <div class="text-3xl font-bold text-amber-600 dark:text-amber-500 mb-2">7</div>
                        <div class="text-sm text-zinc-600 dark:text-zinc-400">Powerful Features</div>
                    </div>
                    <div class="bg-white dark:bg-zinc-900 rounded-xl border border-zinc-200 dark:border-zinc-800 p-6 text-center">
                        <div class="text-3xl font-bold text-green-600 dark:text-green-500 mb-2">Unlimited</div>
                        <div class="text-sm text-zinc-600 dark:text-zinc-400">Transactions</div>
                    </div>
                    <div class="bg-white dark:bg-zinc-900 rounded-xl border border-zinc-200 dark:border-zinc-800 p-6 text-center">
                        <div class="text-3xl font-bold text-blue-600 dark:text-blue-500 mb-2">2</div>
                        <div class="text-sm text-zinc-600 dark:text-zinc-400">Export Formats</div>
                    </div>
                    <div class="bg-white dark:bg-zinc-900 rounded-xl border border-zinc-200 dark:border-zinc-800 p-6 text-center">
                        <div class="text-3xl font-bold text-purple-600 dark:text-purple-500 mb-2">Real-time</div>
                        <div class="text-sm text-zinc-600 dark:text-zinc-400">Updates</div>
                    </div>
                </div>

                <!-- Features Section -->
                <div ref="featuresSection" class="mb-20">
                    <div class="text-center mb-12">
                        <h2 class="text-4xl font-bold text-zinc-900 dark:text-white mb-4">
                            Everything You Need to Master Your Finances
                        </h2>
                        <p class="text-lg text-zinc-600 dark:text-zinc-400 max-w-2xl mx-auto">
                            Our comprehensive suite of tools helps you track, analyze, and optimize your spending habits
                        </p>
                    </div>

                    <!-- Feature Cards Grid -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
                        <!-- Dashboard Feature -->
                        <div class="group bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-200 dark:border-zinc-800 p-8 hover:shadow-2xl hover:shadow-amber-500/10 hover:border-amber-300 dark:hover:border-amber-700 transition-all duration-300">
                            <div class="flex items-start space-x-4">
                                <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-2xl font-bold text-zinc-900 dark:text-white mb-3">Customizable Dashboard</h3>
                                    <p class="text-zinc-600 dark:text-zinc-400 mb-4">
                                        Get a complete financial overview at a glance with customizable widgets and interactive charts
                                    </p>
                                    <ul class="space-y-2">
                                        <li class="flex items-center text-sm text-zinc-600 dark:text-zinc-400">
                                            <svg class="w-4 h-4 mr-2 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            <span>Summary cards (Income, Expenses, Balance)</span>
                                        </li>
                                        <li class="flex items-center text-sm text-zinc-600 dark:text-zinc-400">
                                            <svg class="w-4 h-4 mr-2 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            <span>Income vs Expenses chart</span>
                                        </li>
                                        <li class="flex items-center text-sm text-zinc-600 dark:text-zinc-400">
                                            <svg class="w-4 h-4 mr-2 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            <span>Category spending breakdown</span>
                                        </li>
                                        <li class="flex items-center text-sm text-zinc-600 dark:text-zinc-400">
                                            <svg class="w-4 h-4 mr-2 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            <span>Payment method analytics</span>
                                        </li>
                                        <li class="flex items-center text-sm text-zinc-600 dark:text-zinc-400">
                                            <svg class="w-4 h-4 mr-2 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            <span>Budget progress tracking</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Budgets Feature -->
                        <div class="group bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-200 dark:border-zinc-800 p-8 hover:shadow-2xl hover:shadow-amber-500/10 hover:border-amber-300 dark:hover:border-amber-700 transition-all duration-300">
                            <div class="flex items-start space-x-4">
                                <div class="w-14 h-14 bg-gradient-to-br from-amber-500 to-orange-600 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-2xl font-bold text-zinc-900 dark:text-white mb-3">Smart Budget Planning</h3>
                                    <p class="text-zinc-600 dark:text-zinc-400 mb-4">
                                        Set spending limits per category and track your progress with visual indicators
                                    </p>
                                    <ul class="space-y-2">
                                        <li class="flex items-center text-sm text-zinc-600 dark:text-zinc-400">
                                            <svg class="w-4 h-4 mr-2 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            <span>Multiple period options (Daily, Weekly, Monthly, Yearly)</span>
                                        </li>
                                        <li class="flex items-center text-sm text-zinc-600 dark:text-zinc-400">
                                            <svg class="w-4 h-4 mr-2 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            <span>Color-coded progress bars</span>
                                        </li>
                                        <li class="flex items-center text-sm text-zinc-600 dark:text-zinc-400">
                                            <svg class="w-4 h-4 mr-2 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            <span>Budget vs spent tracking</span>
                                        </li>
                                        <li class="flex items-center text-sm text-zinc-600 dark:text-zinc-400">
                                            <svg class="w-4 h-4 mr-2 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            <span>Custom date ranges</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Categories Feature -->
                        <div class="group bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-200 dark:border-zinc-800 p-8 hover:shadow-2xl hover:shadow-amber-500/10 hover:border-amber-300 dark:hover:border-amber-700 transition-all duration-300">
                            <div class="flex items-start space-x-4">
                                <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-2xl font-bold text-zinc-900 dark:text-white mb-3">Custom Categories</h3>
                                    <p class="text-zinc-600 dark:text-zinc-400 mb-4">
                                        Organize your finances with flexible, customizable categories for income and expenses
                                    </p>
                                    <ul class="space-y-2">
                                        <li class="flex items-center text-sm text-zinc-600 dark:text-zinc-400">
                                            <svg class="w-4 h-4 mr-2 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            <span>30+ pre-defined category suggestions</span>
                                        </li>
                                        <li class="flex items-center text-sm text-zinc-600 dark:text-zinc-400">
                                            <svg class="w-4 h-4 mr-2 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            <span>Create unlimited custom categories</span>
                                        </li>
                                        <li class="flex items-center text-sm text-zinc-600 dark:text-zinc-400">
                                            <svg class="w-4 h-4 mr-2 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            <span>Personalize with colors</span>
                                        </li>
                                        <li class="flex items-center text-sm text-zinc-600 dark:text-zinc-400">
                                            <svg class="w-4 h-4 mr-2 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            <span>Separate income and expense categories</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Transactions Feature -->
                        <div class="group bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-200 dark:border-zinc-800 p-8 hover:shadow-2xl hover:shadow-amber-500/10 hover:border-amber-300 dark:hover:border-amber-700 transition-all duration-300">
                            <div class="flex items-start space-x-4">
                                <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-2xl font-bold text-zinc-900 dark:text-white mb-3">Transaction Management</h3>
                                    <p class="text-zinc-600 dark:text-zinc-400 mb-4">
                                        Track every income and expense with detailed information and powerful filtering
                                    </p>
                                    <ul class="space-y-2">
                                        <li class="flex items-center text-sm text-zinc-600 dark:text-zinc-400">
                                            <svg class="w-4 h-4 mr-2 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            <span>Add income and expense transactions</span>
                                        </li>
                                        <li class="flex items-center text-sm text-zinc-600 dark:text-zinc-400">
                                            <svg class="w-4 h-4 mr-2 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            <span>Filter by date, category, payment method</span>
                                        </li>
                                        <li class="flex items-center text-sm text-zinc-600 dark:text-zinc-400">
                                            <svg class="w-4 h-4 mr-2 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            <span>Add descriptions and notes</span>
                                        </li>
                                        <li class="flex items-center text-sm text-zinc-600 dark:text-zinc-400">
                                            <svg class="w-4 h-4 mr-2 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            <span>Edit and delete transactions</span>
                                        </li>
                                        <li class="flex items-center text-sm text-zinc-600 dark:text-zinc-400">
                                            <svg class="w-4 h-4 mr-2 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            <span>Pagination for large datasets</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Alerts Feature -->
                        <div class="group bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-200 dark:border-zinc-800 p-8 hover:shadow-2xl hover:shadow-amber-500/10 hover:border-amber-300 dark:hover:border-amber-700 transition-all duration-300">
                            <div class="flex items-start space-x-4">
                                <div class="w-14 h-14 bg-gradient-to-br from-red-500 to-rose-600 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-2xl font-bold text-zinc-900 dark:text-white mb-3">Smart Budget Alerts</h3>
                                    <p class="text-zinc-600 dark:text-zinc-400 mb-4">
                                        Stay on track with intelligent alerts that notify you when you're approaching spending limits
                                    </p>
                                    <ul class="space-y-2">
                                        <li class="flex items-center text-sm text-zinc-600 dark:text-zinc-400">
                                            <svg class="w-4 h-4 mr-2 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            <span>Budget exceeded alerts</span>
                                        </li>
                                        <li class="flex items-center text-sm text-zinc-600 dark:text-zinc-400">
                                            <svg class="w-4 h-4 mr-2 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            <span>Category spending limit warnings</span>
                                        </li>
                                        <li class="flex items-center text-sm text-zinc-600 dark:text-zinc-400">
                                            <svg class="w-4 h-4 mr-2 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            <span>Large transaction alerts</span>
                                        </li>
                                        <li class="flex items-center text-sm text-zinc-600 dark:text-zinc-400">
                                            <svg class="w-4 h-4 mr-2 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            <span>Email notifications</span>
                                        </li>
                                        <li class="flex items-center text-sm text-zinc-600 dark:text-zinc-400">
                                            <svg class="w-4 h-4 mr-2 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            <span>Customizable alert frequency</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Methods Feature -->
                        <div class="group bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-200 dark:border-zinc-800 p-8 hover:shadow-2xl hover:shadow-amber-500/10 hover:border-amber-300 dark:hover:border-amber-700 transition-all duration-300">
                            <div class="flex items-start space-x-4">
                                <div class="w-14 h-14 bg-gradient-to-br from-pink-500 to-purple-600 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-2xl font-bold text-zinc-900 dark:text-white mb-3">Payment Methods</h3>
                                    <p class="text-zinc-600 dark:text-zinc-400 mb-4">
                                        Track how you pay with comprehensive payment method management
                                    </p>
                                    <ul class="space-y-2">
                                        <li class="flex items-center text-sm text-zinc-600 dark:text-zinc-400">
                                            <svg class="w-4 h-4 mr-2 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            <span>12+ pre-defined payment methods</span>
                                        </li>
                                        <li class="flex items-center text-sm text-zinc-600 dark:text-zinc-400">
                                            <svg class="w-4 h-4 mr-2 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            <span>Custom payment methods</span>
                                        </li>
                                        <li class="flex items-center text-sm text-zinc-600 dark:text-zinc-400">
                                            <svg class="w-4 h-4 mr-2 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            <span>Track spending by payment method</span>
                                        </li>
                                        <li class="flex items-center text-sm text-zinc-600 dark:text-zinc-400">
                                            <svg class="w-4 h-4 mr-2 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            <span>Color coding for easy identification</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Export Feature -->
                        <div class="group bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-200 dark:border-zinc-800 p-8 hover:shadow-2xl hover:shadow-amber-500/10 hover:border-amber-300 dark:hover:border-amber-700 transition-all duration-300 lg:col-span-2">
                            <div class="flex items-start space-x-4">
                                <div class="w-14 h-14 bg-gradient-to-br from-indigo-500 to-blue-600 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-2xl font-bold text-zinc-900 dark:text-white mb-3">Powerful Export & Reports</h3>
                                    <p class="text-zinc-600 dark:text-zinc-400 mb-4">
                                        Generate detailed financial reports and export your data in multiple formats
                                    </p>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <ul class="space-y-2">
                                            <li class="flex items-center text-sm text-zinc-600 dark:text-zinc-400">
                                                <svg class="w-4 h-4 mr-2 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                <span>Export to Excel (.xlsx)</span>
                                            </li>
                                            <li class="flex items-center text-sm text-zinc-600 dark:text-zinc-400">
                                                <svg class="w-4 h-4 mr-2 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                <span>Export to PDF</span>
                                            </li>
                                            <li class="flex items-center text-sm text-zinc-600 dark:text-zinc-400">
                                                <svg class="w-4 h-4 mr-2 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                <span>Filter by transaction type</span>
                                            </li>
                                        </ul>
                                        <ul class="space-y-2">
                                            <li class="flex items-center text-sm text-zinc-600 dark:text-zinc-400">
                                                <svg class="w-4 h-4 mr-2 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                <span>Filter by category</span>
                                            </li>
                                            <li class="flex items-center text-sm text-zinc-600 dark:text-zinc-400">
                                                <svg class="w-4 h-4 mr-2 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                <span>Filter by payment method</span>
                                            </li>
                                            <li class="flex items-center text-sm text-zinc-600 dark:text-zinc-400">
                                                <svg class="w-4 h-4 mr-2 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                <span>Custom date range selection</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CTA Section -->
                <div class="bg-gradient-to-r from-amber-600 to-amber-800 dark:from-amber-500 dark:to-amber-700 rounded-3xl p-12 text-center mb-16">
                    <h2 class="text-4xl font-bold text-white mb-4">
                        Ready to Take Control of Your Finances?
                    </h2>
                    <p class="text-xl text-amber-50 mb-8 max-w-2xl mx-auto">
                        Start tracking your income and expenses today with our comprehensive budget tracker
                    </p>
                    <a
                        :href="pricingUrl"
                        class="inline-flex items-center space-x-2 px-8 py-4 bg-white text-amber-700 font-bold rounded-xl hover:bg-amber-50 transition-all duration-200 shadow-xl hover:shadow-2xl"
                    >
                        <span>View Pricing Plans</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                </div>

                <!-- FAQ Section -->
                <div class="mb-16">
                    <div class="text-center mb-12">
                        <h2 class="text-4xl font-bold text-zinc-900 dark:text-white mb-4">
                            Frequently Asked Questions
                        </h2>
                    </div>

                    <div class="max-w-3xl mx-auto space-y-4">
                        <div class="bg-white dark:bg-zinc-900 rounded-xl border border-zinc-200 dark:border-zinc-800 p-6">
                            <h3 class="text-lg font-bold text-zinc-900 dark:text-white mb-2">
                                How many transactions can I add?
                            </h3>
                            <p class="text-zinc-600 dark:text-zinc-400">
                                You can add unlimited transactions. Our Budget Tracker is designed to scale with your financial tracking needs, whether you have 10 or 10,000 transactions.
                            </p>
                        </div>

                        <div class="bg-white dark:bg-zinc-900 rounded-xl border border-zinc-200 dark:border-zinc-800 p-6">
                            <h3 class="text-lg font-bold text-zinc-900 dark:text-white mb-2">
                                Can I customize the categories?
                            </h3>
                            <p class="text-zinc-600 dark:text-zinc-400">
                                Absolutely! While we provide 30+ pre-defined category suggestions, you can create unlimited custom categories tailored to your specific needs and personalize them with colors.
                            </p>
                        </div>

                        <div class="bg-white dark:bg-zinc-900 rounded-xl border border-zinc-200 dark:border-zinc-800 p-6">
                            <h3 class="text-lg font-bold text-zinc-900 dark:text-white mb-2">
                                How do budget alerts work?
                            </h3>
                            <p class="text-zinc-600 dark:text-zinc-400">
                                Budget alerts monitor your spending in real-time and notify you when you're approaching or exceeding your budget limits. You can set alerts based on percentage or fixed amounts, and receive notifications via email.
                            </p>
                        </div>

                        <div class="bg-white dark:bg-zinc-900 rounded-xl border border-zinc-200 dark:border-zinc-800 p-6">
                            <h3 class="text-lg font-bold text-zinc-900 dark:text-white mb-2">
                                Can I export my financial data?
                            </h3>
                            <p class="text-zinc-600 dark:text-zinc-400">
                                Yes! You can export your transaction data to Excel (.xlsx) or PDF format. The export feature supports filtering by transaction type, category, payment method, and custom date ranges.
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

const pricingUrl = '/pricing';
const featuresSection = ref(null);

const scrollToFeatures = () => {
    if (featuresSection.value) {
        featuresSection.value.scrollIntoView({ behavior: 'smooth' });
    }
};
</script>
