import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';
import vue from '@vitejs/plugin-vue'

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/sass/app.scss'],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
            '@': '/resources/js',
            '~bootstrap':path.resolve(__dirname, "node_modules/bootstrap/dist"),
            '~bootscss':path.resolve(__dirname, "node_modules/bootstrap/scss"),
            '~booticons':path.resolve(__dirname,"node_modules/bootstrap-icons"),
        },
    },
});
