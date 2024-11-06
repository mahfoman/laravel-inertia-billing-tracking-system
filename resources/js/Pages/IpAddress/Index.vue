<template>

    <main class="flex-grow bg-gray-100 py-8">
        <div class="container mx-auto p-6 bg-white shadow-lg rounded-lg max-w-4xl">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold text-gray-800">IP Addresses</h2>
                <Link href="/ip_addresses/create" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    <i class="fas fa-plus mr-2"></i>Add IP Address
                </Link>
            </div>
            <table class="min-w-full bg-white">
                <thead>
                <tr>
                    <th class="py-2 px-4 border-b text-left text-gray-600 font-semibold">ID</th>
                    <th class="py-2 px-4 border-b text-left text-gray-600 font-semibold">IP</th>
                    <th class="py-2 px-4 border-b text-left text-gray-600 font-semibold">Action</th>
                </tr>
                </thead>
                <tbody>
                <!-- Example rows, replace with dynamic content as needed -->
                <tr v-for="ip in ips" :key="ip.id">
                    <td class="py-2 px-4 border-b">{{ ip.id }}</td>
                    <td class="py-2 px-4 border-b">{{ ip.ip_address }}</td>
                    <td class="py-2 px-4 border-b">
                        <Link :href="`/ip_addresses/${ip.id}/edit`" class="text-blue-500 mr-4"><i class="fas fa-edit"></i></Link>
                        <button @click="deleteIP(ip.id)" class="text-red-600 hover:underline"><i class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </main>
</template>

<script setup>
import { Link, useForm } from "@inertiajs/vue3";

defineProps({
    ips: {
        type: Array,
        default: () => [],
    },
});

const form = useForm({});

const deleteIP = (id) => {
    form.delete(`ip_addresses/${id}`);
};
</script>
