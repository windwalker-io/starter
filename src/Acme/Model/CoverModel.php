<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2011 - 2014 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Acme\Model;

use Windwalker\Core\Model\Model;
use Windwalker\Data\Data;
use Windwalker\DataMapper\DataMapper;

/**
 * Class CoverModel
 *
 * @since 1.0
 */
class CoverModel extends Model
{
	/**
	 * getContent
	 *
	 * @return  \Windwalker\Data\Data
	 */
	public function getContent()
	{
		try
		{
			return (new DataMapper('acme_cover'))->findOne(array('id' => 1));
		}
		catch (\RuntimeException $e)
		{
			return new Data;
		}
	}
}
 