import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';

export default defineConfig({
  build: {
    rollupOptions: {
      input: {
        'loader': 'core-loader',
        'js/app': 'resources/assets/src/front/main.ts',
        'css/main': 'resources/assets/scss/front/main.scss',
      },
      output: {
        entryFileNames: (chunkInfo) => {
          console.log(chunkInfo);
          return '[name].js';
        },
        chunkFileNames: (chunkInfo) => {
          console.log(chunkInfo);
          return '[name].js';
        },
        assetFileNames: (assetInfo) => {
          // console.log(assetInfo);
          return '[name].[ext]';
        }
      }
    },
    outDir: 'www/assets/vite/',
    minify: false,
    emptyOutDir: true,
  },
  plugins: [
    {
      name: 'v',
      resolveId(id) {
        if (id === 'core-loader') {
          return id;
        }
      },
      load(id) {
        if (id === 'core-loader') {
          return `
            console.log('WEERT');
          `;
        }
      }
    }
  ]
});

