<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

// Get authenticated user
const authUser = computed(() => usePage().props.auth.user);
</script>

<template>
  <GuestLayout>
    <div class="min-h-screen flex flex-col">
      <!-- Hero Section -->
      <div class="w-full max-w-[90%] xl:max-w-[1280px] mx-auto text-center py-16 px-6 md:px-12 lg:px-20">
        <h1 class="text-3xl md:text-5xl font-bold text-gray-900 leading-tight">
          Fast & Reliable Logistics Services 🚚
        </h1>
        <p class="mt-4 text-lg md:text-xl text-gray-600">
          Track your packages and request deliveries with ease.
        </p>

        <!-- Action Buttons -->
        <div class="mt-8 flex flex-col md:flex-row justify-center md:space-x-6 space-y-4 md:space-y-0">
          <PrimaryButton :href="route('tracking')" class="w-full md:w-auto">Track Package</PrimaryButton>
          <PrimaryButton :href="route('request.delivery')" class="w-full md:w-auto">Request Delivery</PrimaryButton>
        </div>
      </div>

      <!-- Company Info Section -->
      <div class="w-full bg-white shadow-md py-12 px-6 md:px-12 lg:px-20">
        <div class="max-w-[90%] xl:max-w-[1280px] mx-auto">
          <h2 class="text-2xl md:text-3xl font-semibold text-gray-900 text-center">
            Why Choose Us?
          </h2>
          <p class="mt-4 text-gray-600 text-center">
            We provide fast, secure, and reliable package delivery services across the country.
          </p>

          <!-- Features Grid -->
          <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="p-6 bg-gray-100 rounded-lg shadow-sm text-center">
              <h3 class="text-xl font-semibold text-gray-900">📦 Secure Deliveries</h3>
              <p class="mt-2 text-gray-600">Your packages are safe with us.</p>
            </div>
            <div class="p-6 bg-gray-100 rounded-lg shadow-sm text-center">
              <h3 class="text-xl font-semibold text-gray-900">⏱️ On-Time Shipments</h3>
              <p class="mt-2 text-gray-600">We ensure your deliveries arrive on time.</p>
            </div>
            <div class="p-6 bg-gray-100 rounded-lg shadow-sm text-center">
              <h3 class="text-xl font-semibold text-gray-900">🌍 Nationwide Coverage</h3>
              <p class="mt-2 text-gray-600">We deliver across the country.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </GuestLayout>
</template>
