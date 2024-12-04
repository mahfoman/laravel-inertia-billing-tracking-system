<template>

    <main class="flex-grow py-8">
        <div class="container mx-auto p-6 bg-white shadow-lg rounded-lg max-w-4xl">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold text-gray-800">Companies</h2>
                <Link href="/companies/create" class="bg-gray-600 text-white px-3 py-2 font-semibold text-sm rounded hover:bg-gray-700">
                    <i class="fas fa-plus mr-2"></i>Add Company
                </Link>
            </div>
            <table class="min-w-full bg-white">
                <thead>
                <tr>
                    <th class="py-2 px-4 border-b text-left text-gray-600 font-semibold">ID</th>
                    <th class="py-2 px-4 border-b text-left text-gray-600 font-semibold">Name</th>
                    <th class="py-2 px-4 border-b text-left text-gray-600 font-semibold">Email</th>
                    <th class="py-2 px-4 border-b text-left text-gray-600 font-semibold">Logo</th>
                    <th class="py-2 px-4 border-b text-left text-gray-600 font-semibold">Website</th>
                    <th class="py-2 px-4 border-b text-left text-gray-600 font-semibold">Phone</th>
                    <th class="py-2 px-4 border-b text-left text-gray-600 font-semibold">Users</th>
                    <th class="py-2 px-4 border-b text-left text-gray-600 font-semibold">Action</th>
                </tr>
                </thead>
                <tbody>
                <!-- Example rows, replace with dynamic content as needed -->
                <tr v-for="company in companies.data" :key="company.id">
                    <td class="py-2 px-4 border-b">{{ company.id }}</td>
                    <td class="py-2 px-4 border-b">{{ company.name }}</td>
                    <td class="py-2 px-4 border-b">{{ company.email }}</td>
                    <td class="py-2 px-4 border-b">
                        <img :src="`/storage/companies/${company.logo}`" alt="Uploaded Image" />
                    </td>
                    <td class="py-2 px-4 border-b">{{ company.website }}</td>
                    <td class="py-2 px-4 border-b">{{ company.phone }}</td>
                    <td class="py-2 px-4 border-b">
                        <a @click.prevent="openModal(company)" class="text-blue-500 hover:underline cursor-pointer">users</a>
                        <CompanyUsersModal
                            v-if="showModal"
                            :company="selectedCompany"
                            :dropDownUsers="dropDownUsers"
                            :tableUsers="tableUsers"
                            @close="showModal = false"
                        />
                    </td>
                    <td class="py-2 px-4 border-b">
                        <Link :href="`/companies/${company.id}/edit`" class="text-blue-500 mr-4"><i class="fas fa-edit"></i></Link>
                        <button @click="deleteResource(company.id)" class="text-red-600 hover:underline"><i class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="flex justify-center"><Pagination :links="companies.links" class="mt-6" /></div>
        </div>

        <!-- Confirm Dialog Component -->
        <ConfirmDialog
            :isOpen="showDeleteModal"
            title="Delete Company"
            message="Are you sure you want to delete this company?"
            @close="showDeleteModal = false"
            @confirm="confirmDelete"
        />
    </main>
</template>

<script setup>
import { ref } from 'vue'
import { Link, useForm } from "@inertiajs/vue3";
import ConfirmDialog from '../../Components/ConfirmDialog.vue'
import Pagination from "../../Components/Pagination.vue";
import CompanyUsersModal from "../../Components/Company/CompanyUsersModal.vue";
import axios from "axios";


const showDeleteModal = ref(false)
const resourceToDelete = ref(null)

const showModal = ref(false);

const selectedCompany = ref(null);
const dropDownUsers = ref([]);
const tableUsers = ref([]);

const props = defineProps({
    companies: {
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
    form.delete(`companies/${resourceToDelete.value}`);
    showDeleteModal.value = false
}
const openModal = (company) => {
    selectedCompany.value = company
    showModal.value = true;

    axios.get(`/companies/${company.id}/users`)
        .then(res => {
            //console.log(res.data)
            dropDownUsers.value = res.data.dropDownUsers
            tableUsers.value = res.data.tableUsers
        })
}
</script>
