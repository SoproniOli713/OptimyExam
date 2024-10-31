# PHP test

## 1. Installation

- create an empty database named "phptest" on your MySQL server
- import the dbdump.sql in the "phptest" database
- put your MySQL server credentials in the constructor of DB class

## 2. Check configuration

- Check `php.ini` Configuration includes E in variables_order so that environment variables are enabled
- `variables_order = "EGPCS"`

## 3. Install composer

- make sure to install composer
- run `composer install` in your command line to install dependencies

## Running Demo Scripts and Unit Testing

- you can test the demo script in your shell: `php index.php` and `insert_and_delete_news_and_comment.php`
- you can also try to run PHPunit testing:
  `./vendor/bin/phpunit tests/Repositories/NewsRepositoryTest.php`
  `./vendor/bin/phpunit tests/Controllers/NewsControllerTest.php`

- for these unit test, you need to edit the database credentials on the file before running
  `./vendor/bin/phpunit tests/Services/DatabaseConnectionServiceTest.php`
