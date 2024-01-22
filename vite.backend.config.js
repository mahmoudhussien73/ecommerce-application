import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'
export default defineConfig({
    plugins: [
        laravel({
            buildDirectory: 'backend',
            input: [
                'resources/css/backend.css',
                'resources/js/backend.js',
                'resources/js/vueapp.js',
            ],
            refresh: true,
        }),
        vue({
            template: {
              compilerOptions: {
                isCustomElement: (tag) => ['md-linedivider'].includes(tag),
              }
            }
          })
    ],
    resolve: {
        alias: {
          vue: 'vue/dist/vue.esm-bundler.js',
        },
    },
});
