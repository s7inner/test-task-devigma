<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { useBookings } from '@/composables/useBookings';

const { bookings, loading, error, fetchBookings } = useBookings();

const formatDate = (dateString) => {
    return new Date(dateString).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
};

const getStatusBadge = (status) => {
    return status === 'booked' 
        ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400'
        : 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400';
};

const getStatusText = (status) => {
    return status === 'booked' ? 'Booked' : 'Cancelled';
};
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
                My Bookings
            </h1>
            <p class="text-lg text-gray-600 dark:text-gray-300">
                View and manage your appointments
            </p>
        </div>

        <!-- Bookings Table -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
            <!-- Loading State -->
            <div v-if="loading" class="p-8 text-center">
                <div class="inline-flex items-center">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Loading bookings...
                </div>
            </div>

            <!-- Error State -->
            <div v-else-if="error" class="p-8 text-center">
                <div class="text-red-600 dark:text-red-400 mb-4">
                    <svg class="w-12 h-12 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ error }}
                </div>
                <button @click="fetchBookings" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 font-medium">
                    Try again
                </button>
            </div>

            <!-- Empty State -->
            <div v-else-if="bookings.length === 0" class="p-8 text-center">
                <svg class="w-16 h-16 mx-auto text-gray-400 dark:text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No bookings yet</h3>
                <p class="text-gray-600 dark:text-gray-300">You haven't made any bookings yet.</p>
            </div>

            <!-- Bookings Table -->
            <div v-else class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Date
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Time
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Created
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        <tr v-for="booking in bookings" :key="booking.id" class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                {{ formatDate(booking.date) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                {{ booking.time_slot }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span :class="getStatusBadge(booking.status)" class="inline-flex px-2 py-1 text-xs font-semibold rounded-full">
                                    {{ getStatusText(booking.status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                {{ new Date(booking.created_at).toLocaleDateString('en-US') }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="mt-8 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl shadow-lg p-6 text-white">
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
