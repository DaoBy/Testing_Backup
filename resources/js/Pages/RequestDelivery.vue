<script setup>
import { ref } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';

// Form fields
const form = ref({
  senderName: '',
  senderAddress: '',
  recipientName: '',
  recipientAddress: '',
  packageDetails: '',
  contactNumber: ''
});

// Validation errors
const errors = ref({});

// Handle form submission
const submitRequest = () => {
  errors.value = {};

  // Basic validation
  if (!form.value.senderName) errors.value.senderName = "Sender's name is required.";
  if (!form.value.senderAddress) errors.value.senderAddress = "Sender's address is required.";
  if (!form.value.recipientName) errors.value.recipientName = "Recipient's name is required.";
  if (!form.value.recipientAddress) errors.value.recipientAddress = "Recipient's address is required.";
  if (!form.value.packageDetails) errors.value.packageDetails = "Package details are required.";
  if (!form.value.contactNumber) errors.value.contactNumber = "Contact number is required.";

  // If no errors, send request
  if (Object.keys(errors.value).length === 0) {
    alert('Delivery request submitted! (Replace this with actual backend submission)');
  }
};
</script>

<template>
  <div class="container mx-auto px-6 py-12">
    <h1 class="text-3xl font-bold text-center">Request a Delivery</h1>
    <p class="mt-2 text-gray-600 text-center">Fill out the form below to request a delivery.</p>

    <!-- Form -->
    <div class="mt-6 max-w-lg mx-auto bg-white shadow-md p-6 rounded-lg space-y-4">
      <!-- Sender Information -->
      <div>
        <InputLabel for="senderName" value="Sender's Name" />
        <TextInput id="senderName" v-model="form.senderName" class="w-full" />
        <InputError v-if="errors.senderName" :message="errors.senderName" />
      </div>

      <div>
        <InputLabel for="senderAddress" value="Sender's Address" />
        <TextInput id="senderAddress" v-model="form.senderAddress" class="w-full" />
        <InputError v-if="errors.senderAddress" :message="errors.senderAddress" />
      </div>

      <!-- Recipient Information -->
      <div>
        <InputLabel for="recipientName" value="Recipient's Name" />
        <TextInput id="recipientName" v-model="form.recipientName" class="w-full" />
        <InputError v-if="errors.recipientName" :message="errors.recipientName" />
      </div>

      <div>
        <InputLabel for="recipientAddress" value="Recipient's Address" />
        <TextInput id="recipientAddress" v-model="form.recipientAddress" class="w-full" />
        <InputError v-if="errors.recipientAddress" :message="errors.recipientAddress" />
      </div>

      <!-- Package Details -->
      <div>
        <InputLabel for="packageDetails" value="Package Details" />
        <TextInput id="packageDetails" v-model="form.packageDetails" class="w-full" />
        <InputError v-if="errors.packageDetails" :message="errors.packageDetails" />
      </div>

      <!-- Contact Number -->
      <div>
        <InputLabel for="contactNumber" value="Contact Number" />
        <TextInput id="contactNumber" v-model="form.contactNumber" class="w-full" />
        <InputError v-if="errors.contactNumber" :message="errors.contactNumber" />
      </div>

      <!-- Submit Button -->
      <div class="mt-4 text-center">
        <PrimaryButton @click="submitRequest">Submit Request</PrimaryButton>
      </div>
    </div>
  </div>
</template>
