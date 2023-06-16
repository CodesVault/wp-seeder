<?php

namespace Codesvault\WPseeder\Core;

class PrepareData
{
    private $db;
    private $data = [];
    private $row_count;
    private $table_name;

    public function store()
    {
        $this->db = Database::connectDatabase();
        $this->run();
    }

    public function run()
    {
        $wp_seeder = WPSEEDER_ROOT_DIR . "/database/seeders/wpseeder.php";
        if (! file_exists($wp_seeder)) {
            print_r("\033[31m ERROR: /database/seeders/wpseeder.php not found\033[0m \n");
            print_r(" Exit\n");
            die();
        }
        $seeder_list = require($wp_seeder);

        foreach ($seeder_list as $seeder) {
            if ('wpseeder' === $seeder) {
                continue;
            }
            if (isset($this->data[$this->table_name])) {
                $this->data[$this->table_name] = [];
            }

            $start_time = microtime(true);

            if (! file_exists(WPSEEDER_ROOT_DIR . "/database/seeders/$seeder.php")) {
                print_r("\033[31m ERROR: $seeder.php not found.\033[0m");
                print_r("\n Moving to the next exicution.\n");
                continue;
            }
            require(WPSEEDER_ROOT_DIR . "/database/seeders/" . $seeder . ".php");
            $seeder_object = new $seeder;
            $table = $seeder_object->table;
            print_r("\n\033[32m Generating data for " . $table . " table...\033[0m");

            $this->row_count = $seeder_object->row;
            $this->table_name = $seeder_object->table;
            $this->data[$seeder_object->table][] = $seeder_object->run();
            $this->innerLoop($seeder);
            $this->insertData();
            $duration = microtime(true) - $start_time;
            print_r("\n\033[32m Data inserted in $this->row_count rows within $duration microseconds.\033[0m\n");
        }
        print_r("\n\033[32m Done.\033[0m \n");
    }

    private function innerLoop($seeder)
    {
        if (1 === $this->row_count || empty($this->data)) {
            return;
        }

        for ($i = 1; $i < $this->row_count; $i++) {
            $this->data[$this->table_name][] = (new $seeder)->run();
        }
    }

    private function insertData()
    {
        $table = $this->table_name;
        $table_name = $table;
        print_r("\n\033[32m Inserting data in " . $table_name . " table...\033[0m");
    
        $this->db::insert($table, $this->data[$table]);
    }
}
