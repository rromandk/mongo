import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        host: '0.0.0.0',   // 👈 clave para Docker
        port: 5173,
        strictPort: true,
        watch: {
            usePolling: true, // 👈 evita problemas de filesystem en Docker
        },
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});