<?php
/**
 * Part of formosa project. 
 *
 * @copyright  Copyright (C) 2011 - 2014 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Formosa\Application;

use Formosa\Factory;
use Formosa\Provider\DatabaseProvider;
use Symfony\Component\Yaml\Yaml;
use Windwalker\Application\AbstractWebApplication;
use Windwalker\DI\Container;
use Windwalker\Router\RestRouter;

/**
 * Class Application
 *
 * @since 1.0
 */
class WebApplication extends AbstractWebApplication
{
	/**
	 * Property router.
	 *
	 * @var  \Windwalker\Router\Router
	 */
	protected $router = null;

	/**
	 * Property container.
	 *
	 * @var Container
	 */
	protected $container;

	/**
	 * initialise
	 *
	 * @return  void
	 */
	protected function initialise()
	{
		$this->loadConfiguration($this->config);

		if ($this->config->get('system.debug'))
		{
			\Formosa\Error\SimpleErrorHandler::registerErrorHandler();
		}

		Factory::$app = $this;

		$this->container = Factory::getContainer();

		// Debug system
		define('FORMOSA_DEBUG', $this->config->get('system.debug'));

		$this->registerProviders($this->container);
	}

	/**
	 * registerProviders
	 *
	 * @param Container $container
	 *
	 * @return  void
	 */
	protected function registerProviders(Container $container)
	{
		$container->registerServiceProvider(new DatabaseProvider);
	}

	/**
	 * loadConfiguration
	 *
	 * @param \Joomla\Registry\Registry $config
	 *
	 * @return  void
	 */
	protected function loadConfiguration($config)
	{
	}

	/**
	 * Method to run the application routines.  Most likely you will want to instantiate a controller
	 * and execute it, or perform some sort of task directly.
	 *
	 * @return  void
	 *
	 * @since   1.0
	 */
	protected function doExecute()
	{
		$controller = $this->getController();

		$controller = new $controller($this->input, $this);

		$this->setBody($controller->execute());
	}

	/**
	 * getRouter
	 *
	 * @return  \Windwalker\Router\Router
	 */
	public function getRouter()
	{
		if (!$this->router)
		{
			$router = new RestRouter;

			$routing = $this->loadRoutingConfiguration();

			$router->setMethod($this->input->getMethod())
				->setCustomMethod($this->input->get->get('_method'))
				->addMaps($routing)
				->allowCustomMethod(true);

			$this->router = $router;
		}

		return $this->router;
	}

	/**
	 * getController
	 *
	 * @param string $route
	 *
	 * @return  mixed
	 */
	public function getController($route = null)
	{
		$route = $route ? : $this->get('uri.route');

		$router = $this->getRouter();

		$class = $router->match($route);

		$requests = $router->getRequests();

		foreach ($requests as $name => $value)
		{
			$this->input->def($name, $value);

			// Don't forget to do an explicit set on the GET superglobal.
			$this->input->get->def($name, $value);
		}

		return $class;
	}

	/**
	 * loadRoutingConfiguration
	 *
	 * @return  mixed
	 */
	protected function loadRoutingConfiguration()
	{
		return Yaml::parse(file_get_contents(FORMOSA_ETC . '/routing.yml'));
	}

	/**
	 * getContainer
	 *
	 * @return  \Windwalker\DI\Container
	 */
	public function getContainer()
	{
		return $this->container;
	}

	/**
	 * setContainer
	 *
	 * @param   \Windwalker\DI\Container $container
	 *
	 * @return  Application  Return self to support chaining.
	 */
	public function setContainer(Container $container)
	{
		$this->container = $container;

		return $this;
	}

	/**
	 * addFlash
	 *
	 * @param string $message
	 * @param string $type
	 *
	 * @return  Application
	 */
	public function addFlash($message, $type = 'info')
	{
		$session = Factory::getSession();

		$session->addFlash($message, $type);

		return $this;
	}

	/**
	 * output
	 *
	 * @return  void
	 */
	public function output()
	{
		parent::respond();
	}

	/**
	 * toString
	 *
	 * @return  string
	 */
	public function __toString()
	{
		// Start an output buffer.
		ob_start();

		// Load the layout.
		parent::respond();

		// Get the layout contents.
		$output = ob_get_clean();

		return $output;
	}
}
 