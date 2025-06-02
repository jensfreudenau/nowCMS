import {defineConfig} from 'vite';
import tailwindcss from '@tailwindcss/vite'
import laravel from 'laravel-vite-plugin';
import mkcert from 'vite-plugin-mkcert'

// import basicSsl from '@vitejs/plugin-basic-ssl'
import dns from 'node:dns'

dns.setDefaultResultOrder('verbatim')
export default defineConfig(
    {
        preview: {
            allowedHost: true
        },
        server: {
            cors: {
                origin: [
                    'https://blog.freude-now.local',
                    'https://freudefoto.local',
                ],
            },
            hmr: {
                host: 'localhost',
            },
            allowedHosts: true
        },

        plugins: [
            tailwindcss(),
            mkcert(),
            laravel({
                input: [
                    'resources/css/app.css',
                    'resources/js/app.js',
                    'resources/sass/app.scss',
                    'resources/sass/berlinerphotoblog.scss',
                    'resources/sass/streetphotoberlin.scss',
                    'resources/sass/blogfreudenow.scss'
                ],
                refresh: true,
            }),
        ],
        // css: {
        //     preprocessorOptions: {
        //         scss: {
                    // sourceMap: true // Aktiviert die Generierung von Source-Maps
        //         }
        //     }
        // },
        build: {
            rollupOptions: {
                output: {
                    manualChunks(id) {
                        if (id.includes('node_modules')) {
                            return id.toString().split('node_modules/')[1].split('/')[0].toString();
                        }
                    }
                }
            },
            // sourcemap: true // Aktiviert die Generierung von Source-Maps für den Build
        }
    });
