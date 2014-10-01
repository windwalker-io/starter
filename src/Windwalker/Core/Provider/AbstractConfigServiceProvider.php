<?php
/**
 * Part of starter project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Core\Provider;

use Windwalker\DI\ServiceProviderInterface;
use Windwalker\Registry\Registry;

/**
 * The AbstractConfigServiceProvider class.
 * 
 * @since  {DEPLOY_VERSION}
 */
abstract class AbstractConfigServiceProvider implements ServiceProviderInterface
{
	/**
	 * Property config.
	 *
	 * @var \Windwalker\Registry\Registry
	 */
	protected $config;

	/**
	 * Class init.
	 *
	 * @param $config
	 */
	public function __construct(Registry $config = null)
	{
		$this->config = $config ? : new Registry;
	}
}
 