import { ref } from 'vue';
import axios from 'axios';
import { route } from 'ziggy-js';

export function useCancelBooking() {
    const loading = ref(false);
    const error = ref(null);

    const cancelBooking = async (bookingId) => {
        loading.value = true;
        error.value = null;
        
        try {
            const response = await axios.patch(route('bookings.cancel', { id: bookingId }));
            return response.data;
        } catch (err) {
            error.value = err.response?.data?.message || 'Failed to cancel booking';
            throw err; // Re-throw to allow component to handle
        } finally {
            loading.value = false;
        }
    };

    return {
        loading,
        error,
        cancelBooking
    };
}
