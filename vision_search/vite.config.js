import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/capturestyle.css', 'resources/js/capturefunction.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
