<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Bookings" />

    <AppLayout>
        <!-- Hero Section -->
        <div class="text-center mb-8">
            <div class="w-20 h-20 bg-indigo-100 dark:bg-indigo-900/30 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">
                Bookings
            </h1>
            <p class="text-lg text-gray-600 dark:text-gray-300">
                Manage your appointments and reservations
            </p>
        </div>

        <!-- Booking Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <!-- Create Booking Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center mr-4">
                        <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Create Booking</h3>
                </div>
                <p class="text-gray-600 dark:text-gray-300 mb-4">
                    Schedule a new appointment with date picker and time slot selection.
                </p>
                <div class="text-sm text-green-600 dark:text-green-400 font-medium">
                    🚀 Coming Soon
                </div>
            </div>

            <!-- View Bookings Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center mr-4">
                        <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">View Bookings</h3>
                </div>
                <p class="text-gray-600 dark:text-gray-300 mb-4">
                    See all your current and upcoming appointments in a organized list.
                </p>
                <div class="text-sm text-blue-600 dark:text-blue-400 font-medium">
                    📋 Coming Soon
                </div>
            </div>

            <!-- Cancel Bookings Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-red-100 dark:bg-red-900/30 rounded-lg flex items-center justify-center mr-4">
                        <svg class="w-8 h-8 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Cancel Bookings</h3>
                </div>
                <p class="text-gray-600 dark:text-gray-300 mb-4">
                    Cancel or reschedule your existing appointments when needed.
                </p>
                <div class="text-sm text-red-600 dark:text-red-400 font-medium">
                    ❌ Coming Soon
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl shadow-lg p-6 text-white">
            <h3 class="text-xl font-bold mb-4 text-center">Quick Actions</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-white/10 rounded-lg p-4">
                    <h4 class="font-semibold mb-2">Create New Booking</h4>
                    <p class="text-sm opacity-90">Schedule your next appointment with our easy booking system</p>
                </div>
                <div class="bg-white/10 rounded-lg p-4">
                    <h4 class="font-semibold mb-2">Manage Existing</h4>
                    <p class="text-sm opacity-90">View, modify, or cancel your current bookings</p>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
