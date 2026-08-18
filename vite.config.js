import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        host: '0.0.0.0',
        port: 5173,
        origin: 'http://192.168.1.24:5173', // ganti sesuai IP WiFi laptop kamu
        hmr: {
            host: '192.168.1.24', // sama, ganti sesuai IP kamu
        },
    },
});