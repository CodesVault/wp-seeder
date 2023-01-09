<?php

namespace Codesvault\WPseeder\Core;

class PrepareData
{
    private $data = [];

    public function map()
    {
        if (! file_exists(WPS_ROOT_DIR . "/seeders/wpseeder.php")) {
            print_r("\033[31m ERROR: /seeders/wpseeder.php not found in the parent folder of /vendor.\033[0m \n");
            print_r(" Exit\n");
            die();
        }
        $seeder_list = require(WPS_ROOT_DIR . "/seeders/wpseeder.php");

        foreach ($seeder_list as $seeder) {
            if ('wpseeder' === $seeder) continue;

            if (! file_exists(WPS_ROOT_DIR . "/seeders/$seeder.php")) {
                print_r("\033[31m ERROR: $seeder.php not found.\033[0m");
                print_r("\n Moving to the next exicution.\n");
                continue;
            }
            require(WPS_ROOT_DIR . "/seeders/" . $seeder . ".php");
            $seeder_object = new $seeder;
            $this->data[] = $seeder_object->run();
            $this->innerLoop($seeder, $seeder_object->row);
        }
       return $this->data;
    }

    private function innerLoop($seeder, $row)
    {
        if (1 === $row || empty($this->data)) {
            return;
        }

        for ($i = 1; $i < $row; $i++) {
            $this->data[] = (new $seeder)->run();
        }
    }
}
