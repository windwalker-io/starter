import * as fusion from '@windwalker-io/fusion-next';
import {
  cloneAssets,
  cssModulize,
  findModules,
  installVendors,
  windwalkerAssets
} from './vendor/windwalker/core/assets/core/next';

fusion.outDir('www/assets/');
fusion.mergeViteConfig({
  resolve: {
    // alias: {
    //   "@": "./resources",
    //   "@js": "./resources/js",
    //   "@css": "./resources/css",
    //   "@vue": "./resources/vue",
    //   "@images": "./resources/images",
    // }
  }
})
fusion.plugin(windwalkerAssets({
  clone: {
    //
  },
  reposition: {
    //
  }
}));

export function js() {
  fusion.clean('*.js', 'chunks/**/*', 'vite/**/*');

  return [
    fusion.js('resources/assets/src/front/main.ts')
  ];
}

export function css() {
  fusion.clean('*.css', '*.css.map');

  return [
    cssModulize('resources/assets/scss/front/main.scss', 'app.css')
      .parseBlades(
        findModules('Front/**/*.blade.php'),
        'src/Module/Front/**/*.blade.php'
      )
      .mergeCss(
        findModules('Front/**/assets/*.scss'),
        'src/Module/Front/**/assets/*.scss'
      )
  ];
}

export function assets() {
  return [
    cloneAssets({
      'resources/assets/images/**/*': 'images/',
    })
  ];
}

export function install() {
  return installVendors(
    [
      '@fortawesome/fontawesome-free'
    ]
  );
}

export default [js, css, assets];
