<?php
/**
 * Part of Windwalker project. 
 *
 * @copyright  Copyright (C) 2015 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Debugger\View;

use Windwalker\Core\View\HtmlView;

/**
 * The AbstractDebuggerHtmlView class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class AbstractDebuggerHtmlView extends HtmlView
{
	/**
	 * initialise
	 *
	 * @return  void
	 */
	protected function initialise()
	{
		$this->renderer->config->set('local_variables', true);
	}
}
