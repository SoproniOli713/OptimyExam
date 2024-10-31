<?php
require __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

// Load .env file from the root directory
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

use App\Controllers\NewsController;
use App\Repositories\NewsRepository;
use App\Repositories\CommentRepository;
use App\Services\Connections\DatabaseConnectionService;
use App\Services\DatabaseService;

$database_config = require_once "./config/database.php";

$databaseConnection = new DatabaseConnectionService($database_config['mysql']);
$databaseService = new DatabaseService($databaseConnection);

$commentRepository = new CommentRepository($databaseService);
$newsRepository = new NewsRepository($databaseService);


// Display news with comments for better html view
// NewsController::getInstance($newsRepository, $commentRepository)->displayNewsWithComments();

// Display news with comments using json
echo NewsController::getInstance($newsRepository, $commentRepository)->getNewsWithComments();