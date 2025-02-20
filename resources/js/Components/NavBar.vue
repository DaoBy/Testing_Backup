<script setup>
import { ref, computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import NavLink from '@/Components/NavLink.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

// Get authenticated user
const authUser = computed(() => usePage().props.auth.user);

// Mobile menu state
const isMobileMenuOpen = ref(false);

// Toggle function for mobile menu
const toggleMobileMenu = () => {
  isMobileMenuOpen.value = !isMobileMenuOpen.value;
};
</script>

<template>
  <nav class="bg-white shadow-md w-full">
    <div class="w-full max-w-[90%] xl:max-w-[1280px] mx-auto flex justify-between items-center px-6 lg:px-12 py-4">
      <!-- Logo -->
      <a href="/" class="text-2xl font-bold">🚚 Logistics</a>

      <!-- Desktop Navigation -->
      <div class="hidden md:flex space-x-8">
        <NavLink :href="route('customer.home')">Home</NavLink>
        <NavLink href="#">Services</NavLink>
        <NavLink href="#">Contact Us</NavLink>
      </div>

      <!-- Auth & User Dropdown -->
      <div v-if="authUser" class="hidden md:flex relative">
        <Dropdown>
          <template #trigger>
            <button class="flex items-center space-x-2">
              <img src="https://via.placeholder.com/40" alt="Profile" class="rounded-full w-8 h-8">
            </button>
          </template>
          <template #content>
            <DropdownLink :href="route('profile.edit')">My Profile</DropdownLink>
            <DropdownLink :href="route('logout')" method="post" as="button">Logout</DropdownLink>
          </template>
        </Dropdown>
      </div>

      <div v-else class="hidden md:flex space-x-4">
        <NavLink :href="route('customer.login')">
          <SecondaryButton>Sign In</SecondaryButton>
        </NavLink>
        <NavLink :href="route('customer.register')">
          <PrimaryButton>Sign Up</PrimaryButton>
        </NavLink>
      </div>

      <!-- Mobile Menu Button -->
      <button @click="toggleMobileMenu" class="md:hidden p-2 rounded focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M4 6h16M4 12h16m-7 6h7"></path>
        </svg>
      </button>
    </div>

    <!-- Mobile Navigation Menu -->
    <div v-if="isMobileMenuOpen" class="md:hidden bg-white shadow-md p-4 space-y-4">
      <NavLink :href="route('customer.home')">Home</NavLink>
      <NavLink href="#">Services</NavLink>
      <NavLink href="#">Contact Us</NavLink>

      <div v-if="authUser" class="border-t pt-4">
        <DropdownLink :href="route('profile.edit')">My Profile</DropdownLink>
        <DropdownLink :href="route('logout')" method="post" as="button">Logout</DropdownLink>
      </div>

      <div v-else class="border-t pt-4 space-y-2">
        <NavLink :href="route('customer.login')">
          <SecondaryButton class="w-full">Sign In</SecondaryButton>
        </NavLink>
        <NavLink :href="route('customer.register')">
          <PrimaryButton class="w-full">Sign Up</PrimaryButton>
        </NavLink>
      </div>
    </div>
  </nav>
</template>
