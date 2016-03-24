<?php
/**
 * Part of Front project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Front;

use Front\Listener\ViewListener;
use Lyrasoft\Luna\Helper\LunaHelper;
use Phoenix\Language\TranslatorHelper;
use Phoenix\Script\BootstrapScript;
use Symfony\Component\Yaml\Yaml;
use Windwalker\Core\Package\AbstractPackage;
use Windwalker\Debugger\Helper\DebuggerHelper;
use Windwalker\Event\Dispatcher;
use Windwalker\Filesystem\File;
use Windwalker\Filesystem\Folder;
use Windwalker\Warder\Helper\WarderHelper;

/**
 * The FrontPackage class.
 *
 * @since  1.0
 */
class FrontPackage extends AbstractPackage
{
	/**
	 * initialise
	 *
	 * @throws  \LogicException
	 * @return  void
	 */
	public function initialise()
	{
		parent::initialise();
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

		// Language
		TranslatorHelper::loadAll($this, 'ini');
	}

	/**
	 * checkAccess
	 *
	 * @return  void
	 */
	protected function checkAccess()
	{

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
			if (class_exists('Windwalker\Debugger\Helper\DebuggerHelper'))
			{
				DebuggerHelper::addCustomData('Language Orphans', '<pre>' . TranslatorHelper::getFormattedOrphans() . '</pre>');
			}

			// Un comment this line, Translator will export all orphans to /cache/language
			TranslatorHelper::dumpOrphans('ini');
		}

		return $result;
	}

	/**
	 * registerListeners
	 *
	 * @param Dispatcher $dispatcher
	 *
	 * @return  void
	 */
	public function registerListeners(Dispatcher $dispatcher)
	{
		parent::registerListeners($dispatcher);

		$dispatcher->addListener(new ViewListener);
	}

	/**
	 * loadRouting
	 *
	 * @return  mixed
	 */
	public function loadRouting()
	{
		$routes = parent::loadRouting();

		foreach (Folder::files(__DIR__ . '/Resources/routing') as $file)
		{
			if (File::getExtension($file) == 'yml')
			{
				$routes = array_merge($routes, Yaml::parse(file_get_contents($file)));
			}
		}

		// Merge other routes here...
		$routes = array_merge($routes, WarderHelper::getFrontendRouting());
		$routes = array_merge($routes, LunaHelper::getFrontendRouting());

		return $routes;
	}
}
