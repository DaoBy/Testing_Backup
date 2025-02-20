<script setup>
import NavBar from '@/Components/NavBar.vue';
import { usePage } from '@inertiajs/vue3';

// Get current page
const page = usePage();

// Determine login route based on user type
</script>

<template>
    <div class="min-h-screen bg-gray-100 flex flex-col">
        <!-- Navigation Bar -->
        <NavBar />

        <!-- Main Content -->
        <main class="flex-1 w-full">
            <slot />
        </main>

        <!-- Footer (Optional) -->
        <footer class="text-center py-4 text-gray-600 bg-white border-t mt-8">
            © {{ new Date().getFullYear() }} Logistics Company. All Rights Reserved.
        </footer>
    </div>
</template>




