import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from 'tailwindcss';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    optimizeDeps: {
        include: ['flowbite'],
    },
    // server: {
    //     hmr: {
    //         host: ' https://bb5b-103-124-196-126.ngrok-free.app',
    //         protocol: 'wss',
    //     },
    // }
});
