<?php
/**
 * Part of Admin project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin;

use Lyrasoft\Warder\Helper\UserHelper;
use Phoenix\Language\TranslatorHelper;
use Phoenix\Script\BootstrapScript;
use Windwalker\Core\Asset\Asset;
use Windwalker\Core\Package\AbstractPackage;
use Windwalker\Core\Router\CoreRouter;
use Windwalker\Debugger\Helper\DebuggerHelper;
use Windwalker\Filesystem\Folder;
use Windwalker\Router\Exception\RouteNotFoundException;

if (!defined('PACKAGE_ADMIN_ROOT'))
{
	define('PACKAGE_ADMIN_ROOT', __DIR__);
}

/**
 * The AdminPackage class.
 *
 * @since  1.0
 */
class AdminPackage extends AbstractPackage
{
	/**
	 * initialise
	 *
	 * @throws  \LogicException
	 * @return  void
	 */
	public function boot()
	{
		parent::boot();

		// Add your own boot logic
	}

	/**
	 * prepareExecute
	 *
	 * @return  void
	 */
	protected function prepareExecute()
	{
		$this->checkAccess();

		// Assets
		BootstrapScript::css();
		BootstrapScript::script();
		Asset::addCSS($this->name . '/css/admin.css');

		// Language
		TranslatorHelper::loadAll($this, 'ini');
	}

	/**
	 * checkAccess
	 *
	 * @return  void
	 *
	 * @throws  RouteNotFoundException
	 * @throws  \Exception
	 */
	protected function checkAccess()
	{
		// Add your access checking
		if (!UserHelper::authorise() /* && User::get()->group == 2 */)
		{
			UserHelper::goToLogin($this->app->uri->full);
		}
	}

	/**
	 * postExecute
	 *
	 * @param string $result
	 *
	 * @return  string
	 */
	protected function postExecute($result = null)
	{
		if (WINDWALKER_DEBUG)
		{
			if (class_exists(DebuggerHelper::class))
			{
				DebuggerHelper::addCustomData('Language Orphans', '<pre>' . TranslatorHelper::getFormattedOrphans() . '</pre>');
			}
		}

		return $result;
	}

	/**
	 * loadRouting
	 *
	 * @param CoreRouter $router
	 * @param string     $group
	 *
	 * @return CoreRouter
	 */
	public function loadRouting(CoreRouter $router, $group = null)
	{
		$router = parent::loadRouting($router, $group);

		$router->group($group, function (CoreRouter $router)
		{
			$router->addRouteFromFiles(Folder::files(__DIR__ . '/Resources/routing'), $this->getName());

			// Merge other routes here...
		});

		return $router;
	}
}
