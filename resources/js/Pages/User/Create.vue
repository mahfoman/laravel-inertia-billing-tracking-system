<template>

    <main class="flex-grow py-8">
        <div class="container mx-auto max-w-5xl p-6 bg-white shadow-lg rounded-lg">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">{{props.isUpdating ? 'Edit' : 'Add'}} User</h2>
            <form @submit.prevent="submit">
                <!-- Name Input -->
                <div class="mb-4">
                    <label for="role-name" class="block text-gray-700 font-semibold mb-2">Role</label>
                    <select
                        name="role_id"
                        id="role_id"
                        v-model="form.role_id"
                        class="border border-gray-300 rounded-lg p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-600"
                        :class="{'border-red-500': errors.role_id}"
                    >
                        <option v-for="role in roles" :value="role.id">{{ role.name }}</option>
                    </select>
                    <!-- Error Message -->
                    <p v-if="errors.role_id" class="text-red-500 text-xs mt-1">{{ errors.role_id }}</p>
                </div>
                <div class="mb-4" v-if="showNotCustomerFields">
                    <label for="company-name" class="block text-gray-700 font-semibold mb-2">Company</label>
                    <select
                        name="company_id"
                        id="company_id"
                        v-model="form.company_id"
                        class="border border-gray-300 rounded-lg p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-600"
                        :class="{'border-red-500': errors.company_id}"
                    >
                        <option v-for="company in companies" :value="company.id">{{ company.name }}</option>
                    </select>
                    <!-- Error Message -->
                    <p v-if="errors.company_id" class="text-red-500 text-xs mt-1">{{ errors.company_id }}</p>
                </div>
                <!-- Name Input -->
                <div class="mb-4">
                    <label for="role-name" class="block text-gray-700 font-semibold mb-2">Name</label>
                    <input type="text"
                           id="name"
                           name="name"
                           v-model="form.name"
                           class="border border-gray-300 rounded-lg p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-600"
                           :class="{'border-red-500': errors.name}"
                    >
                    <!-- Error Message -->
                    <p v-if="errors.name" class="text-red-500 text-xs mt-1">{{ errors.name }}</p>
                </div>
                <div class="mb-4">
                    <label for="role-name" class="block text-gray-700 font-semibold mb-2">Email</label>
                    <input type="text"
                           id="email"
                           name="email"
                           v-model="form.email"
                           class="border border-gray-300 rounded-lg p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-600"
                           :class="{'border-red-500': errors.email}"
                    >
                    <!-- Error Message -->
                    <p v-if="errors.email" class="text-red-500 text-xs mt-1">{{ errors.email }}</p>
                </div>
                <div class="mb-4">
                    <label for="role-name" class="block text-gray-700 font-semibold mb-2">Password</label>
                    <input type="password"
                           id="password"
                           name="password"
                           v-model="form.password"
                           class="border border-gray-300 rounded-lg p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-600"
                           :class="{'border-red-500': errors.password}"
                    >
                    <!-- Error Message -->
                    <p v-if="errors.password" class="text-red-500 text-xs mt-1">{{ errors.password }}</p>
                </div>

                <!-- Additional Fields for Customers -->
                <div v-if="showCustomerFields">
                    <div class="mb-4">
                        <label for="address" class="block text-gray-700 font-semibold mb-2">Address</label>
                        <input type="text"
                               id="address"
                               name="address"
                               v-model="form.address"
                               class="border border-gray-300 rounded-lg p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-600"
                               :class="{'border-red-500': errors.address}"
                        >
                        <p v-if="errors.address" class="text-red-500 text-xs mt-1">{{ errors.address }}</p>
                    </div>

                    <div class="mb-4">
                        <label for="phone" class="block text-gray-700 font-semibold mb-2">Phone</label>
                        <input type="tel"
                               id="phone"
                               name="phone"
                               v-model="form.phone"
                               class="border border-gray-300 rounded-lg p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-600"
                               :class="{'border-red-500': errors.phone}"
                        >
                        <p v-if="errors.phone" class="text-red-500 text-xs mt-1">{{ errors.phone }}</p>
                    </div>

                    <div class="mb-4">
                        <label for="floor" class="block text-gray-700 font-semibold mb-2">Floor</label>
                        <input type="text"
                               id="floor"
                               name="floor"
                               v-model="form.floor"
                               class="border border-gray-300 rounded-lg p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-600"
                               :class="{'border-red-500': errors.floor}"
                        >
                        <p v-if="errors.floor" class="text-red-500 text-xs mt-1">{{ errors.floor }}</p>
                    </div>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Submit
                    </button>
                    <Link :href="'/users'" class="bg-red-800 text-white px-4 py-2 rounded hover:bg-red-700 ml-4">Cancel</Link>
                </div>
            </form>
        </div>
    </main>
</template>

<script setup>
import { Link, useForm } from "@inertiajs/vue3";
import { ref, onMounted, watch } from "vue";

const props = defineProps({
    user: {
        type: Object,
        default: null,
        customer: {
            type: Object,
            default: null
        }
    },
    roles: {
        type: Object,
        default: null,
    },
    companies: {
        type: Object,
        default: null,
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
    name: "",
    company_id: null,
    role_id: null,
    email: "",
    password: "",
    address: "",
    phone: "",
    floor: "",
    _method: (props.isUpdating ? 'PUT' : 'POST'),
});

const showCustomerFields = ref(false);
const showNotCustomerFields = ref(false);

onMounted(() => {
    if (props.user && Object.keys(props.user).length > 0) {
        form.name = props.user.name;
        form.email = props.user.email;
        form.role_id = props.user.role_id;
        form.comapny_id = props.user.comapny_id;

        if (props.user.customer) {
            form.address = props.user.customer.address || "";
            form.phone = props.user.customer.phone || "";
            form.floor = props.user.customer.floor || "";
        } else {
            form.address = "";
            form.phone = "";
            form.floor = "";
        }

        if (props.user.companies) {
            props.user.companies.forEach((company) => {
                form.company_id = company.id;
            });
        }
    } else {
        form.name = "";
        form.email = "";
        form.password = "";
        form.role_id = null;
        form.company_id = null;
        form.address = "";
        form.phone = "";
        form.floor = "";
    }
    //console.log(form.role_id);
});

watch(() => form.role_id, (newRoleId) => {
    showCustomerFields.value = (newRoleId === 4);  // Change the role ID here as needed
    showNotCustomerFields.value = (newRoleId !== 4);
});

const submit = () => (props.isUpdating ? updateResource() : addResource());
const addResource = () => {
    // form.post("/ip_addresses");
    form.post('/users', {
        onError: (errors) => {
            //console.log(errors) // Logs any validation errors
        }
    })
};
const updateResource = () => { console.log('inside update')
    form.post(`/users/${props.user.id}`, {
        onError: (errors) => {
            //console.log(errors) // Logs any validation errors
        }
    });
}

</script>
