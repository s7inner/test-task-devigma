<script setup>
import Footer from '@/Components/Navigation/Footer.vue';
import Header from '@/Components/Navigation/Header.vue';
</script>

<template>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-gray-900 dark:to-gray-800">
        <!-- Header -->
        <Header />

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <slot />
        </main>

        <!-- Footer -->
        <Footer />
    </div>
</template>
