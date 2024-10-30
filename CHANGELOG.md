## Rename folder class into classes

- add namespace on the files after <?php `namespace Classes`;
- on utils/NewsManager.php, make use of `use Classes\News;` and remove `require_once(ROOT . '/class/News.php');`
- on utils/CommentManager.php, make use of `use Classes\News;` and remove `require_once(ROOT . '/class/Comment.php');`

## Include autoload, for loading dependencies and files

- on `index.php` add `require __DIR__ . '/vendor/autoload.php'`

## Make use of PSR-4 autoloading capabilities, add on the composer.json and run `composer dump-autoload`

    "autoload": {
        "psr-4": {
            "App\\": "app/",
            "Classes\\": "classes/"
        }
    }

## Check `php.ini` Configuration includes E in variables_order so that environment variables are enabled

- `variables_order = "EGPCS"`

## Install composer and .env configuration

- run `composer require vlucas/phpdotenv` for autoloading env variables from a configuration file .env

## Project Folder Structure

- index.php
- .env
- composer.json
- app/
  | - Controllers
  | - Services
  | - Repositories
  | - Interfaces
  | - Views
- config
  - database.php
- classes
  - News.php
  - Comment.php
- vendor/
