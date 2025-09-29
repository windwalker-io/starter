import { useFusion } from '@windwalker-io/fusion-next';
import { resolve } from 'node:path';
import { defineConfig, PluginOption } from 'vite';

export default defineConfig(({ mode }) => {
  return {
    define: {
      __VUE_OPTIONS_API__: 'false',
      __VUE_PROD_DEVTOOLS__: 'true',
      __VUE_PROD_HYDRATION_MISMATCH_DETAILS__: 'false'
    },
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
