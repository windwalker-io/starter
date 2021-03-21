/**
 * Part of Windwalker Fusion project.
 *
 * @copyright  Copyright (C) 2021 LYRASOFT.
 * @license    MIT
 */

import fusion, { waitAllEnded } from '@windwalker-io/fusion';
import { execSync } from 'child_process';

export async function main() {
  // Watch start
  fusion.watch('resources/asset/scss/**/*.scss');
  // Watch end

  // Compile Start
  fusion.sass('resources/asset/scss/**/*.scss', 'www/asset/css/app.css');
  // Compile end
}

export async function js() {
  // Watch start
  fusion.watch('src/Component/**/asset/**/*.{js,mjs}');
  // Watch end

  // Compile Start
  fusion.copy('src/Component/**/asset/**/*.{js,mjs}', 'www/asset/@test/');
  // Compile end
}

export async function sync() {
  // Watch start
  fusion.watch('src/Component/**/view/**/*.js');
  // Watch end

  // Compile Start
  const wait = [];
  let js = JSON.parse(execSync('php windwalker asset:sync "src/Component" --type=js').toString());

  for (let key in js) {
    console.log(`Copy: ${key} ==> www/asset/js/@view/${js[key]}`);
    wait.push(fusion.js(key, `www/asset/js/@view/${js[key]}`));
  }

  const css = JSON.parse(execSync('php windwalker asset:sync "src/Component" --type=css').toString());

  wait.push(
    fusion.sass([...css], 'www/asset/css/main.css')
  );
  // Compile end

  return Promise.all(wait);
}

export async function install() {
  const vendors = [
    //
  ];

  vendors.forEach((vendor) => {
    console.log(`[Copy] node_modules/${vendor}/**/* => www/asset/vendor/${vendor}/`);
    fusion.copy(`node_modules/${vendor}/**/*`, `www/asset/vendor/${vendor}/`);
  });

  console.log('[Copy] resources/asset/vendor/**/* => www/asset/vendor/');
  fusion.copy('resources/asset/vendor/**/*', 'www/asset/vendor/');
}

export default main;

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
