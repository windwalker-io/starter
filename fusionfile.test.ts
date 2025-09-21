import fusion from '@windwalker-io/fusion-next';
import {
  cloneAssets,
  cssModulize,
  findModules,
  installVendors,
  globalAssets,
  jsModulize
} from '@windwalker-io/core/next';
import { resolve } from 'node:path';

fusion.outDir('www/assets/');
fusion.mergeViteConfig({
  resolve: {
    alias: {
      "@": "./resources/assets",
      "@js": resolve("./resources/assets/src"),
      "@css": "./resources/assets/scss",
      "@vue": "./resources/assets/vue",
      "@images": "./resources/images",
      // "@main": resolve('./resources/assets/src/front/main.ts')
    }
  }
});
fusion.external('@main');
fusion.external('@app');
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
    // Front
    cssModulize('resources/assets/scss/front/main.scss', 'css/front/main.css')
      .parseBlades(
        findModules('Front/**/*.blade.php'),
        'src/Module/Front/**/*.blade.php'
      )
      .mergeCss(
        findModules('Front/**/assets/*.scss'),
        'src/Module/Front/**/assets/*.scss'
      ),
    // Admin
    cssModulize('resources/assets/scss/admin/main.scss', 'css/admin/main.css')
      .parseBlades(
        findModules('Admin/**/*.blade.php'),
        'src/Module/Admin/**/*.blade.php'
      )
      .mergeCss(
        findModules('Admin/**/assets/*.scss'),
        'src/Module/Admin/**/assets/*.scss'
      )
  ];
}

export function js() {
  fusion.clean('*.js', 'js/**/*', 'chunks/**/*', 'vite/**/*');

  return [
    jsModulize('resources/assets/src/front/main.ts', 'js/front/main.js')
      .stage('front')
      .mergeScripts(
        findModules('Front/**/assets/*.ts'),
        'src/Module/Front/**/assets/*.ts'
      )
      .parseBlades(
        findModules('Front/**/*.blade.php'),
        'src/Module/Front/**/*.blade.php'
      ),
    jsModulize('resources/assets/src/admin/main.ts', 'js/admin/main.js')
      .stage('admin')
      .mergeScripts(
        findModules('Admin/**/assets/*.ts'),
        'src/Module/Admin/**/assets/*.ts'
      )
      .parseBlades(
        findModules('Admin/**/*.blade.php'),
        'src/Module/Admin/**/*.blade.php'
      ),
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
  return installVendors(
    [
      '@fortawesome/fontawesome-free'
    ]
  );
}

export default [js, css, images];
