import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css',
                    'resources/js/app.js',

                    'resources/register/js/jquery.min.js',
                    'resources/register/css/style.css',
                    'resources/register/fonts/material-icon/css/material-design-iconic-font.min.css',

                    'resources/login/css/main.css',
                    'resources/login/js/main.js',

                    'resources/home/css/main.css',
                    'resources/home/js/create-task.js',
                    'resources/home/js/finish-task.js',

                    'resources/error/css/error404.css'],
            refresh: true,
        }),
    ],
});
