<?php

namespace Codesvault\WPseeder\Core;

class PrepareData
{
    private $data = [];

    public function map()
    {
        $seeder_list = require(WPS_ROOT_DIR . "/seeders/wpseeder.php");

        foreach ($seeder_list as $seeder) {
            if ('wpseeder' === $seeder) continue;

            require(WPS_ROOT_DIR . "/seeders/" . $seeder . ".php");
            $seeder_object = new $seeder;
            $this->data[] = $seeder_object->run();
            $this->innerLoop($seeder, $seeder_object->row);
        }
       return $this->data;
    }

    private function innerLoop($seeder, $row)
    {
        if (1 === $row) {
            return;
        }

        for ($i = 1; $i < $row; $i++) {
            $this->data[] = (new $seeder)->run();
        }
    }
}
