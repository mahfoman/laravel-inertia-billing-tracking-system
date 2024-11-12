<template>

    <main class="flex-grow py-8">
        <div class="container mx-auto max-w-4xl p-6 bg-white shadow-lg rounded-lg">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Add IP Address</h2>
            <form @submit.prevent="submit">
                <!-- Role Name Input -->
                <div class="mb-4">
                    <label for="role-name" class="block text-gray-700 font-semibold mb-2">IP</label>
                    <input type="text"
                           id="ip_address"
                           name="ip_address"
                           v-model="form.ip_address"
                           class="border border-gray-300 rounded-lg p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-600"
                           :class="{'border-red-500': errors.name}"
                    >
                    <!-- Error Message for Role Name -->
                    <p v-if="errors.ip_address" class="text-red-500 text-xs mt-1">{{ errors.ip_address }}</p>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Submit
                    </button>
                    <Link :href="'/ip_addresses'" class="bg-red-800 text-white px-4 py-2 rounded hover:bg-red-700 ml-4">Cancel</Link>
                </div>
            </form>
        </div>
    </main>
</template>

<script setup>
import { Link, useForm } from "@inertiajs/vue3";
import { onMounted } from "vue";

const props = defineProps({
    ipAddress: {
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
    },
});

const form = useForm({
    ip_address: "",
});

const submit = () => (props.isUpdating ? updateIP() : addIP());
const addIP = () => {
    // form.post("/ip_addresses");
    form.post('/ip_addresses', {
        onError: (errors) => {
            //console.log(errors) // Logs any validation errors
        }
    })
};
const updateIP = () => {
    form.put(`/ip_addresses/${props.ipAddress.id}`, {
        onError: (errors) => {
            //console.log(errors) // Logs any validation errors
        }
    });
}

onMounted(() => {
    if (props.ipAddress && Object.keys(props.ipAddress).length > 0) {
        form.ip_address = props.ipAddress.ip_address;
    } else {
        form.ip_address = "";
    }
});

</script>
