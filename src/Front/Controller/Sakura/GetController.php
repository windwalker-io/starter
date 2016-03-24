<?php
/**
 * Part of Front project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Front\Controller\Sakura;

use Front\Model\SakuraModel;
use Front\View\Sakura\SakuraHtmlView;
use Phoenix\Controller\Display\ItemDisplayController;
use Windwalker\Core\Model\Model;

/**
 * The GetController class.
 * 
 * @since  1.0
 */
class GetController extends ItemDisplayController
{
	/**
	 * Property name.
	 *
	 * @var  string
	 */
	protected $name = 'sakura';

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
	 * @var  SakuraModel
	 */
	protected $model;

	/**
	 * Property view.
	 *
	 * @var  SakuraHtmlView
	 */
	protected $view;

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
