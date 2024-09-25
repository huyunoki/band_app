import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/index.css',
                'resources/js/app.js',
                'resources/js/calendar.js',
                'resources/css/upload.css',
                'resources/css/navigation.css',
                'resources/css/login.css',
                'resources/css/register.css',
                'resources/css/forgot.css',
                'resources/css/dashboard.css',
                'resources/css/calendar.css',
                'resources/css/message.css',
                'resources/css/chat.css',
                'resources/css/listen.css',
                'resources/css/user-listen.css',
            ],
            refresh: true,
        }),
    ],
});
