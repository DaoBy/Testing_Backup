<script setup>
import { ref, computed } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import SelectInput from '@/Components/SelectInput.vue';

// Form Step Management
const currentStep = ref(1);

// Customer Type Selection
const customerType = ref('individual'); // Default: Individual

// Form Data
const form = ref({
  senderFirstName: '',
  senderLastName: '',
  senderCompanyName: '',
  senderMobile: '',
  senderAddress: { street: '', city: '', province: '', zip: '' },
  dropOffBranch: '',
  
  receiverFirstName: '',
  receiverLastName: '',
  receiverMobile: '',
  receiverAddress: { street: '', city: '', province: '', zip: '' },
  pickUpBranch: '',

  itemHeight: '',
  itemWidth: '',
  itemWeight: ''
});

// Form Errors
const errors = ref({});

// Available branches
const branches = ["Naga", "Malabon", "Legazpi"];

// Computed: Calculate cubic meters
const cubicMeters = computed(() => {
  const height = parseFloat(form.value.itemHeight) || 0;
  const width = parseFloat(form.value.itemWidth) || 0;
  return (height * width).toFixed(2); // 2 decimal places
});

// Validate Current Step
const validateStep = () => {
  errors.value = {};
  
  if (currentStep.value === 1) {
    if (customerType.value === 'individual') {
      if (!form.value.senderFirstName) errors.value.senderFirstName = "First Name is required.";
      if (!form.value.senderLastName) errors.value.senderLastName = "Last Name is required.";
    } else {
      if (!form.value.senderCompanyName) errors.value.senderCompanyName = "Company Name is required.";
    }
    if (!form.value.senderMobile) errors.value.senderMobile = "Mobile number is required.";
    if (!form.value.dropOffBranch) errors.value.dropOffBranch = "Drop-off branch is required.";
  }

  if (currentStep.value === 2) {
    if (!form.value.receiverFirstName) errors.value.receiverFirstName = "First Name is required.";
    if (!form.value.receiverLastName) errors.value.receiverLastName = "Last Name is required.";
    if (!form.value.receiverMobile) errors.value.receiverMobile = "Mobile number is required.";
    if (!form.value.pickUpBranch) errors.value.pickUpBranch = "Pick-up branch is required.";
  }

  if (currentStep.value === 3) {
    if (!form.value.itemHeight) errors.value.itemHeight = "Height is required.";
    if (!form.value.itemWidth) errors.value.itemWidth = "Width is required.";
    if (!form.value.itemWeight) errors.value.itemWeight = "Weight is required.";
  }

  return Object.keys(errors.value).length === 0;
};

// Proceed to Next Step
const nextStep = () => {
  if (validateStep()) currentStep.value++;
};

// Go Back to Previous Step
const prevStep = () => {
  if (currentStep.value > 1) currentStep.value--;
};

// Submit Form
const submitRequest = () => {
  if (validateStep()) {
    alert("Delivery request submitted! (Replace this with backend request)");
  }
};
</script>

<template>
  <div class="container mx-auto px-6 py-12">
    <h1 class="text-3xl font-bold text-center">Request a Delivery</h1>
    <p class="mt-2 text-gray-600 text-center">Fill out the form below to request a delivery.</p>

    <div class="mt-6 max-w-lg mx-auto bg-white shadow-md p-6 rounded-lg space-y-4">
      <!-- Step 1: Sender Details -->
      <div v-if="currentStep === 1">
        <h2 class="text-xl font-semibold mb-2">Sender Details</h2>
        
        <InputLabel for="customerType" value="Customer Type" />
        <SelectInput v-model="form.customerType" :options="['Individual', 'Company']" class="w-full">
          <option value="individual">Individual</option>
          <option value="company">Company</option>
        </SelectInput>

        <div v-if="customerType === 'individual'">
          <InputLabel for="senderFirstName" value="First Name" />
          <TextInput id="senderFirstName" v-model="form.senderFirstName" class="w-full" />
          <InputError v-if="errors.senderFirstName" :message="errors.senderFirstName" />

          <InputLabel for="senderLastName" value="Last Name" />
          <TextInput id="senderLastName" v-model="form.senderLastName" class="w-full" />
          <InputError v-if="errors.senderLastName" :message="errors.senderLastName" />
        </div>

        <div v-else>
          <InputLabel for="senderCompanyName" value="Company Name" />
          <TextInput id="senderCompanyName" v-model="form.senderCompanyName" class="w-full" />
          <InputError v-if="errors.senderCompanyName" :message="errors.senderCompanyName" />
        </div>

        <InputLabel for="senderMobile" value="Mobile Number" />
        <TextInput id="senderMobile" v-model="form.senderMobile" class="w-full" />
        <InputError v-if="errors.senderMobile" :message="errors.senderMobile" />

        <InputLabel for="dropOffBranch" value="Drop-off Branch" />
        <SelectInput v-model="form.dropOffBranch" :options="branches"  class="w-full">
          <option v-for="branch in branches" :key="branch" :value="branch">{{ branch }}</option>
        </SelectInput>
        <InputError v-if="errors.dropOffBranch" :message="errors.dropOffBranch" />

        <PrimaryButton @click="nextStep" class="mt-4">Next</PrimaryButton>
      </div>

      <!-- Step 2: Receiver Details -->
      <div v-if="currentStep === 2">
        <h2 class="text-xl font-semibold mb-2">Receiver Details</h2>

        <InputLabel for="receiverFirstName" value="First Name" />
        <TextInput id="receiverFirstName" v-model="form.receiverFirstName" class="w-full" />
        <InputError v-if="errors.receiverFirstName" :message="errors.receiverFirstName" />

        <InputLabel for="receiverLastName" value="Last Name" />
        <TextInput id="receiverLastName" v-model="form.receiverLastName" class="w-full" />
        <InputError v-if="errors.receiverLastName" :message="errors.receiverLastName" />

        <InputLabel for="receiverMobile" value="Mobile Number" />
        <TextInput id="receiverMobile" v-model="form.receiverMobile" class="w-full" />
        <InputError v-if="errors.receiverMobile" :message="errors.receiverMobile" />

        <InputLabel for="pickUpBranch" value="Pick-up Branch" />
        <SelectInput v-model="form.pickUpBranch" :options="branches" class="w-full">
          <option v-for="branch in branches" :key="branch" :value="branch">{{ branch }}</option>
        </SelectInput>
        <InputError v-if="errors.pickUpBranch" :message="errors.pickUpBranch" />

        <PrimaryButton @click="nextStep" class="mt-4">Next</PrimaryButton>
        <SecondaryButton @click="prevStep" class="mt-4">Back</SecondaryButton>
      </div>

      <!-- Step 3: Item Description -->
      <div v-if="currentStep === 3">
        <h2 class="text-xl font-semibold mb-2">Item Description</h2>

        <InputLabel for="itemHeight" value="Height (m)" />
        <TextInput id="itemHeight" v-model="form.itemHeight" class="w-full" />

        <InputLabel for="itemWidth" value="Width (m)" />
        <TextInput id="itemWidth" v-model="form.itemWidth" class="w-full" />

        <p class="mt-2">Total Volume: {{ cubicMeters }} cubic meters</p>

        <InputLabel for="itemWeight" value="Weight (KG)" />
        <TextInput id="itemWeight" v-model="form.itemWeight" class="w-full" />

        <PrimaryButton @click="submitRequest" class="mt-4">Submit</PrimaryButton>
      </div>
    </div>
  </div>
</template>
