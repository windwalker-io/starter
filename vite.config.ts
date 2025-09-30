import { useFusion } from '@windwalker-io/fusion-next';
import { defineConfig } from 'vite';

export default defineConfig(({ mode }) => {
  return {
    base: './',
    build: {
      sourcemap: false,
      minify: mode === 'production',
    },
    // Fix SASS issues
    css: {
      preprocessorOptions: {
        scss: {
          silenceDeprecations: ['mixed-decls', 'color-functions', 'global-builtin', 'import']
        },
      }
    },
    plugins: [
      useFusion(() => import('./fusionfile')),
    ]
  };
});
