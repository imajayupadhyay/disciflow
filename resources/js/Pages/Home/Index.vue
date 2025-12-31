<template>
    <div class="min-h-screen flex flex-col bg-white dark:bg-black transition-colors duration-500">
        <Header />

        <main class="flex-grow">
            <Hero />
            <Trackers />
        </main>

        <Footer />
    </div>
</template>

<script setup>
import Header from '@/Components/Layout/Header.vue';
import Footer from '@/Components/Layout/Footer.vue';
import Hero from './Hero.vue';
import Trackers from './Trackers.vue';
</script>
