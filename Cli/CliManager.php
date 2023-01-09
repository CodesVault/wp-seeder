<?php

namespace Codesvault\WPseeder\Cli;

class CliManager
{
    public function __construct($args)
    {
        if ("--generate" === $args[1]) {
            new GenerateSeeder();
        }
    }
}
