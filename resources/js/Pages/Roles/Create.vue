<template>

    <main class="flex-grow bg-gray-100 py-8">
        <div class="container mx-auto max-w-4xl p-6 bg-white shadow-lg rounded-lg">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Add Role</h2>
            <form>
                <!-- Role Name Input -->
                <div class="mb-4">
                    <label for="role-name" class="block text-gray-700 font-semibold mb-2">Role Name</label>
                    <input type="text" id="role-name" name="role-name" required
                           class="border border-gray-300 rounded-lg p-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-600">
                </div>

                <!-- Permissions Section -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Permissions</label>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="checkbox" name="permissions" value="view" class="mr-2">
                            <span>View</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="permissions" value="edit" class="mr-2">
                            <span>Edit</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="permissions" value="delete" class="mr-2">
                            <span>Delete</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="permissions" value="create" class="mr-2">
                            <span>Create</span>
                        </label>
                    </div>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </main>
</template>

<script setup>
import { Link, useForm } from "@inertiajs/vue3";


</script>
