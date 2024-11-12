<template>

    <main class="flex-grow py-8">
        <div class="container mx-auto p-6 bg-white shadow-lg rounded-lg max-w-4xl">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold text-gray-800">All Packages</h2>
                <Link href="/packages/create" class="bg-gray-600 text-white px-3 py-2 font-semibold text-sm rounded hover:bg-gray-700">
                    <i class="fas fa-plus mr-2"></i>Add Package
                </Link>
            </div>
            <table class="min-w-full bg-white">
                <thead>
                <tr>
                    <th class="py-2 px-4 border-b text-left text-gray-600 font-semibold">ID</th>
                    <th class="py-2 px-4 border-b text-left text-gray-600 font-semibold">Company Name</th>
                    <th class="py-2 px-4 border-b text-left text-gray-600 font-semibold">Package Name</th>
                    <th class="py-2 px-4 border-b text-left text-gray-600 font-semibold">Price</th>
                    <th class="py-2 px-4 border-b text-left text-gray-600 font-semibold">Speed (MB) </th>
                    <th class="py-2 px-4 border-b text-left text-gray-600 font-semibold">Action</th>
                </tr>
                </thead>
                <tbody>
                <!-- Example rows, replace with dynamic content as needed -->
                <tr v-for="packageItem in packages.data" :key="packageItem.id">
                    <td class="py-2 px-4 border-b">{{ packageItem.id }}</td>
                    <td class="py-2 px-4 border-b">{{ packageItem.company.name }}</td>
                    <td class="py-2 px-4 border-b">{{ packageItem.name }}</td>
                    <td class="py-2 px-4 border-b">{{ packageItem.price }}TK.</td>
                    <td class="py-2 px-4 border-b">{{ packageItem.speed }}</td>
                    <td class="py-2 px-4 border-b">
                        <Link :href="`/packages/${packageItem.id}/edit`" class="text-blue-500 mr-4"><i class="fas fa-edit"></i></Link>
                        <button @click="deleteResource(packageItem.id)" class="text-red-600 hover:underline"><i class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="flex justify-center"><Pagination :links="packages.links" class="mt-6" /></div>
        </div>

        <!-- Confirm Dialog Component -->
        <ConfirmDialog
            :isOpen="showDeleteModal"
            title="Delete Package"
            message="Are you sure you want to delete this package?"
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
const resourceToDelete = ref(null)

defineProps({
    packages: {
        type: Object,
        default: () => [],
    },
});

const form = useForm({});

const deleteResource = (id) => {
    resourceToDelete.value = id
    showDeleteModal.value = true
};

const confirmDelete = () => {
    form.delete(`packages/${resourceToDelete.value}`);
    showDeleteModal.value = false
}
</script>
