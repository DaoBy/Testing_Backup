<script setup>
import AuthLayout from '@/Layouts/AuthLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <AuthLayout>
        <Head title="Registration Successful" />

        <div class="max-w-lg mx-auto p-8 bg-white shadow-md rounded-lg text-center">
            <h1 class="text-2xl font-semibold mb-4">🎉 Account Created Successfully!</h1>
            <p class="text-gray-600 mb-6">
                Your customer account has been created. You can now log in or return to the homepage.
            </p>

            <div class="flex justify-center space-x-4 mt-4">
                <!-- Log In Button -->
                <Link :href="route('customer.login')" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                    Log In
                </Link>

                <!-- Return to Homepage Button -->
                <Link :href="route('customer.home')" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400">
                    Return to Homepage
                </Link>
            </div>
        </div>
    </AuthLayout>
</template>
