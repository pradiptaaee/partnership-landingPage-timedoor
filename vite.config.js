import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite'; 

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/css/admin.css', // Punya Anda
                'resources/css/landing/app.css', // Punya Krisna
                'resources/js/app.js', 
                'resources/js/landing_page/app.js', 
                'resources/js/landing_page/trial.js', // Punya Krisna (Penting!)
                'resources/js/admin/landing_page/app.js' // Punya Anda
            ],
            refresh: true,
        }),
        tailwindcss(), 
    ],
});