<?php

namespace Codesvault\WPseeder\Cli;

use Codesvault\WPseeder\Core\DBSeed;

class CliManager
{
    public function __construct($args)
    {
        if (empty($args[1])) {
            return print_r("\033[31m Available options are: `new, store`\033[0m \n");
        };

        if ("new" === $args[1]) {
            new GenerateSeeder();
        }

        if ("store" === $args[1]) {
            (new DBSeed)->execute();
        }

        print_r("\033[31m Available options are: `new, store`\033[0m \n");
    }
}
