import fusion from '@windwalker-io/fusion-next';
import { cloneAssets, cssModulizeDeep, globalAssets, installVendors, jsModulizeDeep } from '@windwalker-io/core/next';
import { resolve } from 'node:path';

// Our Dir
fusion.outDir('www/assets/');

// Aliases
fusion.alias('~', resolve('./resources/assets'));
fusion.alias('~js', resolve('./resources/assets/src'));
fusion.alias('~vendor', resolve('./www/assets/vendor'));
fusion.alias('vue', 'vue/dist/vue.esm-bundler.js');

// Fusion Options
fusion.overrideOptions({
  chunkNameObfuscation: true
});

// Watch all blade files for changes
// fusion.fullReloads(
//   './src/Module/**/*.blade.php'
// );

// Assets
fusion.plugin(globalAssets({
  clone: {
    //
  },
  reposition: {
    //
  }
}));

export function css() {
  fusion.clean('*.css', '*.css.map', 'css/**/*');

  return [
    fusion.css('resources/assets/scss/front/bootstrap.scss', 'css/front/bootstrap.css'),
    cssModulizeDeep('Front', 'resources/assets/scss/front/main.scss', 'css/front/main.css'),
    cssModulizeDeep('Admin', 'resources/assets/scss/admin/main.scss', 'css/admin/main.css')
  ];
}

export function js() {
  fusion.clean('*.js', 'js/**/*', 'chunks/**/*', 'vite/**/*');

  return [
    jsModulizeDeep('Front', 'resources/assets/src/front/main.ts', 'js/front/main.js'),
    jsModulizeDeep('Admin', 'resources/assets/src/admin/main.ts', 'js/admin/main.js'),
  ];
}

export function images() {
  return [
    cloneAssets({
      'resources/assets/images/**/*': 'images/',
    })
  ];
}

export function install() {
  return [
    installVendors(
      [
        '@fortawesome/fontawesome-free'
      ]
    )
  ];
}

export default [js, css, images];
