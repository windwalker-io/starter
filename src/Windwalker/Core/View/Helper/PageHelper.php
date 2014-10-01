<?php
/**
 * Part of formosa project.
 *
 * @copyright  Copyright (C) 2011 - 2014 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Windwalker\Core\View\Helper;

/**
 * Class ViewHelper
 *
 * @since 1.0
 */
class PageHelper extends AbstractHelper
{
	/**
	 * getId
	 *
	 * @param \Windwalker\Data\Data $view
	 *
	 * @return  string
	 */
	public function getId($view)
	{
		return $view->name;
	}

	/**
	 * getClass
	 *
	 * @param \Windwalker\Data\Data $view
	 *
	 * @return  string
	 */
	public function getClass($view)
	{
		return 'view-' . $view->name . ' ' . 'layout-' . $view->layout;
	}

	/**
	 * showFlash
	 *
	 * @param array $flashes
	 *
	 * @return  string
	 */
	public static function showFlash($flashes)
	{
		if (! $flashes)
		{
			return '';
		}

		$html = '<div class="message-wrap">';

		foreach ((array) $flashes as $type => $typeBag)
		{
			$html .= '<div class="alert alert-' . $type . ' alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert">
						  <span aria-hidden="true">&times;</span>
						  <span class="sr-only">Close</span>
						</button>';

			foreach ((array) $typeBag as $msg)
			{
				$html .= '<p>' . $msg . '</p>';
			}

			$html .= '</div>';
		}

		$html .= '</div>';

		return $html;
	}
}
 