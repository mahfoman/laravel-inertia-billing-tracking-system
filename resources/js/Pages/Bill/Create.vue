<template>

    <main class="flex-grow py-8 mb-10">
        <div class="container mx-auto max-w-5xl p-6 bg-white shadow-lg rounded-lg">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">{{props.isUpdating ? 'Edit' : 'Add'}} Bill</h2>
            <form @submit.prevent="submit">
                <div class="flex flex-wrap -mx-2">
                    <!-- Company Input -->
                    <div class="w-full md:w-1/2 px-2 mb-4">
                        <label for="company_id" class="block text-gray-700 font-semibold mb-2">Company</label>
                        <select
                            name="company_id"
                            id="company_id"
                            v-model="form.company_id"
                            class="border border-gray-300 rounded-lg p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-600"
                            :class="{'border-red-500': errors.company_id}"
                        >
                            <option v-for="company in companies" :value="company.id">{{ company.name }}</option>
                        </select>
                        <p v-if="errors.company_id" class="text-red-500 text-xs mt-1">{{ errors.company_id }}</p>
                    </div>

                    <!-- Customer Input -->
                    <div class="w-full md:w-1/2 px-2 mb-4" v-if="showCustomer">
                        <label for="user_id" class="block text-gray-700 font-semibold mb-2">Customer</label>
                        <select
                            name="user_id"
                            id="user_id"
                            v-model="form.user_id"
                            class="border border-gray-300 rounded-lg p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-600"
                            :class="{'border-red-500': errors.user_id}">
                            <option v-for="user in filteredUsers" :value="user.id">{{ user.name }}</option>
                        </select>
                        <p v-if="errors.user_id" class="text-red-500 text-xs mt-1">{{ errors.user_id }}</p>
                    </div>

                    <!-- Package Input -->
                    <div class="w-full md:w-1/2 px-2 mb-4">
                        <label for="package_id" class="block text-gray-700 font-semibold mb-2">Package</label>
                        <select
                            name="package_id"
                            id="package_id"
                            v-model="form.package_id"
                            class="border border-gray-300 rounded-lg p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-600"
                            :class="{'border-red-500': errors.package_id}"
                        >
                            <option v-for="packageItem in packages" :value="packageItem.id">{{ packageItem.name }}</option>
                        </select>
                        <p v-if="errors.package_id" class="text-red-500 text-xs mt-1">{{ errors.package_id }}</p>
                    </div>

                    <!-- IP Address Input -->
                    <div class="w-full md:w-1/2 px-2 mb-4">
                        <label for="ip_address_id" class="block text-gray-700 font-semibold mb-2">IP Address</label>
                        <select
                            name="ip_address_id"
                            id="ip_address_id"
                            v-model="form.ip_address_id"
                            class="border border-gray-300 rounded-lg p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-600"
                            :class="{'border-red-500': errors.ip_address_id}">
                            <option v-for="ip_address in combinedIpAddresses" :value="ip_address.id">{{ ip_address.ip_address }}</option>
                        </select>
                        <p v-if="errors.ip_address_id" class="text-red-500 text-xs mt-1">{{ errors.ip_address_id }}</p>
                    </div>

                    <!-- Billing Month Input -->
                    <div class="w-full md:w-1/2 px-2 mb-4">
                        <label for="billing_month" class="block text-gray-700 font-semibold mb-2">Billing Month</label>
                        <select
                            name="billing_month"
                            id="billing_month"
                            v-model="form.billing_month"
                            class="border border-gray-300 rounded-lg p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-600"
                            :class="{'border-red-500': errors.billing_month}"
                        >
                            <option v-for="month in months" :value="month">{{ month }}</option>
                        </select>
                        <p v-if="errors.billing_month" class="text-red-500 text-xs mt-1">{{ errors.billing_month }}</p>
                    </div>

                    <!-- Package Name Input -->
                    <div class="w-full md:w-1/2 px-2 mb-4">
                        <label for="package_name" class="block text-gray-700 font-semibold mb-2">Package</label>
                        <input type="text"
                               id="package_name"
                               name="package_name"
                               readonly
                               v-model="form.package_name"
                               class="border bg-gray-100 border-gray-300 rounded-lg p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-600"
                               :class="{'border-red-500': errors.package_name}"
                        >
                    </div>

                    <!-- Amount Input -->
                    <div class="w-full md:w-1/2 px-2 mb-4">
                        <label for="amount" class="block text-gray-700 font-semibold mb-2">Amount</label>
                        <input type="text"
                               id="amount"
                               name="amount"
                               readonly
                               v-model="form.amount"
                               class="border bg-gray-100 border-gray-300 rounded-lg p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-600"
                               :class="{'border-red-500': errors.amount}"
                        >
                    </div>

                    <!-- Speed Input -->
                    <div class="w-full md:w-1/2 px-2 mb-4">
                        <label for="speed" class="block text-gray-700 font-semibold mb-2">Speed (MB)</label>
                        <input type="text"
                               id="speed"
                               name="speed"
                               readonly
                               v-model="form.speed"
                               class="border bg-gray-100 border-gray-300 rounded-lg p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-600"
                               :class="{'border-red-500': errors.speed}"
                        >
                    </div>

                    <!-- Billing Status Input -->
                    <div class="w-full md:w-1/2 px-2 mb-4">
                        <label for="status" class="block text-gray-700 font-semibold mb-2">Billing Status</label>
                        <select
                            name="status"
                            id="status"
                            v-model="form.status"
                            class="border border-gray-300 rounded-lg p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-600"
                            :class="{'border-red-500': errors.status}"
                        >
                            <option value="due" selected="selected">Due</option>
                            <option value="paid">Paid</option>
                        </select>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex items-center mt-4">
                    <button type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Submit
                    </button>
                    <Link :href="'/bills'" class="bg-red-800 text-white px-4 py-2 rounded hover:bg-red-700 ml-4">Cancel</Link>
                </div>
            </form>
        </div>
    </main>
</template>

<script setup>
import { Link, useForm } from "@inertiajs/vue3";
import {ref, onMounted, watch, reactive, computed } from "vue";
import axios from "axios";

const props = defineProps({
    bill: {
        type: Object,
        default: null,
    },
    companies: {
        type: Object,
        default: null,
    },
    users: {
        type: Object,
        default: null,
    },
    packages: {
        type: Object,
        default: null,
    },
    ip_addresses: {
        type: Object,
        default: null,
    },
    unusedIpAddresses: {
        type: Object,
        default: null,
    },
    months :{
        type: Array,
        default: null
    },
    isUpdating: {
        type: Boolean,
        default: false,
    },
    errors: {
        type: Object,
        default: null,
    }
});

const form = useForm({
    company_id: null,
    package_id: null,
    user_id: null,
    ip_address_id: null,
    billing_month: "",
    package_name: "",
    amount: "",
    speed: "",
    status: "",
    _method: (props.isUpdating ? 'PUT' : 'POST'),
});

const showCustomerFields = ref(false);

onMounted(() => {
    if (props.bill && Object.keys(props.bill).length > 0) {
        form.company_id = props.bill.company_id;
        form.package_id = props.bill.package_id;
        form.user_id = props.bill.user_id;
        form.ip_address_id = props.bill.ip_address_id;
        form.package_name = props.bill.package_name;
        form.billing_month = props.bill.billing_month;
        form.amount = props.bill.amount;
        form.speed = props.bill.speed;
        form.status = props.bill.status;

    } else {
        form.company_id = null;
        form.package_id = null;
        form.user_id = null;
        form.ip_address_id = null;
        form.billing_month = "";
        form.package_name = "";
        form.amount = "";
        form.speed = "";
        form.status = "due";
    }
});

watch(() => form.package_id, (newPackageId) => {
    const selectedPackage = props.packages.find((packageItem) => packageItem.id === newPackageId);
    if (selectedPackage) {
        form.package_name = selectedPackage.name;
        form.amount = selectedPackage.price;
        form.speed = selectedPackage.speed;
    }
});

const submit = () => (props.isUpdating ? updateResource() : addResource());
const addResource = () => {
    // form.post("/ip_addresses");
    form.post('/bills', {
        onError: (errors) => {
            //console.log(errors) // Logs any validation errors
        }
    })
};
const updateResource = () => { //console.log('inside update')
    form.post(`/bills/${props.bill.id}`, {
        onError: (errors) => {
            //console.log(errors) // Logs any validation errors
        }
    });
}

// dropdown Users processing
const dropDownUsers = reactive([...props.users]);
const showCustomer = ref(false);

watch(() => form.company_id, (newCompanyId) => {
    axios.get(`/companies/${newCompanyId}/users`)
        .then(res => {
            dropDownUsers.splice(0, dropDownUsers.length, ...res.data.tableUsers);
            showCustomer.value = dropDownUsers.length > 0;

            // for updating keeping the selected user even if company is changed
            if( props.isUpdating ) {
                form.user_id = props.bill.user_id
            }
        });
});

// Computed property for filtered users
const filteredUsers = computed(() => {
    return dropDownUsers.filter(user => user.role_id !== 2); // filtering users for company who are not admin (2)
});

// dropdown IpAddresses processing
const combinedIpAddresses = computed(() => {
    // Adding the selected IP address to the list during editing
    if( props.isUpdating ) {
        return [props.bill.ip_address, ...props.unusedIpAddresses, ];
    }
    return props.unusedIpAddresses;
});

</script>
