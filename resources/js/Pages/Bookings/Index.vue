<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import { useBookings } from './Composables/useBookings';
import { useCreateBooking } from './Composables/useCreateBooking';
import { useCancelBooking } from './Composables/useCancelBooking';
import BookingsTable from './Components/BookingsTable.vue';
import CreateBookingModal from './Components/CreateBookingModal.vue';

const { bookings, loading, error, fetchBookings, addBooking, updateBookingStatus } = useBookings();
const { loading: creating, error: createError, createBooking } = useCreateBooking();
const { loading: cancelling, error: cancelError, cancelBooking } = useCancelBooking();

const showCreateForm = ref(false);
const cancellingBookingId = ref(null);

const handleCreateBooking = async (formData) => {
    try {
        const newBooking = await createBooking(formData);
        // Add new booking to local state instead of refreshing
        addBooking(newBooking.data);
        showCreateForm.value = false;
    } catch (err) {
        // Error is handled by the composable
    }
};

const handleCancelBooking = async (bookingId) => {
    try {
        cancellingBookingId.value = bookingId;
        await cancelBooking(bookingId);
        // Update booking status locally instead of refreshing
        updateBookingStatus(bookingId, 'cancelled');
    } catch (err) {
        // Error is handled by the composable
    } finally {
        cancellingBookingId.value = null;
    }
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

        <!-- Create Booking Button -->
        <div class="mb-6 flex justify-end">
            <button 
                @click="showCreateForm = true"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center gap-2"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Create New Booking
            </button>
        </div>

        <!-- Bookings Table -->
        <BookingsTable 
            :bookings="bookings"
            :loading="loading"
            :error="error"
            :cancelling-booking-id="cancellingBookingId"
            @retry="fetchBookings"
            @cancel-booking="handleCancelBooking"
        />

        <!-- Create Booking Modal -->
        <CreateBookingModal
            :show="showCreateForm"
            :loading="creating"
            :error="createError"
            @close="showCreateForm = false"
            @submit="handleCreateBooking"
        />

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
