<?php
/**
 * Part of starter project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Core\Router;

use Windwalker\Utilities\ArrayHelper;

/**
 * The Router class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class RestfulRouter extends \Windwalker\Router\Router
{
	/**
	 * An array of HTTP Method => controller suffix pairs for routing the request.
	 *
	 * @var  array
	 */
	protected $suffixMap = array(
		'GET' => 'GetController',
		'POST' => 'SaveController',
		'PUT' => 'SaveController',
		'PATCH' => 'SaveController',
		'DELETE' => 'DeleteController',
		'HEAD' => 'HeadController',
		'OPTIONS' => 'OptionsController'
	);

	/**
	 * Property customMethod.
	 *
	 * @var  string
	 */
	protected $customMethod = null;

	/**
	 * Property controller.
	 *
	 * @var  string
	 */
	protected $controller = null;

	/**
	 * A boolean allowing to pass _method as parameter in POST requests
	 *
	 * @var  boolean
	 */
	protected $allowCustomMethod = false;

	/**
	 * match
	 *
	 * @param string $route
	 * @param string $method
	 * @param array  $options
	 *
	 * @return  array|bool
	 */
	public function match($route, $method = 'GET', $options = array())
	{
		$variables = parent::match($route, $method, $options);

		$controller = ArrayHelper::getValue($variables, '_controller');

		if (!$controller)
		{
			throw new \UnexpectedValueException('Route profile should have "_controller" element');
		}

		$controller = trim($controller, '\\') . '\\' . $this->fetchControllerSuffix($method);

		$variables['_controller'] = $this->controller = $controller;

		return $variables;
	}

	/**
	 * Get the property to allow or not method in POST request
	 *
	 * @return  boolean
	 */
	public function isAllowCustomMethod()
	{
		return $this->allowCustomMethod;
	}

	/**
	 * Set to allow or not method in POST request
	 *
	 * @param   boolean  $value  A boolean to allow or not method in POST request
	 *
	 * @return  static
	 */
	public function allowCustomMethod($value)
	{
		$this->allowCustomMethod = $value;

		return $this;
	}

	/**
	 * Get the controller class suffix string.
	 *
	 * @param string $method
	 *
	 * @return  string
	 *
	 * @since   {DEPLOY_VERSION}
	 */
	protected function fetchControllerSuffix($method = 'GET')
	{
		$method = strtoupper($method);

		// Validate that we have a map to handle the given HTTP method.
		if (!isset($this->suffixMap[$method]))
		{
			throw new \RuntimeException(sprintf('Unable to support the HTTP method `%s`.', $method), 404);
		}

		// Check if request method is POST
		if ( $this->allowCustomMethod == true && strcmp(strtoupper($method), 'POST') === 0)
		{
			// Get the method from input
			$postMethod = $this->getCustomMethod();

			// Validate that we have a map to handle the given HTTP method from input
			if ($postMethod && isset($this->suffixMap[strtoupper($postMethod)]))
			{
				return ucfirst($this->suffixMap[strtoupper($postMethod)]);
			}
		}

		return ucfirst($this->suffixMap[$method]);
	}

	/**
	 * Set a controller class suffix for a given HTTP method.
	 *
	 * @param   string  $method  The HTTP method for which to set the class suffix.
	 * @param   string  $suffix  The class suffix to use when fetching the controller name for a given request.
	 *
	 * @return  static  Returns itself to support chaining.
	 */
	public function setHttpMethodSuffix($method, $suffix)
	{
		$this->suffixMap[strtoupper((string) $method)] = (string) $suffix;

		return $this;
	}

	/**
	 * Method to get property SuffixMap
	 *
	 * @return  array
	 */
	public function getSuffixMap()
	{
		return $this->suffixMap;
	}

	/**
	 * Method to set property suffixMap
	 *
	 * @param   array $suffixMap
	 *
	 * @return  static  Return self to support chaining.
	 */
	public function setSuffixMap($suffixMap)
	{
		$this->suffixMap = $suffixMap;

		return $this;
	}

	/**
	 * getCustomMethod
	 *
	 * @return  string
	 */
	public function getCustomMethod()
	{
		return $this->customMethod;
	}

	/**
	 * Method to get property Controller
	 *
	 * @return  string
	 */
	public function getController()
	{
		return $this->controller;
	}
}
 