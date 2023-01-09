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
        $file_path = WPS_ROOT_DIR . "/seeders/$this->class_name.php";
        $seeder = fopen($file_path, "w");
        fwrite($seeder, $this->fileContent());
        fclose($seeder);
        chmod($file_path, 0777);
        print_r("\n\033[32m /seeders/$this->class_name.php generated.\033[0m\n");
        die();
    }

    private function fileContent()
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
}
