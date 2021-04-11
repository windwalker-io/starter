/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

import u from '@main';

window.gridState = u.grid('#grid-form').useState();

u.$ui.bootstrap.tooltip();

// u.initAlpine();
u.initAlpine('#grid-form');
