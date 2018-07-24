<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU Lesser General Public License version 3 or later.
 */

// phpcs:disable PSR1.Classes.ClassDeclaration.MissingNamespace

use Windwalker\Core\Seeder\AbstractSeeder;

/**
 * The MainSeeder class.
 *
 * @since  {DEPLOY_VERSION}
 */
class MainSeeder extends AbstractSeeder
{
    /**
     * doExecute
     *
     * @return  void
     * @throws ReflectionException
     */
    public function doExecute()
    {
        $this->execute(CoverSeeder::class);
    }

    /**
     * doClear
     *
     * @return  void
     * @throws ReflectionException
     */
    public function doClear()
    {
        $this->clear(CoverSeeder::class);
    }
}
