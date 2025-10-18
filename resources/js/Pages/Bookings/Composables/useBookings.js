import { ref, onMounted } from 'vue';
import axios from 'axios';
import { route } from 'ziggy-js';

export function useBookings() {
    const bookings = ref([]);
    const loading = ref(false);
    const error = ref(null);

    const fetchBookings = async () => {
        loading.value = true;
        error.value = null;
        
        try {
            const response = await axios.get(route('bookings.index'));
            bookings.value = response.data.data;
        } catch (err) {
            error.value = err.response?.data?.message || 'Failed to fetch bookings';
            console.error('Error fetching bookings:', err);
        } finally {
            loading.value = false;
        }
    };

    onMounted(() => {
        fetchBookings();
    });

    return {
        bookings,
        loading,
        error,
        fetchBookings
    };
}
