<?php

require __DIR__ . '/vendor/autoload.php';

use App\Controllers\CommentController;
use Dotenv\Dotenv;

// Load .env file from the root directory
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();


use App\Controllers\NewsController;
use App\Repositories\CommentRepository;
use App\Repositories\NewsRepository;
use Classes\NewsFactory;
use Classes\CommentFactory;
use App\Services\Connections\DatabaseConnectionService;
use App\Services\DatabaseService;

$database_config = require_once "./config/database.php";

$databaseConnection = new DatabaseConnectionService($database_config['mysql']);
$databaseService = new DatabaseService($databaseConnection);

$commentRepository = new CommentRepository($databaseService);
$newsRepository = new NewsRepository($databaseService);

$newsFactory = new NewsFactory();
$commentFactory = new CommentFactory();
$newsController = NewsController::getInstance($newsRepository, $commentRepository);
$commentController = CommentController::getInstance($commentRepository);

$newsData1 = $newsFactory->createDefaultNews();
$newsData2 = $newsFactory->createDefaultNews();

$news1 = $newsController->addNews($newsData1->getTitle(), $newsData1->getBody());
echo "News article with id of {$news1} created \n";

$news2 = $newsController->addNews($newsData2->getTitle(), $newsData2->getBody());
echo "News article with id of {$news2} created \n";

$commentData1 = $commentFactory->createDefaultComment($news1);

$commentId = $commentRepository->add($commentData1);
echo "News article comment with id of {$commentId} created for news with an id {$news1} \n";

$commentData2 = $commentFactory->createDefaultComment($news2);
$commentId2 = $commentRepository->add($commentData2);

echo "News article comment with id of {$commentId2} created for news with an id {$news1} \n";

$delete = $newsController->deleteNews($news1);
echo "News article s with an id {$news1}  with its comments {$commentId}, {$commentId2} is deleted \n";

