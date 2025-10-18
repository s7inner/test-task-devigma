import { ref } from 'vue';
import axios from 'axios';
import { route } from 'ziggy-js';

export function useCreateBooking() {
    const loading = ref(false);
    const error = ref(null);

    const createBooking = async (bookingData) => {
        loading.value = true;
        error.value = null;
        
        try {
            const response = await axios.post(route('bookings.store'), bookingData);
            return response.data;
        } catch (err) {
            error.value = err.response?.data?.message || 'Failed to create booking';
            throw err;
        } finally {
            loading.value = false;
        }
    };

    return {
        loading,
        error,
        createBooking
    };
}
