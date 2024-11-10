<template>

    <main class="flex-grow bg-gray-100 py-8">
        <div class="container mx-auto max-w-4xl p-6 bg-white shadow-lg rounded-lg">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">{{props.isUpdating ? 'Edit' : 'Add'}} Company</h2>
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
                    <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
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
                    <label for="phone" class="block text-gray-700 font-semibold mb-2">Phone</label>
                    <input type="text"
                           id="phone"
                           name="phone"
                           v-model="form.phone"
                           class="border border-gray-300 rounded-lg p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-600"
                           :class="{'border-red-500': errors.phone}"
                    >
                    <!-- Error Message -->
                    <p v-if="errors.phone" class="text-red-500 text-xs mt-1">{{ errors.phone }}</p>
                </div>
                <div class="mb-4">
                    <label for="website" class="block text-gray-700 font-semibold mb-2">Website</label>
                    <input type="text"
                           id="website"
                           name="website"
                           v-model="form.website"
                           class="border border-gray-300 rounded-lg p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-600"
                           :class="{'border-red-500': errors.website}"
                    >
                    <!-- Error Message -->
                    <p v-if="errors.website" class="text-red-500 text-xs mt-1">{{ errors.website }}</p>
                </div>
                <div class="mb-5">
                    <label for="logo" class="block text-gray-700 font-semibold mb-2">Company Logo</label>
                    <input type="file" @input="form.logo = $event.target.files[0]" />
                    <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                        {{ form.progress.percentage }}%
                    </progress>

<!--                    <div v-if="company && company.logo" class="">-->
<!--                        <img :src="`/storage/companies/${company.logo}`" alt="Uploaded Image" />-->
<!--                    </div>-->
                </div>
                <!-- Submit Button -->
                <div>
                    <button type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Submit
                    </button>
                    <Link :href="'/companies'" class="bg-red-800 text-white px-4 py-2 rounded hover:bg-red-700 ml-4">Cancel</Link>
                </div>
            </form>
        </div>
    </main>
</template>

<script setup>
import { Link, useForm } from "@inertiajs/vue3";
import { onMounted } from "vue";

const props = defineProps({
    company: {
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
    email: "",
    phone: "",
    website: "",
    logo : null,
    _method: (props.isUpdating ? 'PUT' : 'POST'),
});

onMounted(() => {
    if (props.company && Object.keys(props.company).length > 0) {
        form.name = props.company.name;
        form.email = props.company.email;
        form.phone = props.company.phone;
        form.website = props.company.website;
        form.logo = null;
    } else {
        form.name = "";
        form.email = "";
        form.phone = "";
        form.website = "";
        form.logo = null;
    }
});

const submit = () => (props.isUpdating ? updateResource() : addResource());
const addResource = () => {
    // form.post("/ip_addresses");
    form.post('/companies', {
        onError: (errors) => {
            //console.log(errors) // Logs any validation errors
        }
    })
};
const updateResource = () => {
    form.post(`/companies/${props.company.id}`, {
        onError: (errors) => {
            //console.log(errors) // Logs any validation errors
        }
    });
}

</script>
