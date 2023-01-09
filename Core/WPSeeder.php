<?php

namespace Codesvault\WPseeder\Core;

use Codesvault\WPseeder\Core\Api\Seeder;

class WPSeeder implements Seeder
{
    /**
     * Number of rows to create in the DB.
     * Default is 1.
     */
    public $row = 1;

    /**
     * Database table name without prefix.
     * Default is 'posts'.
     */
    public $table = "posts";

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
