import 'bootstrap';
import { App, defineJsModules } from '@windwalker-io/core/app';
import { pushUnicornToGlobal, useUIBootstrap5, useUnicorn, useUnicornPhpAdapter } from '@windwalker-io/unicorn-next';
import { useLuna } from '~vendor/lyrasoft/luna/dist/luna';

const app = new App(defineJsModules());

const u = useUnicorn();

await useUIBootstrap5(true, true);

useUnicornPhpAdapter();

pushUnicornToGlobal();
useLuna();

export { app as default, u };
