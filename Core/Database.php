<?php

namespace Codesvault\WPseeder\Core;

use CodesVault\Howdyqb\DB;

class Database
{
    private static $dbConnect = null;

    public static function connectDatabase()
    {
        if (static::$dbConnect) {
            return static::$dbConnect;
        }

        return DB::setConnection();
    }
}
