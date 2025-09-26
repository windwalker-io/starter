import 'bootstrap';
import { App, defineJsModules } from '@windwalker-io/core/app';
import { useUIBootstrap5, useUnicorn } from '@windwalker-io/unicorn-next';

const app = new App(defineJsModules());
const u = useUnicorn();
await useUIBootstrap5(true);

export { app as default, u };
