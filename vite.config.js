import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    // Adding Axios as an external dependency to resolve MIME type issues.
    // Using axios to make HTTP requests that don’t require a full Inertia page load
    optimizeDeps: {
        include: ['axios'],
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue(),
    ],
});
