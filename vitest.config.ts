import vue from '@vitejs/plugin-vue';
import { defineConfig } from 'vitest/config';

export default defineConfig({
    plugins: [vue()],
    resolve: {
        alias: {
            '@': '/resources/js',
        },
    },
    test: {
        environment: 'jsdom',
        include: ['resources/js/**/*.spec.ts'],
    },
});
