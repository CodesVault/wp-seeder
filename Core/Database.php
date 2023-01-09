<?php

namespace Codesvault\WPseeder\Core;

class Database
{
    private $dbConnect = null;

    public function connectDatabase()
    {
        if ($this->dbConnect) {
            return $this->dbConnect;
        }

        $configurations = $this->getDbConfig();
        // TODO: connect with wp_qb
    }

    private function getDbConfig()
    {
        return [
            "host"          => DB_HOST,
            "dbname"        => DB_NAME,
            "user"          => DB_USER,
            "password"      => DB_PASSWORD,
            "table_prefix"  => WPS_TABLE_PREFIX
        ];
    }
}
