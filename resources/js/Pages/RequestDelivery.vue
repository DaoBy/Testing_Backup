<script setup>
import { ref, computed } from 'vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

// Form Step Management
const currentStep = ref(1);

// Customer Type Selection (Radio)
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

  itemDescription: '', // Added description field
  itemHeight: '',
  itemWidth: '',
  itemWeight: '',
  itemQuantity: ''
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
      if (!form.value.senderFirstName) errors.value.senderFirstName = "First Name is required.";
      if (!form.value.senderLastName) errors.value.senderLastName = "Last Name is required.";
    }
    if (!form.value.senderMobile) errors.value.senderMobile = "Mobile number is required.";
    if (!form.value.dropOffBranch) errors.value.dropOffBranch = "Drop-off branch is required.";
  }

  if (currentStep.value === 2) {
  if (!form.value.receiverFirstName) errors.value.receiverFirstName = "First Name is required.";
  if (!form.value.receiverLastName) errors.value.receiverLastName = "Last Name is required.";
  if (!form.value.receiverMobile) errors.value.receiverMobile = "Mobile number is required.";
  if (!form.value.pickUpBranch) errors.value.pickUpBranch = "Pick-up branch is required.";

  // Validate Receiver Address
  const { street, city, province, zip } = form.value.receiverAddress;
  if (!street) errors.value.receiverAddressStreet = "Street is required.";
  if (!city) errors.value.receiverAddressCity = "City is required.";
  if (!province) errors.value.receiverAddressProvince = "Province is required.";
  if (!zip) errors.value.receiverAddressZip = "ZIP Code is required.";
}

if (currentStep.value === 3) {
  if (!form.value.itemDescription) errors.value.itemDescription = "Package description is required.";
  if (!form.value.itemHeight) errors.value.itemHeight = "Height is required.";
  if (!form.value.itemWidth) errors.value.itemWidth = "Width is required.";
  if (!form.value.itemWeight) errors.value.itemWeight = "Weight is required.";
  if (!form.value.itemQuantity) errors.value.itemQuantity = "Quantity is required.";
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
        <h2 class="text-xl flex items-center justify-center font-semibold mb-4">Sender Details</h2>

        <!-- Customer Type (Radio Buttons) -->
        <InputLabel value="Customer Type" />
        <div class="flex gap-4">
          <label class="flex items-center">
            <input type="radio" value="individual" v-model="customerType" class="mr-2" />
            Individual
          </label>

          <label class="flex items-center">
            <input type="radio" value="company" v-model="customerType" class="mr-2" />
            Company
          </label>
        </div>

        <!-- Company Fields (if Company is selected) -->
        <div v-if="customerType === 'company'">
          <InputLabel for="senderCompanyName" value="Company Name" />
          <TextInput id="senderCompanyName" v-model="form.senderCompanyName" class="w-full" />
          <InputError v-if="errors.senderCompanyName" :message="errors.senderCompanyName" />
        </div>

        <!-- Shared Fields (For Both Individual and Company) -->
        <InputLabel for="senderFirstName" value="First Name" />
        <TextInput id="senderFirstName" v-model="form.senderFirstName" class="w-full" />
        <InputError v-if="errors.senderFirstName" :message="errors.senderFirstName" />

        <InputLabel for="senderLastName" value="Last Name" />
        <TextInput id="senderLastName" v-model="form.senderLastName" class="w-full" />
        <InputError v-if="errors.senderLastName" :message="errors.senderLastName" />

        <InputLabel for="senderMobile" value="Mobile Number" />
        <TextInput id="senderMobile" v-model="form.senderMobile" class="w-full" />
        <InputError v-if="errors.senderMobile" :message="errors.senderMobile" />

        <!-- Address Fields -->
        <InputLabel :value="customerType === 'company' ? 'Company Address' : 'Full Address'" />
        <TextInput id="senderStreet" v-model="form.senderAddress.street" placeholder="Street" class="w-full" />
        <InputError v-if="errors.senderAddressStreet" :message="errors.senderAddressStreet" />

        <div class="grid grid-cols-2 gap-2">
          <div>
            <TextInput id="senderCity" v-model="form.senderAddress.city" placeholder="City" class="w-full" />
            <InputError v-if="errors.senderAddressCity" :message="errors.senderAddressCity" />
          </div>
          <div>
            <TextInput id="senderProvince" v-model="form.senderAddress.province" placeholder="Province" class="w-full" />
            <InputError v-if="errors.senderAddressProvince" :message="errors.senderAddressProvince" />
          </div>
        </div>

        <TextInput id="senderZip" v-model="form.senderAddress.zip" placeholder="ZIP Code" class="w-full mt-4" />
        <InputError v-if="errors.senderAddressZip" :message="errors.senderAddressZip" />

        <InputLabel for="dropOffBranch" value="Drop-off Branch" />
        <select v-model="form.dropOffBranch" class="w-full border-gray-300 rounded-md">
          <option v-for="branch in branches" :key="branch" :value="branch">{{ branch }}</option>
        </select>
        <InputError v-if="errors.dropOffBranch" :message="errors.dropOffBranch" />

        <!-- Navigation Buttons -->
        <div class="flex justify-center mt-6">
          <PrimaryButton @click="nextStep">Next</PrimaryButton>
        </div>
      </div>

        <!-- Step 2: Receiver Details -->
<div v-if="currentStep === 2">
  <h2 class="text-xl flex items-center justify-center font-semibold mb-4">Receiver Details</h2>

  <!-- Receiver First Name -->
  <InputLabel for="receiverFirstName" value="First Name" />
  <TextInput id="receiverFirstName" v-model="form.receiverFirstName" class="w-full" />
  <InputError v-if="errors.receiverFirstName" :message="errors.receiverFirstName" />

  <!-- Receiver Last Name -->
  <InputLabel for="receiverLastName" value="Last Name" />
  <TextInput id="receiverLastName" v-model="form.receiverLastName" class="w-full" />
  <InputError v-if="errors.receiverLastName" :message="errors.receiverLastName" />

  <!-- Receiver Mobile -->
  <InputLabel for="receiverMobile" value="Mobile Number" />
  <TextInput id="receiverMobile" v-model="form.receiverMobile" class="w-full" />
  <InputError v-if="errors.receiverMobile" :message="errors.receiverMobile" />

  <!-- Receiver Address -->
  <h3 class="text-lg font-medium mt-4">Receiver Address</h3>

  <InputLabel for="receiverStreet" value="Street" />
  <TextInput id="receiverStreet" v-model="form.receiverAddress.street" placeholder="Street" class="w-full" />
  <InputError v-if="errors.receiverAddressStreet" :message="errors.receiverAddressStreet" />

  <div class="grid grid-cols-2 gap-4 mt-2">
    <div>
      <InputLabel for="receiverCity" value="City" />
      <TextInput id="receiverCity" v-model="form.receiverAddress.city" placeholder="City" class="w-full" />
      <InputError v-if="errors.receiverAddressCity" :message="errors.receiverAddressCity" />
    </div>
    <div>
      <InputLabel for="receiverProvince" value="Province" />
      <TextInput id="receiverProvince" v-model="form.receiverAddress.province" placeholder="Province" class="w-full" />
      <InputError v-if="errors.receiverAddressProvince" :message="errors.receiverAddressProvince" />
    </div>
  </div>

  <InputLabel for="receiverZip" value="ZIP Code" class="mt-2" />
  <TextInput id="receiverZip" v-model="form.receiverAddress.zip" placeholder="ZIP Code" class="w-full" />
  <InputError v-if="errors.receiverAddressZip" :message="errors.receiverAddressZip" />

  <!-- Pick-up Branch -->
  <InputLabel for="pickUpBranch" value="Pick-up Branch" class="mt-4" />
  <select v-model="form.pickUpBranch" class="w-full border-gray-300 rounded-md">
    <option v-for="branch in branches" :key="branch" :value="branch">{{ branch }}</option>
  </select>
  <InputError v-if="errors.pickUpBranch" :message="errors.pickUpBranch" />

  <!-- Navigation Buttons -->
  <div class="flex justify-between mt-6">
    <PrimaryButton @click="prevStep">Back</PrimaryButton>
    <PrimaryButton @click="nextStep">Next</PrimaryButton>
  </div>
</div>


     <!-- Step 3: Item Description -->
<div v-if="currentStep === 3">
  <h2 class="text-xl flex items-center justify-center font-semibold mb-4">Item Description</h2>

  <!-- Advisory Message -->
  <div class="bg-yellow-100 text-yellow-800 p-4 rounded-lg mb-4">
    📢 <strong>Advisory:</strong> 
    We only carry packages with a maximum volume of <strong>10 cubic meters</strong> and a weight of <strong>100 kg</strong>. 
    Please ensure your items meet these requirements.
  </div>

  <!-- Package Description -->
  <InputLabel for="itemDescription" value="Package Description" />
  <textarea id="itemDescription" v-model="form.itemDescription" 
    placeholder="Describe briefly what you need to be delivered."
    class="w-full p-2 border rounded-md resize-none"
    rows="3">
  </textarea>
  <InputError v-if="errors.itemDescription" :message="errors.itemDescription" />

  <!-- Height (m) -->
  <InputLabel for="itemHeight" value="Height (m)" />
  <TextInput id="itemHeight" v-model="form.itemHeight" class="w-full" type="number" min="0" step="0.01" />
  <InputError v-if="errors.itemHeight" :message="errors.itemHeight" />

  <!-- Width (m) -->
  <InputLabel for="itemWidth" value="Width (m)" />
  <TextInput id="itemWidth" v-model="form.itemWidth" class="w-full" type="number" min="0" step="0.01" />
  <InputError v-if="errors.itemWidth" :message="errors.itemWidth" />

  <!-- Total Volume -->
  <p class="mt-2">📏 Total Volume: <strong>{{ cubicMeters }} cubic meters</strong></p>

  <!-- Weight (KG) -->
  <InputLabel for="itemWeight" value="Weight (KG)" />
  <TextInput id="itemWeight" v-model="form.itemWeight" class="w-full" type="number" min="0" step="0.01" />
  <InputError v-if="errors.itemWeight" :message="errors.itemWeight" />

  <!-- Quantity (Boxes/Packages) -->
  <InputLabel for="itemQuantity" value="Quantity (Number of Boxes/Packages)" class="mt-4" />
  <TextInput id="itemQuantity" v-model="form.itemQuantity" class="w-full" type="number" min="1" step="1" />
  <InputError v-if="errors.itemQuantity" :message="errors.itemQuantity" />

  <!-- Navigation Buttons -->
  <div class="flex justify-between mt-6">
    <PrimaryButton @click="prevStep">Back</PrimaryButton>
    <PrimaryButton @click="submitRequest">Submit</PrimaryButton>
  </div>
</div>


    </div>
    </div>
</template>
