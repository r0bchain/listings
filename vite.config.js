import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
// import commonjs from '@rollup/plugin-commonjs';
import path from 'path';
// import vitePluginRequire from 'vite-plugin-require';

export default defineConfig({
    plugins: [
        // commonjs({
        //     include: /node_modules/,
        // }),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                 
                    base: null,
                    includeAbsolute: false,
                },
            },
        })
        // vitePluginRequire(),
       
    ],

    resolve:{
        alias: {
            '@': path.resolve(__dirname, 'resources/js'),
            ziggy: path.resolve('vendor/tightenco/ziggy/dist'),

        }
    },
    build: {
        outDir: 'public/build',
        commonjsOptions: {
            requireReturnsDefault: 'auto',
            transformMixedEsModules: true
        },
        minify: false

    }
});
