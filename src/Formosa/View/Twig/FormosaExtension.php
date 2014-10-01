<?php
/**
 * Part of auth project. 
 *
 * @copyright  Copyright (C) 2011 - 2014 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Formosa\View\Twig;

use Formosa\View\Helper\ViewHelper;

/**
 * Class FormosaExtension
 *
 * @since 1.0
 */
class FormosaExtension extends \Twig_Extension
{
	/**
	 * Returns the name of the extension.
	 *
	 * @return string The extension name
	 */
	public function getName()
	{
		return 'formosa';
	}

	/**
	 * getGlobals
	 *
	 * @return  array
	 */
	public function getGlobals()
	{
		return ViewHelper::getGlobalVariables();
	}

	/**
	 * getFunctions
	 *
	 * @return  array
	 */
	public function getFunctions()
	{
		return array(
			new \Twig_SimpleFunction('show', 'show')
		);
	}
}
 