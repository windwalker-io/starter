<?php
/**
 * Part of auth project. 
 *
 * @copyright  Copyright (C) 2011 - 2014 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Windwalker\Core\Model;

use Windwalker\Cache\Cache;
use Windwalker\Cache\Storage\RuntimeStorage;
use Windwalker\Core\Ioc;
use Windwalker\Database\Driver\DatabaseAwareTrait;
use Windwalker\Database\Driver\DatabaseDriver;
use Windwalker\Model\AbstractModel;
use Windwalker\Model\DatabaseModelInterface;
use Windwalker\Registry\Registry;

/**
 * Class DatabaseModel
 *
 * @since 1.0
 */
class Model extends AbstractModel implements DatabaseModelInterface
{
	use DatabaseAwareTrait;

	/**
	 * Property cache.
	 *
	 * @var  Cache
	 */
	protected $cache = null;

	/**
	 * Property magicMethodPrefix.
	 *
	 * @var  array
	 */
	protected $magicMethodPrefix = array(
		'get',
		'load'
	);

	/**
	 * Instantiate the model.
	 *
	 * @param   Registry       $state The model state.
	 * @param   DatabaseDriver $db    The database adapter.
	 *
	 * @since   1.0
	 */
	public function __construct(Registry $state = null, DatabaseDriver $db = null)
	{
		$this->db = $db ? : Ioc::getDatabase();

		$this->cache = new Cache(new RuntimeStorage);

		parent::__construct($state);

		$this->initialise();
	}

	/**
	 * initialise
	 *
	 * @return  void
	 */
	protected function initialise()
	{
	}

	/**
	 * __call
	 *
	 * @param string $name
	 * @param array  $args
	 *
	 * @return  mixed
	 *
	 * @throws \InvalidArgumentException
	 */
	public function __call($name, $args = array())
	{
		$allow = false;

		foreach ($this->magicMethodPrefix as $prefix)
		{
			if (substr($name, 0, $prefix) == $prefix)
			{
				$allow = true;

				break;
			}
		}

		if (!$allow)
		{
			throw new \BadMethodCallException(sprintf("Method %s::%s not found.", get_called_class(), $name));
		}

		return null;
	}

	/**
	 * getStoredId
	 *
	 * @param string $id
	 *
	 * @return  string
	 */
	public function getCacheId($id = null)
	{
		$id = $id . json_encode($this->state->toArray());

		return sha1($id);
	}

	/**
	 * getCache
	 *
	 * @param string $id
	 *
	 * @return  mixed
	 */
	protected function getCache($id = null)
	{
		return $this->cache->get($this->getCacheId($id));
	}

	/**
	 * setCache
	 *
	 * @param string $id
	 * @param mixed  $item
	 *
	 * @return  mixed
	 */
	protected function setCache($id = null, $item = null)
	{
		$this->cache->set($this->getCacheId($id), $item);

		return $item;
	}

	/**
	 * hasCache
	 *
	 * @param string $id
	 *
	 * @return  bool
	 */
	protected function hasCache($id = null)
	{
		return $this->cache->exists($this->getCacheId($id));
	}

	/**
	 * fetch
	 *
	 * @param string   $id
	 * @param callable $closure
	 *
	 * @return  mixed
	 */
	protected function fetch($id, $closure)
	{
		return $this->cache->call($this->getCacheId($id), $closure);
	}
}
 