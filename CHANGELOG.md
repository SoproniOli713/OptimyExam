## Optimy 0.0.1

- Refactor the NewsController.php, separate first the business logic and data logic
- create following files 'app/Interfaces/NewsRepositoryInterface.php', 'app/Repositories/NewsRepository.php'
- transfer first the database instance on the repository from controller
- added TODO for delete comments for news

## Transfer utils file and use namespacing

- copy files from utils folder to app/Controllers
- apply namespace on each files
- rename NewsManager.php -> NewsController.php, CommentManager.php -> CommentController.php same goes to there class names
- import neccesary files using use namespace/file
- remove the require_once on the \_\_construct function
- on index.php file
  change
  `require_once(ROOT . '/utils/NewsManager.php')`;
  `require_once(ROOT . '/utils/CommentManager.php');`
  to
  `use App\Controllers\NewsController;`
  `use App\Controllers\CommentController;`
- the application should still be running as the same

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
