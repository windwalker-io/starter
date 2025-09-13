import { expandGlobs, findModules } from '@windwalker-io/core';
import Crypto from 'crypto';
import { globSync } from 'fast-glob';
import { readFileSync } from 'fs';
import { parse } from 'node-html-parser';
import { basename, relative, resolve } from 'path';
import { defineConfig } from 'vite';
import sassGlobImports from 'vite-plugin-sass-glob-import';

export default defineConfig({
  build: {
    manifest: true,
    rollupOptions: {
      input: {
        'main': 'main',
        'js': 'resources/assets/src/front/main.ts',
      },
      output: {
        entryFileNames: (chunkInfo) => {
          // console.log(chunkInfo);
          return '[name].js';
        },
        chunkFileNames: (chunkInfo) => {
          // console.log(chunkInfo);
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
  optimizeDeps: {
    // Supress error
    exclude: ['@windwalker-io/unicorn']
  },
  plugins: [
    sassGlobImports(),
    {
      name: 'merge-module-scss',
      enforce: 'pre',
      resolveId(id) {
        if (id === 'main') {
          return 'resources/assets/scss/front/main.scss';
        }
      },

      async load(id) {
        if (id !== 'resources/assets/scss/front/main.scss') {
          return null;
        }

        const patterns = [
          ...expandGlobs(findModules('Front/**/assets/*.scss')),
          ...expandGlobs('src/Module/Front/**/assets/*.scss')
        ].map(file => resolve(file));

        const imports = patterns
          .map((pattern) => `@import "${pattern.replace(/\\/g, '/')}";`)
          .concat(parseStylesFromBlades('src/Module/Front/**/*.blade.php'))
          .join('\n');

        let main = readFileSync('resources/assets/scss/front/main.scss', 'utf-8');

        main += `\n\n${imports}\n`;

        return main;

        // // 使用絕對路徑（posix），讓 Sass 能直接載入實體檔案
        // const mainAbs = toPosix(path.resolve(root, main));
        // const importLines = [`@import "${mainAbs}";`, '/* auto-generated module imports */'];
        //
        // for (const f of files) {
        //   const abs = toPosix(path.resolve(root, f));
        //   importLines.push(`@import "${abs}";`);
        // }
        //
        // return importLines.join('\n') + '\n';
      },
    }
  ]
});

function parseStylesFromBlades(patterns: string | string[]) {
  let files = globSync(patterns);
  
  return files.map((file) => {
    const bladeText = readFileSync(file, 'utf8');

    const html = parse(bladeText);

    return html.querySelectorAll('style[type],script[type]')
      .filter(
        (el) => ['text/scss', 'text/css'].includes(el.getAttribute('type'))
      )
      .map((el) => {
        const scope = el.getAttribute('data-scope');
        
        if (scope) {
          return `${scope} {
          ${el.innerHTML}
        }`;
        } else {
          return el.innerHTML;
        }
      });
  })
    .filter((c) => c.length > 0)
    .flat();
}

function fileNameHash(bufferOrString: Crypto.BinaryLike, short = 8) {
  return Crypto.createHash('sha1')
    .update(bufferOrString)
    .digest('hex')
    .substring(0, short);
}

function getStyleScope(fullLayout: string): string {
  const relativePath = relative(process.cwd(), fullLayout);
  const segments = basename(relativePath).split('.');
  const layoutName = segments.shift() || '';

  return layoutName + '-' + fileNameHash(relativePath, 8);
}
