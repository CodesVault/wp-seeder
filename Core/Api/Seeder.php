<?php

namespace Codesvault\WPseeder\Core\Api;

interface Seeder
{
    public function run();

    public function register(array $class);
}
