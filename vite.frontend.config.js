import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            buildDirectory: 'frontend',
            input: [
                'resources/css/frontend.css',
                'resources/js/frontend.js'
            ],
            refresh: true,
        }),
    ],
});
