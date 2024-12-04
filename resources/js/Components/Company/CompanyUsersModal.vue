<template>
    <div class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-20 z-50">
            <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md mx-auto">
                <h2 class="text-xl font-semibold mb-4">Add User to {{ company.name }}</h2>

                <form @submit.prevent="submitForm" class="space-y-4">
                    <div>
                        <label class="block text-gray-700">Select a User</label>
                        <select v-model="form.user_id" class="w-full p-2 border rounded-md">
                            <option v-for="user in localDropDownUsers" :key="user.id" :value="user.id">{{ user.name }}</option>
                        </select>

                        <div v-if="form.errors.user_id" class="text-red-500">{{ form.errors.user_id }}</div>
                    </div>

                    <div class="flex justify-end space-x-4">
                        <button type="button" @click="close" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Add User
                        </button>
                    </div>
                </form>

                <!-- company user list goes here in loop -->
                <h2 class="mt-5 text-xl font-semibold mb-4">Company {{ company.name }} Users</h2>
                <table class="min-w-full bg-white">
                    <thead>
                    <tr>
                        <th class="py-2 px-4 border-b text-left text-gray-600 font-semibold">ID</th>
                        <th class="py-2 px-4 border-b text-left text-gray-600 font-semibold">Name</th>
                        <th class="py-2 px-4 border-b text-left text-gray-600 font-semibold"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="user in localTableUsers" :key="user.id">
                        <td class="py-2 px-4 border-b text-left text-gray-600 font-semibold">{{ user.id }}</td>
                        <td class="py-2 px-4 border-b text-left text-gray-600 font-semibold">{{ user.name }}</td>
                        <td class="py-2 px-4 border-b text-left">
                            <button @click="deleteCompanyUser(user.id)" class="text-red-600 hover:underline"><i class="fas fa-trash-alt"></i></button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <p v-if="localTableUsers.length === 0" class="text-gray-600 ml-4">No User is set</p>
            </div>
    </div>

    <ConfirmDialog
        :isOpen="showDeleteModal"
        title="Delete Company User"
        message="Are you sure you want to delete this user?"
        @close="showDeleteModal = false"
        @confirm="confirmDeleteCompanyUser"
    />
</template>

<script setup>

import {reactive, ref, watch} from 'vue';
import { useForm } from '@inertiajs/vue3';
import axios from "axios";
import ConfirmDialog from '../../Components/ConfirmDialog.vue';

const props = defineProps({
    isOpen: Boolean,
    company: Object,
    dropDownUsers: Array,
    tableUsers: Array,
});
const emit = defineEmits(['close']);

// Local state for dropdown and table data
const localDropDownUsers = reactive([...props.dropDownUsers]);
const localTableUsers = reactive([...props.tableUsers]);

// Watching props to keep local state in sync if necessary
// and making sure initial data is available
watch(() => props.dropDownUsers, (newValue) => {
    localDropDownUsers.splice(0, localDropDownUsers.length, ...newValue);
});

watch(() => props.tableUsers, (newValue) => {
    localTableUsers.splice(0, localTableUsers.length, ...newValue);
});

// Initializing form with useForm for handling the POST request
const form = useForm({
    user_id: null,
});

const close = () => {
    emit('close');
};

const submitForm = () => {
    form.post(`/companies/${props.company.id}/users`, {
        onError: (errors) => {
            console.log(errors); // Logging any validation errors
        },
        onSuccess: () => {
            // Fetching the updated dropdown and table users
            axios.get(`/companies/${props.company.id}/users`)
                .then(res => {
                    // Clearing and updating arrays to ensure reactivity
                    localDropDownUsers.splice(0, localDropDownUsers.length, ...res.data.dropDownUsers);
                    localTableUsers.splice(0, localTableUsers.length, ...res.data.tableUsers);
                })
                .catch(err => {
                    console.error("Failed to fetch updated data:", err);
                });
        },
    });
};

// deleting users from company
const showDeleteModal = ref(false);
const resourceToDelete = ref(null);

const deleteCompanyUser = (id) => {
    resourceToDelete.value = id
    showDeleteModal.value = true
};

const confirmDeleteCompanyUser = () => {
    axios.delete(`/companies/${props.company.id}/users/${resourceToDelete.value}`)
        .then(() => {
            // Removing the user from the table after successful deletion
            const index = localTableUsers.findIndex(user => user.id === resourceToDelete.value);
            if (index !== -1) {
                localTableUsers.splice(index, 1);
            }

            // Optionally refresh the dropdown users
            axios.get(`/companies/${props.company.id}/users`)
                .then(res => {
                    localDropDownUsers.splice(0, localDropDownUsers.length, ...res.data.dropDownUsers);
                });
            showDeleteModal.value = false
        })
        .catch(err => {
            console.error("Failed to delete user:", err);
        });
};

</script>



<style scoped>
/* Additional styling for modal (optional customization) */
</style>
