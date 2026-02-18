import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite'; // <--- Import Plugin v4

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/css/landing/app.css',
                'resources/js/app.js', 
                'resources/js/landing_page/app.js',
                'resources/js/landing_page/trial.js'
            ],
            refresh: true,
        }),
        tailwindcss(), 
    ],
});