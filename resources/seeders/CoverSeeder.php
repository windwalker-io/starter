<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2016 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

// phpcs:disable PSR1.Classes.ClassDeclaration.MissingNamespace

use Windwalker\Core\Seeder\AbstractSeeder;
use Windwalker\Data\Data;
use Windwalker\DataMapper\DataMapper;

/**
 * The CoverSeeder class.
 *
 * @since  {DEPLOY_VERSION}
 */
class CoverSeeder extends AbstractSeeder
{
    /**
     * doExecute
     *
     * @return  void
     * @throws Exception
     */
    public function doExecute()
    {
        $faker = \Faker\Factory::create();

        // This is example seeder, you can delete it.
        $mapper = new DataMapper('main_cover');

        foreach (range(1, 50) as $i) {
            $data = new Data();

            $data->title = $faker->sentence(2);
            $data->text  = $faker->paragraph(3);
            $data->state = $faker->randomElement([0, 1, 1]);

            $mapper->createOne($data);

            $this->outCounting();
        }
    }

    /**
     * doClear
     *
     * @return  void
     */
    public function doClear()
    {
        $this->truncate('main_cover');
    }
}
