/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

import u from '@main';
import '@vendor/choices.js/public/assets/scripts/choices.min.js';

u.importCSS(
  '@vendor/choices.js/public/assets/styles/choices.min.css',
  '@vendor/choices.js/public/assets/styles/choices.min.css'
);

u.$ui.bootstrap.tooltip();

u.grid('#grid-form').initComponent();

new Choices('select');
