<template>

    <main class="flex-grow bg-gray-100 py-8">
        <div class="container mx-auto p-6 bg-white shadow-lg rounded-lg max-w-4xl">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold text-gray-800">IP Addresses</h2>
                <Link href="/ip_addresses/create" class="bg-gray-600 text-white px-3 py-2 font-semibold text-sm rounded hover:bg-gray-700">
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
                <tr v-for="ip in ips.data" :key="ip.id">
                    <td class="py-2 px-4 border-b">{{ ip.id }}</td>
                    <td class="py-2 px-4 border-b">{{ ip.ip_address }}</td>
                    <td class="py-2 px-4 border-b">
                        <Link :href="`/ip_addresses/${ip.id}/edit`" class="text-blue-500 mr-4"><i class="fas fa-edit"></i></Link>
                        <button @click="deleteIP(ip.id)" class="text-red-600 hover:underline"><i class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="flex justify-center"><Pagination :links="ips.links" class="mt-6" /></div>

        </div>

        <!-- Confirm Dialog Component -->
        <ConfirmDialog
            :isOpen="showDeleteModal"
            title="Delete IP Address"
            message="Are you sure you want to delete this address?"
            @close="showDeleteModal = false"
            @confirm="confirmDelete"
        />
    </main>
</template>

<script setup>
import { ref } from 'vue'
import { Link, useForm } from "@inertiajs/vue3";
import ConfirmDialog from '@/Components/ConfirmDialog.vue'
import Pagination from "../../Components/Pagination.vue";

const showDeleteModal = ref(false)
const ipAddressToDelete = ref(null)

defineProps({
    ips: {
        type: Object,
        default: () => [],
    },
});

const form = useForm({});

const deleteIP = (id) => {
    //form.delete(`ip_addresses/${id}`);
    ipAddressToDelete.value = id
    showDeleteModal.value = true
};

const confirmDelete = () => {
    form.delete(`ip_addresses/${ipAddressToDelete.value}`);
    showDeleteModal.value = false
}
</script>
