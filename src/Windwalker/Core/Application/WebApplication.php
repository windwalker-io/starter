<?php
/**
 * Part of starter project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Core\Application;

use Symfony\Component\Yaml\Yaml;
use Windwalker\Application\AbstractWebApplication;
use Windwalker\Application\Web\Response;
use Windwalker\Application\Web\ResponseInterface;
use Windwalker\Core\Error\SimpleErrorHandler;
use Windwalker\Core\Ioc;
use Windwalker\Core\Provider\SystemProvider;
use Windwalker\Core\Provider\WebProvider;
use Windwalker\DI\Container;
use Windwalker\Environment\Web\WebEnvironment;
use Windwalker\IO\Input;
use Windwalker\Registry\Registry;
use Windwalker\Router\Route;

/**
 * The WebApplication class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class WebApplication extends AbstractWebApplication
{
	/**
	 * Property env.
	 *
	 * @var  string
	 */
	public $mode = 'prod';

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
	 * The application configuration object.
	 *
	 * @var    Registry
	 * @since  {DEPLOY_VERSION}
	 */
	public $config;

	/**
	 * Class constructor.
	 *
	 * @param   Input              $input        An optional argument to provide dependency injection for the application's
	 *                                           input object.  If the argument is a Input object that object will become
	 *                                           the application's input object, otherwise a default input object is created.
	 * @param   Registry           $config       An optional argument to provide dependency injection for the application's
	 *                                           config object.  If the argument is a Registry object that object will become
	 *                                           the application's config object, otherwise a default config object is created.
	 * @param   WebEnvironment     $environment  An optional argument to provide dependency injection for the application's
	 *                                           client object.  If the argument is a Web\WebEnvironment object that object will become
	 *                                           the application's client object, otherwise a default client object is created.
	 * @param   ResponseInterface  $response     The response object.
	 */
	public function __construct(Input $input = null, Registry $config = null, WebEnvironment $environment = null, ResponseInterface $response = null)
	{
		$this->environment = $environment instanceof WebEnvironment    ? $environment : new WebEnvironment;
		$this->response    = $response    instanceof ResponseInterface ? $response    : new Response;
		$this->input       = $input       instanceof Input             ? $input       : new Input;
		$this->config      = $config      instanceof Registry          ? $config      : new Registry;

		$this->initialise();

		// Set the execution datetime and timestamp;
		$this->set('execution.datetime', gmdate('Y-m-d H:i:s'));
		$this->set('execution.timestamp', time());
	}

	/**
	 * initialise
	 *
	 * @return  void
	 */
	protected function initialise()
	{
		$this->container = Ioc::getContainer();

		$this->loadConfiguration($this->config);

		if ($this->config->get('system.debug'))
		{
			SimpleErrorHandler::registerErrorHandler();
		}

		// Debug system
		if (!defined('WINDWALKER_DEBUG'))
		{
			define('WINDWALKER_DEBUG', $this->config->get('system.debug'));
		}

		$this->container->registerServiceProvider(new SystemProvider($this))
			->registerServiceProvider(new WebProvider($this));

		static::registerProviders($this->container);
	}

	/**
	 * registerProviders
	 *
	 * @param Container $container
	 *
	 * @return  void
	 */
	protected static function registerProviders(Container $container)
	{
	}

	/**
	 * Method to run the application routines.  Most likely you will want to instantiate a controller
	 * and execute it, or perform some sort of task directly.
	 *
	 * @return  void
	 *
	 * @since   {DEPLOY_VERSION}
	 */
	protected function doExecute()
	{
		$controller = $this->getController();

		$controller = new $controller($this->input, $this);

		$this->setBody($controller->execute());
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
		$route = $route ? : $this->container->get('uri')->get('route');

		// Hack for Router bug, remove when Windwalker beta1
		$route = trim($route, '/') ? $route : 'home';

		/** @var \Windwalker\Core\Router\RestfulRouter $router */
		$router = $this->getRouter();

		$method = $this->input->get('_method') ? : $this->input->getMethod();

		// Prepare option data
		$http = 'http';

		if (isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) != 'off'))
		{
			$http .= 's';
		}

		$options = array(
			'scheme' => $http,
			'host' => $_SERVER['HTTP_HOST'],
			'port' => $_SERVER['SERVER_PORT']
		);

		$variables = $router->match($route, $method, $options);

		// Save for input
		foreach ($variables as $name => $value)
		{
			$this->input->def($name, $value);

			// Don't forget to do an explicit set on the GET superglobal.
			$this->input->get->def($name, $value);
		}

		$class = $router->getController();

		if (!class_exists($class))
		{
			throw new \LogicException('Controller: ' . $class . ' not found.');
		}

		return $class;
	}

	/**
	 * getRouter
	 *
	 * @return  \Windwalker\Router\Router
	 */
	public function getRouter()
	{
		static $registered = false;

		/** @var \Windwalker\Router\Router $router */
		$router = $this->container->get('system.router');

		if (!$registered)
		{
			$routes = $this->loadRoutingConfiguration();

			foreach ($routes as $name => $route)
			{
				$pattern = isset($route['pattern']) ? $route['pattern'] : null;
				$variables = isset($route['variables']) ? $route['variables'] : array();
				$allowMethods = isset($route['method']) ? $route['method'] : array();

				$router->addRoute(new Route($name, $pattern, $variables, $allowMethods, $route));
			}

			$registered = true;
		}

		return $router;
	}

	/**
	 * loadConfiguration
	 *
	 * @param Registry $config
	 *
	 * @return  void
	 */
	protected function loadConfiguration(Registry $config)
	{
	}

	/**
	 * loadRoutingConfiguration
	 *
	 * @return  mixed
	 */
	protected function loadRoutingConfiguration()
	{
		return array();
	}

	/**
	 * Redirect to another URL.
	 *
	 * If the headers have not been sent the redirect will be accomplished using a "301 Moved Permanently"
	 * or "303 See Other" code in the header pointing to the new location. If the headers have already been
	 * sent this will be accomplished using a JavaScript statement.
	 *
	 * @param   string   $url    The URL to redirect to. Can only be http/https URL
	 * @param   boolean  $moved  True if the page is 301 Permanently Moved, otherwise 303 See Other is assumed.
	 *
	 * @return  void
	 *
	 * @since   {DEPLOY_VERSION}
	 */
	public function redirect($url, $moved = false)
	{
		// Init Uri
		$this->container->get('uri');

		parent::redirect($url, $moved);
	}

	/**
	 * initUri
	 *
	 * @return  object
	 */
	public function initUri()
	{
		static $inited = false;

		if ($inited)
		{
			return $this->get('uri');
		}

		$this->loadSystemUris();

		$inited = true;

		return $this->get('uri');
	}
}
 