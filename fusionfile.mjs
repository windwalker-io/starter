/**
 * Part of Windwalker Fusion project.
 *
 * @copyright  Copyright (C) 2021 LYRASOFT.
 * @license    MIT
 */

import fusion, { sass, babel, parallel } from '@windwalker-io/fusion';
import { execSync } from 'child_process';
import { jsSync } from '@windwalker-io/core';

export async function css() {
  // Watch start
  fusion.watch(['resources/assets/scss/**/*.scss', 'src/Module/**/assets/*.scss']);
  // Watch end

  // Compile Start
  sass(
    [
      'resources/assets/scss/front/main.scss',
      'src/Module/Front/**/assets/*.scss'
    ],
    'www/assets/css/front/app.css'
  );
  sass(
    [
      'resources/assets/scss/admin/main.scss',
      'src/Module/Admin/**/assets/*.scss'
    ],
    'www/assets/css/admin/app.css'
  );
  // Compile end
}

export async function js() {
  // Watch start
  fusion.watch('resources/assets/src/**/*.{js,mjs}');
  // Watch end

  // Compile Start
  babel('resources/assets/src/**/*.{js,mjs}', 'www/assets/js/', { module: 'systemjs' });
  // Compile end
}

export async function images() {
  // Watch start
  fusion.watch('resources/assets/images/**/*');
  // Watch end

  // Compile Start
  return await fusion.copy('resources/assets/images/**/*', 'www/assets/images/')
  // Compile end
}

export async function sync() {
  // Watch start
  fusion.watch('src/Module/**/assets/**/*.{js,mjs}');
  // Watch end

  // Compile Start
  const { dest } = await jsSync(
    'src/Module/',
    'www/assets/js/view/'
  );

  babel(
    dest.path + '**/*.{mjs,js}',
    null,
    { module: 'systemjs' }
  )
  // Compile end

  return Promise.all([]);
}

// export async function sync() {
//   // Watch start
//   fusion.watch('src/Component/**/view/**/*.js');
//   // Watch end
//
//   // Compile Start
//   const wait = [];
//   let js = JSON.parse(execSync('php windwalker assets:sync "src/Component" --type=js').toString());
//
//   for (let key in js) {
//     console.log(`Copy: ${key} ==> www/asset/js/@view/${js[key]}`);
//     wait.push(fusion.js(key, `www/asset/js/@view/${js[key]}`));
//   }
//
//   const css = JSON.parse(execSync('php windwalker assets:sync "src/Component" --type=css').toString());
//
//   wait.push(
//     fusion.sass([...css], 'www/asset/css/main.css')
//   );
//   // Compile end
//
//   return Promise.all(wait);
// }

export async function install() {
  const vendors = [
    // Unicorn
    '@fortawesome/fontawesome-free',

    '@windwalker-io/unicorn',
    'systemjs',
    'alpinejs',
    '@ryangjchandler/spruce',
    'axios',
    'awesome-bootstrap-checkbox',
    'flatpickr',
    'tinymce',

    // Babel
    'regenerator-runtime'
  ];

  vendors.forEach((vendor) => {
    console.log(`[Link] node_modules/${vendor}/**/* => www/assets/vendor/${vendor}/`);
    fusion.src(`node_modules/${vendor}/`).pipe(fusion.symlink(`www/assets/vendor/${vendor}`));
  });

  console.log('[Copy] resources/assets/vendor/**/* => www/assets/vendor/');
  fusion.copy('resources/assets/vendor/**/*', 'www/assets/vendor/');
}

export default parallel(css, sync, js, images);

/*
 * APIs
 *
 * Compile entry:
 * fusion.js(source, dest, options = {})
 * fusion.babel(source, dest, options = {})
 * fusion.module(source, dest, options = {})
 * fusion.ts(source, dest, options = {})
 * fusion.typeScript(source, dest, options = {})
 * fusion.css(source, dest, options = {})
 * fusion.sass(source, dest, options = {})
 * fusion.copy(source, dest, options = {})
 *
 * Live Reload:
 * fusion.livereload(source, dest, options = {})
 * fusion.reload(file)
 *
 * Gulp proxy:
 * fusion.src(source, options)
 * fusion.dest(path, options)
 * fusion.watch(glob, opt, fn)
 * fusion.symlink(directory, options = {})
 * fusion.lastRun(task, precision)
 * fusion.tree(options = {})
 * fusion.series(...tasks)
 * fusion.parallel(...tasks)
 *
 * Stream Helper:
 * fusion.through(handler) // Same as through2.obj()
 *
 * Config:
 * fusion.disableNotification()
 * fusion.enableNotification()
 */
