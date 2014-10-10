<?php
/**
 * Part of starter project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windwalker\User\User;

use Windwalker\Core\Authenticate\UserHandlerInterface;
use Windwalker\Data\Data;
use Windwalker\DataMapper\DataMapper;

/**
 * The UserHandler class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class UserHandler implements UserHandlerInterface
{
	/**
	 * Property mapper.
	 *
	 * @var DataMapper
	 */
	protected $mapper;

	/**
	 * load
	 *
	 * @param array $conditions
	 *
	 * @return  mixed
	 */
	public function load($conditions)
	{
		$user = $this->getDataMapper()->findOne($conditions);

		if ($user->isNull())
		{
			return false;
		}

		return (array) $user;
	}

	/**
	 * create
	 *
	 * @param Data $data
	 *
	 * @return  Data
	 */
	public function save(Data $data)
	{
		if ($data->id)
		{
			$this->getDataMapper()->updateOne($data);
		}
		else
		{
			$this->getDataMapper()->createOne($data);
		}

		return $data;
	}

	/**
	 * delete
	 *
	 * @param array $conditions
	 *
	 * @return  boolean
	 */
	public function delete($conditions)
	{
		return $this->getDataMapper()->delete($conditions);
	}

	/**
	 * getDataMapper
	 *
	 * @return  DataMapper
	 */
	protected function getDataMapper()
	{
		if (!$this->mapper)
		{
			$this->mapper = new DataMapper('users');
		}

		return $this->mapper;
	}
}
 