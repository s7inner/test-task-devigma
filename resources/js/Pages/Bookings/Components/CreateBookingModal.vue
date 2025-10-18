<template>
  <div v-if="show" class="fixed inset-0 flex items-center justify-center z-50" @click="handleBackdropClick">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl p-6 w-full max-w-md mx-4" @click.stop>
      <div class="flex justify-between items-center mb-6">
        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Create New Booking</h3>
        <button 
          @click="$emit('close')"
          class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300"
        >
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>

      <form @submit.prevent="handleSubmit" class="space-y-4">
        <!-- Date Picker -->
        <div>
          <label for="date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Date
          </label>
          <input
            id="date"
            v-model="formData.date"
            type="date"
            :min="today"
            required
            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white"
          />
        </div>

        <!-- Time Slot Select -->
        <div>
          <label for="time_slot" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Time Slot
          </label>
          <select
            id="time_slot"
            v-model="formData.time_slot"
            required
            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white"
          >
            <option value="">Select a time slot</option>
            <option v-for="slot in timeSlots" :key="slot" :value="slot">
              {{ slot }}
            </option>
          </select>
        </div>

        <!-- Error Message -->
        <div v-if="error" class="text-red-600 dark:text-red-400 text-sm">
          {{ error }}
        </div>

        <!-- Form Actions -->
        <div class="flex gap-3 pt-4">
          <button
            type="button"
            @click="$emit('close')"
            class="flex-1 px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200"
          >
            Cancel
          </button>
          <button
            type="submit"
            :disabled="loading"
            class="flex-1 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 disabled:bg-indigo-400 text-white rounded-lg transition-colors duration-200 flex items-center justify-center gap-2"
          >
            <svg v-if="loading" class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            {{ loading ? 'Creating...' : 'Create Booking' }}
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref, watch } from 'vue';

const props = defineProps({
  show: {
    type: Boolean,
    required: true
  },
  loading: {
    type: Boolean,
    default: false
  },
  error: {
    type: String,
    default: null
  }
});

const emit = defineEmits(['close', 'submit']);

const formData = ref({
  date: '',
  time_slot: ''
});

const timeSlots = [
  '09:00', '10:00', '11:00', '12:00',
  '13:00', '14:00', '15:00', '16:00'
];

const today = new Date().toISOString().split('T')[0];

const handleSubmit = () => {
  emit('submit', formData.value);
};

const handleBackdropClick = () => {
  emit('close');
};

// Reset form when modal closes
watch(() => props.show, (newValue) => {
  if (!newValue) {
    formData.value = {
      date: '',
      time_slot: ''
    };
  }
});
</script>
