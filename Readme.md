# WP Seeder
Add demo data in the Database from terminal.

## Installation
It is required to install it using composer `composer install codesvault/wp-seeder`.
<br>It supports PHP **>= 7.4**

<br>

![WP Seeder Demo](https://github.com/CodesVault/wp-seeder/blob/doc/demo/WP%20Seeder%20-%20Demo.gif)

<br>
<br>

## Uses
Run `./vendor/bin/wpseed --generate` and provide necessary inputs.
<br>It will generate `/seeders` directory in the parent directory of your vendor folder. Don't move this directory to other location, it must be here.
In the `/seeders` folder you will have your seeder which was automatically generated, the file name will be same as the class name that you had given input.

<br>

Now change the `$table` property according to your table name where you want to store data. `$row` property is for number of rows you want to generate in the table. For generating demo data WP Seeder has build-in support of [FakerPHP](https://fakerphp.github.io/).

```php
class yourClassName extends WPSeeder
{
    public $table = "cv_users";    // db table name without prefix, default is posts.
    public $row = 5000;      // number of db table row will create, default is 1.

    public function run()
    {
        // add data that need to be inserted in database.
        // array key is the column name, value is data that will be stored.
        return array(
            'name' => $this->faker()->unique()->name(),
            'email' => $this->faker()->unique()->email(),
            'password' => $this->faker()->unique()->password()
        );
    }
}
```

<br>

If you want to create more seeders for different tables then just repeate the above process.
<br>Now just run `./vendor/bin/wpseed` in the terminal and data will be stored in the database.

<br>
.
