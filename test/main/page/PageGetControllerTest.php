<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

use Windwalker\Core\Model\ModelRepository;
use Windwalker\Core\Package\PackageHelper;
use Windwalker\Core\View\HtmlView;
use Windwalker\Ioc;
use Windwalker\Test\TestCase\AbstractBaseTestCase;

/**
 * The PageHtmlViewTest class.
 *
 * @since  {DEPLOY_VERSION}
 */
class PageGetControllerTest extends AbstractBaseTestCase
{
	/**
	 * Sets up the fixture, for example, open a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp()
	{
		Ioc::getApplication()->setCurrentPackage('main');
	}

	/**
	 * testRender
	 *
	 * @return  void
	 */
	public function testGetView()
	{
		$ctrl = PackageHelper::getPackage()->getController('Page/GetController');

		$this->assertInstanceOf(HtmlView::class, $ctrl->getView());
	}

	/**
	 * testGetModel
	 *
	 * @return  void
	 */
	public function testGetModel()
	{
		$ctrl = PackageHelper::getPackage()->getController('Page/GetController');

		$this->assertInstanceOf(ModelRepository::class, $ctrl->getModel());
	}
}
