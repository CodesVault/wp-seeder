<?php

namespace Codesvault\WPseeder\Core;

class DBSeed
{
    public function execute()
    {
        (new PrepareData())->store();
    }
}
