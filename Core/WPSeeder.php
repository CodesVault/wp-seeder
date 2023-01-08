<?php

namespace Codesvault\WPseeder\Core;

use Codesvault\WPseeder\Core\Api\Seeder;

class WPSeeder implements Seeder
{
    public $row = 1;

    public function run() {}

    /**
     * Register all seeders.
     * 
     * @return array
     */
    public function register($class) {}

    public function faker()
    {
        return \Faker\Factory::create();
    }
}
