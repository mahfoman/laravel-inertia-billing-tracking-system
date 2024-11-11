<template>

    <main class="flex-grow bg-gray-100 py-8">
        <div class="container mx-auto p-6 bg-white shadow-lg rounded-lg max-w-4xl">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold text-gray-800">All Users</h2>
                <Link href="/users/create" class="bg-gray-600 text-white px-3 py-2 font-semibold text-sm rounded hover:bg-gray-700">
                    <i class="fas fa-plus mr-2"></i>Add User
                </Link>
            </div>
            <table class="min-w-full bg-white">
                <thead>
                <tr>
                    <th class="py-2 px-4 border-b text-left text-gray-600 font-semibold">ID</th>
                    <th class="py-2 px-4 border-b text-left text-gray-600 font-semibold">Role</th>
                    <th class="py-2 px-4 border-b text-left text-gray-600 font-semibold">Name</th>
                    <th class="py-2 px-4 border-b text-left text-gray-600 font-semibold">Email</th>
                    <th class="py-2 px-4 border-b text-left text-gray-600 font-semibold">Action</th>
                </tr>
                </thead>
                <tbody>
                <!-- Example rows, replace with dynamic content as needed -->
                <tr v-for="user in users.data" :key="user.id">
                    <td class="py-2 px-4 border-b">{{ user.id }}</td>
                    <td class="py-2 px-4 border-b">{{ user.role.name }}</td>
                    <td class="py-2 px-4 border-b">{{ user.name }}</td>
                    <td class="py-2 px-4 border-b">{{ user.email }}</td>
                    <td class="py-2 px-4 border-b">
                        <Link :href="`/users/${user.id}/edit`" class="text-blue-500 mr-4"><i class="fas fa-edit"></i></Link>
                        <button @click="deleteResource(user.id)" class="text-red-600 hover:underline"><i class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="flex justify-center"><Pagination :links="users.links" class="mt-6" /></div>
        </div>

        <!-- Confirm Dialog Component -->
        <ConfirmDialog
            :isOpen="showDeleteModal"
            title="Delete User"
            message="Are you sure you want to delete this user?"
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
    users: {
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
    form.delete(`users/${resourceToDelete.value}`);
    showDeleteModal.value = false
}
</script>
