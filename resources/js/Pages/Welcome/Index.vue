<script setup>
import { Head, Link } from '@inertiajs/vue3';
import Footer from '@/Components/Navigation/Footer.vue';
import Header from '@/Components/Navigation/Header.vue';
import axios from 'axios';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

// Test Axios functionality
const testAxios = async () => {
    try {
        const response = await axios.get('/api/test');
        console.log('Axios test successful:', response.data);
    } catch (error) {
        console.log('Axios test (expected to fail):', error.message);
    }
};

// Call test function on component mount
testAxios();
</script>

<template>
    <Head title="Welcome - Test Task Devigma" />

    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-gray-900 dark:to-gray-800">
        <!-- Header -->
        <Header />

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <!-- Hero Section -->
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">
                    Welcome to Test Task Devigma
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                    This page demonstrates the integration of modern web technologies in a single repository setup.
                </p>
            </div>

            <!-- Tech Stack Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                <!-- Laravel Card -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-red-100 dark:bg-red-900/30 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-8 h-8 text-red-600 dark:text-red-400" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Laravel</h3>
                    </div>
                    <p class="text-gray-600 dark:text-gray-300 mb-4">
                        Modern PHP framework with elegant syntax and powerful features.
                    </p>
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        Version: {{ laravelVersion }}
                    </div>
                </div>

                <!-- Vue 3 Card -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-8 h-8 text-green-600 dark:text-green-400" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Vue 3</h3>
                    </div>
                    <p class="text-gray-600 dark:text-gray-300 mb-4">
                        Progressive JavaScript framework for building user interfaces.
                    </p>
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        Composition API & Reactivity
                    </div>
                </div>

                <!-- Inertia.js Card -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-8 h-8 text-purple-600 dark:text-purple-400" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Inertia.js</h3>
                    </div>
                    <p class="text-gray-600 dark:text-gray-300 mb-4">
                        Modern monolith approach for building SPAs without API complexity.
                    </p>
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        Server-side routing
                    </div>
                </div>

                <!-- Tailwind CSS Card -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-cyan-100 dark:bg-cyan-900/30 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-8 h-8 text-cyan-600 dark:text-cyan-400" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Tailwind CSS</h3>
                    </div>
                    <p class="text-gray-600 dark:text-gray-300 mb-4">
                        Utility-first CSS framework for rapid UI development.
                    </p>
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        Responsive & Dark mode
                    </div>
                </div>

                <!-- Axios Card -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Axios</h3>
                    </div>
                    <p class="text-gray-600 dark:text-gray-300 mb-4">
                        Promise-based HTTP client for making API requests.
                    </p>
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        Interceptors & Error handling
                    </div>
                </div>

                <!-- Vite Card -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-yellow-100 dark:bg-yellow-900/30 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-8 h-8 text-yellow-600 dark:text-yellow-400" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Vite</h3>
                    </div>
                    <p class="text-gray-600 dark:text-gray-300 mb-4">
                        Next generation frontend tooling for fast development.
                    </p>
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        Hot Module Replacement
                    </div>
                </div>
            </div>

            <!-- System Info -->
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl shadow-lg p-8 text-white">
                <h3 class="text-2xl font-bold mb-6 text-center">System Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white/10 rounded-lg p-4">
                        <h4 class="font-semibold mb-2">Backend</h4>
                        <p class="text-sm opacity-90">Laravel {{ laravelVersion }}</p>
                        <p class="text-sm opacity-90">PHP {{ phpVersion }}</p>
                    </div>
                    <div class="bg-white/10 rounded-lg p-4">
                        <h4 class="font-semibold mb-2">Frontend</h4>
                        <p class="text-sm opacity-90">Vue 3 with Composition API</p>
                        <p class="text-sm opacity-90">Inertia.js for SPA experience</p>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <Footer />
    </div>
</template>
