<template>

    <main class="flex-grow bg-gray-100 py-8">
        <div class="container mx-auto max-w-4xl p-6 bg-white shadow-lg rounded-lg">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">{{props.isUpdating ? 'Edit' : 'Add'}} Package</h2>
            <form @submit.prevent="submit">
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
                    <label for="email" class="block text-gray-700 font-semibold mb-2">Price</label>
                    <input type="text"
                           id="price"
                           name="price"
                           v-model="form.price"
                           class="border border-gray-300 rounded-lg p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-600"
                           :class="{'border-red-500': errors.price}"
                    >
                    <!-- Error Message -->
                    <p v-if="errors.price" class="text-red-500 text-xs mt-1">{{ errors.price }}</p>
                </div>
                <div class="mb-4">
                    <label for="phone" class="block text-gray-700 font-semibold mb-2">Speed (MB)</label>
                    <input type="text"
                           id="speed"
                           name="speed"
                           v-model="form.speed"
                           class="border border-gray-300 rounded-lg p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-600"
                           :class="{'border-red-500': errors.speed}"
                    >
                    <!-- Error Message -->
                    <p v-if="errors.speed" class="text-red-500 text-xs mt-1">{{ errors.speed }}</p>
                </div>
                <div class="mb-4">
                    <label for="website" class="block text-gray-700 font-semibold mb-2">Description</label>
                    <input type="text"
                           id="description"
                           name="description"
                           v-model="form.description"
                           class="border border-gray-300 rounded-lg p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-600"
                           :class="{'border-red-500': errors.description}"
                    >
                    <!-- Error Message -->
                    <p v-if="errors.description" class="text-red-500 text-xs mt-1">{{ errors.description }}</p>
                </div>
                <!-- Submit Button -->
                <div>
                    <button type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Submit
                    </button>
                    <Link :href="'/packages'" class="bg-red-800 text-white px-4 py-2 rounded hover:bg-red-700 ml-4">Cancel</Link>
                </div>
            </form>
        </div>
    </main>
</template>

<script setup>
import { Link, useForm } from "@inertiajs/vue3";
import { onMounted } from "vue";

const props = defineProps({
    package: {
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
    name: "",
    price: "",
    speed: "",
    description: "",
});

onMounted(() => {
    if (props.package && Object.keys(props.package).length > 0) {
        form.name = props.package.name;
        form.price = props.package.price;
        form.speed = props.package.speed;
        form.description = props.package.description;
    } else {
        form.name = "";
        form.price = "";
        form.speed = "";
        form.description = "";
    }
});

const submit = () => (props.isUpdating ? updateResource() : addResource());
const addResource = () => {
    // form.post("/ip_addresses");
    form.post('/packages', {
        onError: (errors) => {
            //console.log(errors) // Logs any validation errors
        }
    })
};
const updateResource = () => {
    form.post(`/packages/${props.package.id}`, {
        onError: (errors) => {
            //console.log(errors) // Logs any validation errors
        }
    });
}

</script>
