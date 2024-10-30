<?php
require __DIR__ . '/vendor/autoload.php';

define('ROOT', __DIR__);
use App\Controllers\NewsController;
use App\Controllers\CommentController;
use App\Repositories\NewsRepository;
use App\Repositories\CommentRepository;

$commentRepository = new CommentRepository();

foreach (NewsController::getInstance(new NewsRepository(), $commentRepository)->listNews() as $news) {
	echo ("############ NEWS " . $news->getTitle() . " ############\n");
	echo ($news->getBody() . "\n");
	foreach (CommentController::getInstance($commentRepository)->listComments() as $comment) {
		if ($comment->getNewsId() == $news->getId()) {
			echo ("Comment " . $comment->getId() . " : " . $comment->getBody() . "\n");
		}
	}
}


// $commentManager = CommentController::getInstance();
// $c = $commentManager->listComments();