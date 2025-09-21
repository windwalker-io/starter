import * as bootstrap from 'bootstrap';
import '@windwalker-io/unicorn-next';
import '@windwalker-io/unicorn-next/dist/ui/ui-bootstrap5.js';

u.use(UIBootstrap5.UIBootstrap5);
window.bootstrap = bootstrap;

export { u };
