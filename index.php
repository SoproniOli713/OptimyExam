<?php
require __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

// Load .env file from the root directory
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

use App\Controllers\NewsController;
use App\Controllers\CommentController;
use App\Repositories\NewsRepository;
use App\Repositories\CommentRepository;
use App\Services\Connections\DatabaseConnectionService;
use App\Services\DatabaseService;

$database_config = require_once "./config/database.php";

$databaseConnection = new DatabaseConnectionService($database_config['mysql']);
$databaseService = new DatabaseService($databaseConnection);

$commentRepository = new CommentRepository($databaseService);
$newsRepository = new NewsRepository($databaseService);


// Display news with comments
NewsController::getInstance($newsRepository, $commentRepository)->displayNewsWithComments();

// foreach (NewsController::getInstance($newsRepository, $commentRepository)->listNews() as $news) {
// 	echo ("############ NEWS " . $news->getTitle() . " ############\n");
// 	echo ($news->getBody() . "\n");
// 	foreach (CommentController::getInstance($commentRepository)->listComments() as $comment) {
// 		if ($comment->getNewsId() == $news->getId()) {
// 			echo ("Comment " . $comment->getId() . " : " . $comment->getBody() . "\/n");
// 		}
// 	}
// }


// $commentManager = CommentController::getInstance();
// $c = $commentManager->listComments();