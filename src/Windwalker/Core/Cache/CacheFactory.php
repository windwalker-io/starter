<?php
/**
 * Part of starter project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\Core\Cache;

use Windwalker\Cache\Cache;
use Windwalker\Cache\DataHandler\DataHandlerInterface;
use Windwalker\Cache\Storage\CacheStorageInterface;
use Windwalker\Core\Ioc;

/**
 * The CacheFactory class.
 * 
 * @since  {DEPLOY_VERSION}
 */
abstract class CacheFactory
{
	/**
	 * Property instances.
	 *
	 * @var  Cache[]
	 */
	protected static $instances = array();

	/**
	 * getCache
	 *
	 * @param string $name
	 * @param string $storage
	 * @param string $dataHandler
	 * @param array  $options
	 *
	 * @return  Cache
	 */
	public static function getCache($name = 'windwalker', $storage = 'runtime', $dataHandler = 'serialize', $options = array())
	{
		$hash = sha1($name . $storage . $dataHandler);

		if (!empty(static::$instances[$hash]))
		{
			return static::$instances[$hash];
		}

		$storage = static::getStorage($storage, $options, $name);
		$handler = static::getDataHandler($dataHandler);

		$cache = new Cache($storage, $handler);

		return static::$instances[$hash] = $cache;
	}

	/**
	 * getStorage
	 *
	 * @param string $storage
	 * @param array  $options
	 * @param string $name
	 *
	 * @return  CacheStorageInterface
	 */
	public static function getStorage($storage, $options = array(), $name = 'windwalker')
	{
		$class = sprintf('Windwalker\Cache\Storage\%sStorage', ucfirst($storage));

		if (!class_exists($class))
		{
			throw new \DomainException(sprintf('Cache Storage: %s not supported.', ucfirst($storage)));
		}

		$config = Ioc::getConfig();

		$ttl = $config->get('cache.time');

		switch (strtolower($storage))
		{
			case 'file' :
				$path = $config->get('cache.dir');

				if (!is_dir($path))
				{
					$path = Ioc::getEnvironment()->server->getRoot() . '/../' . $path;
				}

				if (is_dir($path))
				{
					$path = realpath($path);
				}

				$group = ($name == 'windwalker') ? null : $name;

				return new $class($path, $group, false, $ttl, $options);
				break;

			case 'redis':
			case 'memcached':
				return new $class(null, $ttl, $options);
				break;

			default:
				return new $class($ttl, $options);
				break;
		}
	}

	/**
	 * getDataHandler
	 *
	 * @param $handler
	 *
	 * @return  DataHandlerInterface
	 */
	public static function getDataHandler($handler)
	{
		$class = sprintf('Windwalker\Cache\DataHandler\%sHandler', ucfirst($handler));

		if (!class_exists($class))
		{
			throw new \DomainException(sprintf('Cache Data Handler: %s not supported.', ucfirst($handler)));
		}

		return new $class;
	}
}
 