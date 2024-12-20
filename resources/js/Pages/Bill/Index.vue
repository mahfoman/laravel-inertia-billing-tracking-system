<template>

    <main class="flex-grow py-8">
        <div class="container mx-auto p-6 bg-white shadow-lg rounded-lg max-w-5xl">
            <div class="flex justify-between items-center mb-5">
                <h2 class="text-2xl font-bold text-gray-800">Bills</h2>
                <!-- Input fields for filters -->
                <div class="flex space-x-2">
                    <!-- Date Range Picker -->
                    <input type="text" placeholder="Select date range" id="dateRangePicker" class="border border-gray-300 rounded px-3 py-2 text-sm" />

                    <!-- Search by Customer -->
                    <input type="text" placeholder="Search by Customer" id="customerSearch" class="border border-gray-300 rounded px-3 py-2 text-sm" />

                    <!-- Search by IP Address -->
                    <input type="text" placeholder="Search by IP Address" id="ipSearch" class="border border-gray-300 rounded px-3 py-2 text-sm" />

                    <!-- Submit Button -->
                    <button type="submit" class="bg-blue-600 text-white px-2 py-2 font-semibold text-xs rounded hover:bg-blue-700">
                        Submit
                    </button>

                    <!-- Export Button (smaller size) -->
                    <button type="button" class="bg-green-600 text-white px-2 py-1 font-semibold text-xs rounded hover:bg-green-700">
                        Export
                    </button>

                </div>
                <Link href="/bills/create" class="bg-gray-600 text-white px-3 py-2 font-semibold text-sm rounded hover:bg-gray-700">
                    <i class="fas fa-plus mr-2"></i>Add Bill
                </Link>
            </div>
            <table class="min-w-full bg-white">
                <thead class="bg-black text-white text-xs rounded-2xl">
                <tr>
                    <th class="py-2 px-4 border-b text-left font-semibold w-1/10">ID</th>
                    <th class="py-2 px-4 border-b text-left font-semibold w-1/10">Company</th>
                    <th class="py-2 px-4 border-b text-left font-semibold w-1/10">Package</th>
                    <th class="py-2 px-4 border-b text-left font-semibold w-1/10">User</th>
                    <th class="py-2 px-4 border-b text-left font-semibold w-1/10">IP Address</th>
                    <th class="py-2 px-4 border-b text-left font-semibold w-1/10">Billing Month</th>
                    <th class="py-2 px-4 border-b text-left font-semibold w-1/10">Speed (MB)</th>
                    <th class="py-2 px-4 border-b text-left font-semibold w-1/10">Amount</th>
                    <th class="py-2 px-4 border-b text-left font-semibold w-1/10">Status</th>
                    <th class="py-2 px-4 border-b text-left font-semibold w-1/10">Paid On</th>
                    <th class="py-2 px-4 border-b text-left font-semibold w-1/10">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="bill in bills.data" :key="bill.id">
                    <td class="py-2 px-4 border-b">{{ bill.id }}</td>
                    <td class="py-2 px-4 border-b">{{ bill.company.name }}</td>
                    <td class="py-2 px-4 border-b">{{ bill.package.name }}</td>
                    <td class="py-2 px-4 border-b">{{ bill.user.name }}</td>
                    <td class="py-2 px-4 border-b">{{ bill.ip_address.ip_address }}</td>
                    <td class="py-2 px-4 border-b">{{ bill.billing_month }}</td>
                    <td class="py-2 px-4 border-b">{{ bill.speed }}</td>
                    <td class="py-2 px-4 border-b">{{ bill.amount }}</td>
                    <td class="py-2 px-4 border-b">
                        <span  v-if="bill.status === 'paid'" class="bg-green-800 text-white px-2 py-1 rounded text-xs">Paid</span>
                        <span v-else class=" bg-red-800 text-white px-2 py-1 rounded text-xs"> Due </span>
                    </td>
                    <td class="py-2 px-4 border-b">{{ bill.paid_on }}</td>
                    <td class="py-2 px-4 border-b">
                        <Link :href="`/bills/${bill.id}/edit`" class="text-blue-500 mr-4"><i class="fas fa-edit"></i></Link>
                        <button @click="deleteResource(bill.id)" class="text-red-600 hover:underline"><i class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="flex justify-center"><Pagination :links="bills.links" class="mt-6" /></div>
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
    bills: {
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
    form.delete(`bills/${resourceToDelete.value}`);
    showDeleteModal.value = false
}
</script>
