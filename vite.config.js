import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import basicSsl from '@vitejs/plugin-basic-ssl'

export default defineConfig({
    server: {
        https: {
            key: '/Users/jensfreudenau/berlinerphpotoblog.local/key.pem',  // Pfad zum privaten Schlüssel
            cert: '/Users/jensfreudenau/berlinerphpotoblog.local/cert.pem' // Pfad zum Zertifikat
        },
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/editorjs.js',
                'resources/sass/app.scss',
                'resources/sass/berlinerphotoblog.scss',
                'resources/sass/streetphotoberlin.scss'
            ],
            refresh: true,
        }),
    ],
    css: {
        preprocessorOptions: {
            scss: {
                sourceMap: true // Aktiviert die Generierung von Source-Maps
            }
        }
    },
    build: {
        sourcemap: true // Aktiviert die Generierung von Source-Maps für den Build
    }
});
