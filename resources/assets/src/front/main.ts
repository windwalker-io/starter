import 'bootstrap';
import { App, defineJsModules } from '@windwalker-io/core/app';
import { pushUnicornToGlobal, useUIBootstrap5, useUnicorn, useUnicornPhpAdapter } from '@windwalker-io/unicorn-next';
import { useLuna } from '@lyrasoft/luna';

const app = new App(defineJsModules());

const u = useUnicorn();

await useUIBootstrap5(true, true);

useUnicornPhpAdapter();

pushUnicornToGlobal();
useLuna();

export { app as default, u };
