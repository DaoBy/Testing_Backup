<script setup>
import { ref } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

// Tracking input and results
const trackingCode = ref('');
const trackingData = ref(null);
const errorMessage = ref('');

// Mock tracking data (Replace this with real API call)
const mockTrackingData = {
  "ABC123": {
    status: "In Transit",
    lastLocation: "Warehouse - Manila",
    estimatedDelivery: "2025-02-25",
    history: [
      { date: "2025-02-18", location: "Warehouse - Manila", status: "Processed" },
      { date: "2025-02-19", location: "Manila Hub", status: "Dispatched" },
      { date: "2025-02-20", location: "In Transit", status: "On the way to destination" }
    ]
  }
};

// Function to fetch tracking details
const trackPackage = () => {
  if (mockTrackingData[trackingCode.value]) {
    trackingData.value = mockTrackingData[trackingCode.value];
    errorMessage.value = '';
  } else {
    trackingData.value = null;
    errorMessage.value = 'Invalid tracking code. Please try again.';
  }
};
</script>

<template>
  <div class="container mx-auto px-6 py-12">
    <h1 class="text-3xl font-bold text-center">Track Your Package</h1>
    <p class="mt-2 text-gray-600 text-center">Enter your tracking code to check the status of your package.</p>

    <!-- Track Form -->
    <div class="mt-6 max-w-lg mx-auto flex space-x-2">
      <TextInput v-model="trackingCode" placeholder="Enter Tracking Code" class="flex-1" />
      <PrimaryButton @click="trackPackage">Track</PrimaryButton>
    </div>
    
    <!-- Error Message -->
    <p v-if="errorMessage" class="text-red-500 text-center mt-2">{{ errorMessage }}</p>

    <!-- Tracking Results -->
    <div v-if="trackingData" class="mt-8 bg-white shadow-md p-6 rounded-lg">
      <h2 class="text-2xl font-bold">Tracking Results</h2>

      <p class="mt-2"><strong>Status:</strong> {{ trackingData.status }}</p>
      <p><strong>Last Location:</strong> {{ trackingData.lastLocation }}</p>
      <p><strong>Estimated Delivery:</strong> {{ trackingData.estimatedDelivery }}</p>

      <!-- Tracking History -->
      <h3 class="mt-4 font-semibold">Tracking History</h3>
      <ul class="mt-2 border-t border-gray-200 pt-2">
        <li v-for="(item, index) in trackingData.history" :key="index" class="py-2">
          <span class="font-medium">{{ item.date }}</span> - {{ item.location }} ({{ item.status }})
        </li>
      </ul>
    </div>
  </div>
</template>
