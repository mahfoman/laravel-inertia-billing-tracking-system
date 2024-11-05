<template>

    <main class="flex-grow bg-gray-100 py-8">
        <div class="container mx-auto p-6 bg-white shadow-lg rounded-lg max-w-4xl">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold text-gray-800">Roles</h2>
                <Link href="/roles/create" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    <i class="fas fa-plus mr-2"></i>Add Role
                </Link>
            </div>
            <table class="min-w-full bg-white">
                <thead>
                <tr>
                    <th class="py-2 px-4 border-b text-left text-gray-600 font-semibold">ID</th>
                    <th class="py-2 px-4 border-b text-left text-gray-600 font-semibold">Name</th>
                    <th class="py-2 px-4 border-b text-left text-gray-600 font-semibold">Permissions</th>
                    <th class="py-2 px-4 border-b text-left text-gray-600 font-semibold">Action</th>
                </tr>
                </thead>
                <tbody>
                <!-- Example rows, replace with dynamic content as needed -->
                <tr v-for="role in roles" :key="role.id">
                    <td class="py-2 px-4 border-b">{{ role.id }}</td>
                    <td class="py-2 px-4 border-b">{{ role.name }}</td>
                    <td class="py-2 px-4 border-b">{{ role.permissions ? role.permissions.join(', ') : 'None' }}</td>
                    <td class="py-2 px-4 border-b">
                        <Link :href="`/roles/${role.id}/edit`" class="text-blue-500 mr-4"><i class="fas fa-edit"></i></Link>
                        <button @click="deleteRole(role.id)" class="text-red-600 hover:underline"><i class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </main>
</template>

<script setup>
import { Link, useForm } from "@inertiajs/vue3";

defineProps({
    roles: {
        type: Array,
        default: () => [],
    },
});

const form = useForm({});

const deleteRole = (id) => {
    form.delete(`roles/${id}`);
};
</script>
