<?php
/**
 * Part of Front project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Front\Controller\Sakuras;

use Front\Model\SakurasModel;
use Front\View\Sakuras\SakurasHtmlView;
use Phoenix\Controller\Display\ListDisplayController;
use Windwalker\Core\Controller\Controller;
use Windwalker\Core\Model\Model;

/**
 * The GetController class.
 * 
 * @since  1.0
 */
class GetController extends ListDisplayController
{
	/**
	 * Property name.
	 *
	 * @var  string
	 */
	protected $name = 'sakuras';

	/**
	 * Property itemName.
	 *
	 * @var  string
	 */
	protected $itemName = 'sakura';

	/**
	 * Property listName.
	 *
	 * @var  string
	 */
	protected $listName = 'sakuras';

	/**
	 * Property model.
	 *
	 * @var  SakurasModel
	 */
	protected $model;

	/**
	 * Property view.
	 *
	 * @var  SakurasHtmlView
	 */
	protected $view;

	/**
	 * Property ordering.
	 *
	 * @var  string
	 */
	protected $defaultOrdering = null;

	/**
	 * Property direction.
	 *
	 * @var  string
	 */
	protected $defaultDirection = null;

	/**
	 * prepareExecute
	 *
	 * @return  void
	 */
	protected function prepareExecute()
	{
		parent::prepareExecute();
	}

	/**
	 * prepareUserState
	 *
	 * @param   Model $model
	 *
	 * @return  void
	 */
	protected function prepareUserState(Model $model)
	{
		parent::prepareUserState($model);
	}

	/**
	 * postExecute
	 *
	 * @param mixed $result
	 *
	 * @return  mixed
	 */
	protected function postExecute($result = null)
	{
		return parent::postExecute($result);
	}
}
