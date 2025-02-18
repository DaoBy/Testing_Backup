<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';

const page = usePage();
const isEmployee = page.url.startsWith('/register/employee') || page.url.startsWith('/login/employee');
const loginRoute = isEmployee ? 'employee.login' : 'customer.login';
</script>

<template>
    <div class="flex min-h-screen flex-col items-center bg-gray-100 pt-6 sm:justify-center sm:pt-0">
        <div>
            <Link href="/">
                <ApplicationLogo class="h-20 w-20 fill-current text-gray-500" />
            </Link>
        </div>

        <div class="mt-6 w-full overflow-hidden bg-white px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg">
            <slot />
        </div>

        <!-- Example: Add a login button dynamically -->
        <div class="mt-4">
            <Link :href="route(loginRoute)" class="text-blue-500 hover:underline">
                Login
            </Link>
        </div>
    </div>
</template>
