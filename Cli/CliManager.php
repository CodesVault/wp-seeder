<?php

namespace Codesvault\WPseeder\Cli;

class CliManager
{
    public function __construct($args)
    {
        if (empty($args[1])) return;

        if ("--generate" === $args[1]) {
            new GenerateSeeder();
        }
    }
}
