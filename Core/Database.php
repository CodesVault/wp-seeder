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
        $envContent = $this->getEnvironments();
        $lines = explode("\n", $envContent);
        $data = [];

        foreach($lines as $env) {
            if (empty($env)) continue;
        
            $env_arr = explode('=', $env);
            $data[$env_arr[0]] = $env_arr[1];
        }
        return $data;
    }

    private function getEnvironments()
    {
        $envFile = WPS_ROOT_DIR . '/.env';
        return file_get_contents($envFile, true);
    }
}
