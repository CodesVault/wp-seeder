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

        $db = new DB;
        $db->setConnection(static::getDbConfig());
        return static::$dbConnect = $db;
    }

    private static function getDbConfig()
    {
        return [
            "dbhost"        => DB_HOST,
            "dbname"        => DB_NAME,
            "dbuser"        => DB_USER,
            "dbpassword"    => DB_PASSWORD,
            "prefix"        => WPS_TABLE_PREFIX
        ];
    }
}
