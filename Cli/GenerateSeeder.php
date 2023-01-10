<?php

namespace Codesvault\WPseeder\Cli;

class GenerateSeeder
{
    protected $class_name;
    protected $table_name = "posts";
    protected $row_count = 1;

    public function __construct()
    {
        $this->getInputs();
        $this->generateFile();
    }

    private function getInputs()
    {
        $class_name = readline(" Class Name: " );
        if (! $class_name) {
            print_r("\033[31m Class name is required.\033[0m");
            print_r("\n Exit.\n");
            die();
        }
        $this->class_name = $class_name;

        $table = readline(" Table Name: " );
        $this->table_name = $table ? $table : $this->table_name;
        $row = readline(" Number of rows: " );
        $this->row_count = $row ? $row : $this->row_count;
    }

    private function generateFile()
    {
        if (! file_exists(WPS_ROOT_DIR . "/seeders/wpseeder.php")) {
            mkdir(WPS_ROOT_DIR . "/seeders");
        }
        $file_path = WPS_ROOT_DIR . "/seeders/$this->class_name.php";
        $seeder = fopen($file_path, "w");
        fwrite($seeder, $this->seederClassFileContent());
        fclose($seeder);
        chmod($file_path, 0777);

        $this->registerSeeder();
        print_r("\n\033[32m /seeders/$this->class_name.php generated.\033[0m\n");
        die();
    }

    private function seederClassFileContent()
    {
        $table = '$table';
        $row = '$row';
        $content = <<<TEXT
        <?php

        use Codesvault\WPseeder\Core\WPSeeder;

        class $this->class_name extends WPSeeder
        {
            public $table = "$this->table_name";    // db table name without prefix, default is posts.
            public $row = $this->row_count;      // number of db table row will create, default is 1.

            public function run()
            {
                return array(
                    
                );
            }
        }
        TEXT;

        return $content;
    }

    private function registerSeeder()
    {
        $seeder_list = [];
        $seeders_path = WPS_ROOT_DIR . "/seeders/wpseeder.php";
        if (file_exists($seeders_path)) {
            $seeder_list = require($seeders_path);
        }
        $seeder = fopen($seeders_path, "w");
        fwrite($seeder, $this->seederListFileContent($seeder_list));
        fclose($seeder);
        chmod($seeders_path, 0777);
    }

    private function seederListFileContent($list = [])
    {
        $seeders_list = '';
        if (! empty($list)) {
            $seeders = implode(",", $list);
            $seeders .= "," . $this->class_name . "::class";
            $seeders_list = str_replace(",", "::class,\n\t", $seeders) . ",";
        } else {
            $seeders_list = $this->class_name . "::class,";
        }
        $content = <<<TEXT
        <?php

        return array(
            $seeders_list
        );
        TEXT;
        return $content;
    }
}
