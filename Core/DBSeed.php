<?php

namespace Codesvault\WPseeder\Core;

class DBSeed
{
    private $data = [];

    public function execute()
    {
        $this->data = (new PrepareData())->map();
        print_r($this->data);
        $this->insert();
    }

    private function insert()
    {

    }
}
